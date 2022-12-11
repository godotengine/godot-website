<?php
namespace GodotEngine\I18n\Classes;

use App;
use Str;
use Log;
use Cms\Classes\Page;
use Cms\Classes\Theme;
use Cms\Classes\Layout;
use Cms\Classes\Partial;
use System\Helpers\Cache as CacheHelper;
use Symfony\Component\Yaml\Yaml;
use RainLab\Translate\Models\Locale;
use RainLab\Translate\Models\Message;
use RainLab\Translate\Classes\ThemeScanner;
use \Gettext\Translations;
use \Gettext\Generator\PoGenerator;
use \Gettext\Loader\PoLoader;
use \Gettext\Merge;
use GodotEngine\I18n\Classes\TwigMarkupScanner;
use ApplicationException;

class TranslationManager
{
    /**
     * @var string The base path of all i18n files.
     */
    private static $I18N_ROOT_PATH = 'themes/godotengine/i18n';

    /**
     * @var string The base file for all localized PO files.
     */
    private static $baseFile = 'themes/godotengine/i18n/po/messages.po';

    /**
     * @var string The default domain name for extracted messages (used only internally).
     */
    private static $defaultDomain = 'default';

    /**
     * Generates a qualified and reliably unique translation key for the specified message.
     *
     * @param string $messageId The original message, which serves as an id.
     * @return string The generated translation key.
     */
    private static function generateTranslationKey($messageId)
    {
        $separator = '.';
        // The RainLab plugin limits keys to 250 charaters, but database doesn't allow it.
        // May be a local bug, but to be sure we will limit it to be even shorter.
        $characterLimit = 150;

        // Convert all dashes/underscores into separator.
        $messageId = preg_replace('!['.preg_quote('_').'|'.preg_quote('-').']+!u', $separator, $messageId);

        // Remove all characters that are not the separator, letters, numbers, or whitespace.
        $messageId = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', mb_strtolower($messageId));

        // Replace all separator characters and whitespace by a single separator.
        $messageId = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $messageId);

        // Trim unnecessary characters.
        $messageId = trim($messageId, $separator);

        // If the message is too long, crop it to fit the database column.
        $messageLen = strlen($messageId);
        if ($messageLen > $characterLimit) {
            // We also add a number of characters left to increase uniqueness.
            $messageId = substr($messageId, 0, $characterLimit) . '.' . ($messageLen - $characterLimit);
        }

        return $messageId;
    }

    /**
     * Normalizes the file path for the given object.
     */
    private static function makeRelativePath($object)
    {
        return $object->theme->getDirName() . '/' . $object->getObjectTypeDirName() . '/' . $object->getFileName();
    }

    /**
     * Generates the YAML file for its counterpart PO file.
     */
    private static function generateYamlFile($inputFile, $outputPath, $useTranslations = false)
    {
        $yamlData = [];

        foreach ($inputFile->getTranslations() as $entry) {
            $originalMessage = $entry->getOriginal();
            $translatedMessage = '';

            if ($useTranslations)
            {
                $translatedMessage = $entry->getTranslation();
            }

            $translationKey = self::generateTranslationKey($originalMessage);
            $yamlData[$translationKey] = $translatedMessage;
        }

        file_put_contents($outputPath, Yaml::dump($yamlData));
    }

    /**
     * Refreshes the translation database and flushes CMS cache.
     */
    private static function refreshDatabase()
    {
        Log::info('Updating translation database.');
        Message::truncate();
        ThemeScanner::scan();

        Log::info('Flushing CMS cache.');
        CacheHelper::clear();
    }

    /**
     * Returns the state of the initial setup, such as existence of the necessary files.
     *
     * @return bool
     */
    public static function isSetupValid()
    {
        $poPath = self::$I18N_ROOT_PATH . '/po';
        if (!is_dir($poPath)) {
            return false;
        }

        if (!file_exists(self::$baseFile)) {
            return false;
        }

        return true;
    }

    /**
     * Generates the necessary files for a new translation.
     *
     * @param string $lang The locale language code.
     * @return void
     */
    public static function createLocale($lang)
    {
        Log::info('Adding "' . $lang . '" translation.');

        if (!file_exists(self::$baseFile))
        {
            Log::error('Missing base base file; aborting!');
            throw new ApplicationException('Base PO file is missing. You must perform first time setup before attempting to add new locales.');
        }

        $poPath = self::$I18N_ROOT_PATH . "/po/messages.$lang.po";
        $yamlPath = self::$I18N_ROOT_PATH . "/$lang.yaml";

        $loader = new PoLoader();
        $poFile = $loader->loadFile(self::$baseFile);
        $poFile->getHeaders()->set('Language', $lang);

        if (!file_exists($poPath))
        {
            Log::info('Writing translation PO file ' . $poPath . '.');
            $generator = new PoGenerator();
            $generator->generateFile($poFile, $poPath);
        } else {
            Log::info('Skipped writing ' . $poPath . ' file; file exists.');
        }

        if (!file_exists($yamlPath))
        {
            Log::info('Writing translation YAML file ' . $yamlPath . '.');
            self::generateYamlFile($poFile, $yamlPath, false);
        } else {
            Log::info('Skipped writing ' . $yamlPath . ' file; file exists.');
        }

        Log::info('Updating Theme configuration.');
        $theme = Theme::getActiveTheme();
        $themeConfig = (array) $theme->getConfig();

        if (!isset($themeConfig['translate']))
        {
          $themeConfig['translate'] = [];
        }
        if (!isset($themeConfig['translate'][$lang]))
        {
             $themeConfig['translate'][$lang] = "i18n/$lang.yaml";
             ksort($themeConfig['translate']);
        }
        $theme->writeConfig($themeConfig, true);

        Log::info('Successfully added "' . $lang . '" translation.');
    }

    /**
     * Iterates through locales configured in the CMS and creates missing files.
     */
    public static function restoreLocales()
    {
        // List is configured in the admin panel (Translate > Manage Languages).
        $availableLocales = Locale::listAvailable();
        foreach ($availableLocales as $lang => $langName) {
            if ($lang == self::getDefaultLocale()) {
                continue;
            }

            // Existing files will not be replaces, missing data will be created.
            self::createLocale($lang);
        }
    }

    /**
     * Iterates through the PO files on disk and registers missing locales with the CMS.
     */
    public static function restoreCMSLocales()
    {
        $poLocales = self::getLocales();

        foreach ($poLocales as $locale) {
            if ($locale['code'] == self::getDefaultLocale() || Locale::findByCode($locale['code'])) {
                continue;
            }

            $localeRecord = new Locale;
            $localeRecord->name = $locale['code'];
            $localeRecord->code = $locale['code'];
            $localeRecord->save();
        }

        self::refreshDatabase();
    }

    /**
     * Fetches the default locale language code.
     *
     * @return string The locale language code.
     */
    public static function getDefaultLocale()
    {
        return Locale::getDefault()->code;
    }

    /**
     * Fetches the current locale language code.
     *
     * @return string The locale language code.
     */
    public static function getCurrentLocale()
    {
        return App::getLocale();
    }

    /**
     * Returns a list of locales stored in PO files, sorted alphabetically.
     *
     * @return array
     */
    public static function getLocales()
    {
        $locales = [];
        $locales[] = array(
            'code' => 'en',
            'completion' => '',
        );

        $poPath = self::$I18N_ROOT_PATH . '/po';
        if (!is_dir($poPath)) {
            return $locales;
        }

        $poDir = dir($poPath);
        $poDir->rewind();

        while (($fileName = $poDir->read()) !== false){
            if ($fileName == 'messages.po' || $fileName == '..' || $fileName == '.') {
                continue;
            }

            $loader = new PoLoader();
            $poFile = $loader->loadFile($poPath . '/' . $fileName);

            $totalMessages = $poFile->count();
            $translatedMessages = 0;

            foreach ($poFile->getTranslations() as $entry) {
                if ($entry->isTranslated())
                {
                    $translatedMessages += 1;
                }
            }

            $locales[] = array(
                'code' => $poFile->getLanguage(),
                'completion' => round(100 * $translatedMessages / $totalMessages) . '%',
            );
        }

        $poDir->close();

        return $locales;
    }

    /**
     * Returns a list of locales configured in the CMS settings, sorted alphabetically.
     *
     * @return array
     */
    public static function getCMSLocales()
    {
        $locales = Locale::orderBy('code', 'asc')->get();

        return $locales;
    }

    /**
     * Extracts translation messages and their codes and generates PO files.
     *
     * @return array A collection of translatable messages.
     */
    public static function extractMessages()
    {
        Log::info('Starting message extraction.');

        $scanner = new TwigMarkupScanner(
            Translations::create(self::$defaultDomain)
        );
        $scanner->setDefaultDomain(self::$defaultDomain);


        Log::info('Scanning Layout files.');
        foreach (Layout::all() as $layout) {
            $tree = $layout->getTwigNodeTree();
            $scanner->scanAST($tree, self::makeRelativePath($layout));
        }

        Log::info('Scanning Page files.');
        foreach (Page::all() as $page) {
            $tree = $page->getTwigNodeTree();
            $scanner->scanAST($tree, self::makeRelativePath($page));
        }

        Log::info('Scanning Partial files.');
        foreach (Partial::all() as $partial) {
            $tree = $partial->getTwigNodeTree();
            $scanner->scanAST($tree, self::makeRelativePath($partial));
        }

        Log::info('Merging extracted messages with the current base file.');
        $translations = $scanner->getTranslations()[self::$defaultDomain];
        $translations->getHeaders()->set('Content-Type', 'text/plain; charset=utf-8');

        return $translations;
    }

    /**
     * Generates or regenerates the base PO file.
     *
     * @param array $translations A collection of translatable messages.
     * @return void
     */
    public static function generateBaseFile($messages)
    {
        Log::info('Generating the base file.');

        $poPath = self::$I18N_ROOT_PATH . '/po';
        if (!is_dir($poPath)) {
            Log::info('The base directory doesn\'t exist, creating.');
            mkdir($poPath, 0775, true);
        }

        if (file_exists(self::$baseFile)) {
            Log::info('File already exists; it will be merged and regenerated.');

            $loader = new PoLoader();
            $currentEntries = $loader->loadFile(self::$baseFile);

            $mergeStrategy = Merge::TRANSLATIONS_THEIRS | Merge::HEADERS_OURS | Merge::COMMENTS_OURS | Merge::REFERENCES_THEIRS;
            $messages = $currentEntries->mergeWith($messages, $mergeStrategy);
        }

        Log::info('Writing extracted messages to the base file.');
        $generator = new PoGenerator();
        $generator->generateFile($messages, self::$baseFile);
    }

    /**
     * Merges existing locale files with the base file.
     */
    public static function mergeLocaleFiles()
    {
        Log::info('Updating locale-specific files.');

        // List is configured in the admin panel (Translate > Manage Languages).
        $availableLocales = Locale::listAvailable();
        foreach ($availableLocales as $lang => $langName) {
            if ($lang == self::getDefaultLocale()) {
                continue;
            }

            $localePath = self::$I18N_ROOT_PATH . "/po/messages.$lang.po";

            $shellCommand = 'msgmerge -o ' . $localePath .' ' . $localePath . ' ' . self::$baseFile;
            Log::info('Running msgmerge as "' . $shellCommand . '"');
            $shellOutput = shell_exec($shellCommand);

            Log::info($shellOutput);
            Log::info('Successfully updated "' . $lang . '" translation; file ' . $localePath . ' has been written.');
        }

        Log::info('Finished message extraction.');
    }

    /**
     * Parses PO files and generates internal data for RainLab.Translate plugin.
     */
    public static function updateTranslation()
    {
        Log::info('Starting translation update.');

        $loader = new PoLoader();

        // List is configured in the admin panel (Translate > Manage Languages).
        $availableLocales = Locale::listAvailable();
        foreach ($availableLocales as $lang => $langName) {
            if ($lang == self::getDefaultLocale()) {
                continue;
            }

            $inputPath = self::$I18N_ROOT_PATH . "/po/messages.$lang.po";
            $outputPath = self::$I18N_ROOT_PATH . "/$lang.yaml";

            $inputFile = $loader->loadFile($inputPath);

            self::generateYamlFile($inputFile, $outputPath, true);
            Log::info('Successfully updated "' . $lang . '" translation; file ' . $outputPath . ' has been written.');
        }

        self::refreshDatabase();

        Log::info('Finished translation update.');
    }

    /**
     * Translates the given message to the current locale. Does nothing if it's default locale.
     *
     * @param string $message The original message to translate.
     * @return string The translated message.
     */
    public static function translate($message)
    {
        if (Message::$locale == self::getDefaultLocale()) {
            return $message;
        }

        // Possibly sanitize the message beforehand to exclude any HTML tags.
        // Non-alphanumeric characters are removed by this regardless.
        $translationKey = self::generateTranslationKey($message);

        // Translated messages can contain HTML tags.
        // We trust that strings are sanitized via Weblate
        // (https://docs.weblate.org/en/latest/user/checks.html#unsafe-html).
        $translatedMessage = Message::trans($translationKey, [], null);

        // Message was not translated, fallback to the English variant.
        if ($translatedMessage == $translationKey)
        {
            return $message;
        }
        return Message::trans($translationKey, [], null);
    }
}
