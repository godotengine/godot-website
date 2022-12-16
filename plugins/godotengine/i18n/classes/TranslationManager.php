<?php

namespace GodotEngine\I18n\Classes;

use App;
use Str;
use Log;
use Cms\Classes\Theme;
use System\Helpers\Cache as CacheHelper;
use Symfony\Component\Yaml\Yaml;
use RainLab\Translate\Models\Locale;
use RainLab\Translate\Models\Message;
use RainLab\Translate\Classes\ThemeScanner;
use \Gettext\Generator\PoGenerator;
use \Gettext\Languages\Language;
use \Gettext\Loader\PoLoader;
use \Gettext\Merge;
use ApplicationException;

/**
 * A manager/helper class for working with translation resources (PO, POT),
 * as well as extrating strings from October's Twig templates.
 *
 * Refer to https://github.com/php-gettext/Gettext/ for Gettext/PO reference.
 */

class TranslationManager
{
    /**
     * @var string The base path of all i18n files.
     */
    private static $I18N_ROOT_PATH = 'themes/godotengine/i18n';

    /**
     * @var string The base file for all localized PO files.
     */
    private static $baseFile = 'themes/godotengine/i18n/po/messages.pot';

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
     * Generates a locale object for the given locale, that can then be saved with PoGenerator.
     *
     * @return \Gettext\Translations
     */
    private static function generateLocaleFile($lang)
    {
        $loader = new PoLoader();
        // We use the base file as a... base.
        $localeFile = $loader->loadFile(self::$baseFile);

        $localeFile = self::generateMetadata($localeFile, $lang);
        $localeFile->setLanguage($lang);

        return $localeFile;
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
     * Updates the theme configuration file with the newly added locale.
     *
     * @return void
     */
    private static function updateThemeConfig($lang)
    {
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
        $poFile = self::generateLocaleFile($lang);

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

        self::updateThemeConfig($lang);

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
        if (!is_dir($poPath))
        {
            return $locales;
        }

        $poDir = dir($poPath);
        $poDir->rewind();

        while (($fileName = $poDir->read()) !== false){
            $filePath = $poPath . '/' . $fileName;
            $fileInfo = pathinfo($filePath);
            if ($fileInfo['extension'] !== 'po')
            {
                continue;
            }

            $loader = new PoLoader();
            $poFile = $loader->loadFile($filePath);

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
     * Enhances the given language file with metadata, such as description, headers, etc.
     *
     * @return void
     */
    private static function generateMetadata($translations, $lang = null)
    {
        $languageName = 'LANGUAGE';
        if ($lang !== null)
        {
            $languageInfo = Language::getById($lang);

            if (!empty($languageInfo)) {
                $languageName = $languageInfo->name;
            }
        }

        $description = "
$languageName translation of the Godot Engine class reference.
Copyright (c) 2007-2022 Juan Linietsky, Ariel Manzur.
Copyright (c) 2014-2022 Godot Engine contributors (cf. https://github.com/godotengine/godot/blob/master/AUTHORS.md).
This file is distributed under the same license as the Godot source code.
        ";
        $translations->setDescription(trim($description));

        $translations->getHeaders()->set('Project-Id-Version', 'Godot Engine official website');
        $translations->getHeaders()->set('Report-Msgid-Bugs-To', 'https://github.com/godotengine/godot-website');
        $translations->getHeaders()->set('MIME-Version', '1.0');
        $translations->getHeaders()->set('Content-Type', 'text/plain; charset=utf-8');
        $translations->getHeaders()->set('Content-Transfer-Encoding', '8-bit');

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

        Log::info('Setting up meta information.');
        $messages = self::generateMetadata($messages);

        $poPath = self::$I18N_ROOT_PATH . '/po';
        if (!is_dir($poPath)) {
            Log::info('The base directory doesn\'t exist, creating.');
            mkdir($poPath, 0775, true);
        }

        if (file_exists(self::$baseFile)) {
            Log::info('File already exists; it will be merged and regenerated.');

            $loader = new PoLoader();
            $currentEntries = $loader->loadFile(self::$baseFile);

            Log::info('Merging extracted messages with the current base file.');
            $mergeStrategy = Merge::TRANSLATIONS_OURS | Merge::HEADERS_THEIRS | Merge::COMMENTS_THEIRS | Merge::REFERENCES_OURS;
            $messages = $messages->mergeWith($currentEntries, $mergeStrategy);
        }

        Log::info('Writing extracted messages to the base file.');
        $generator = new PoGenerator();
        $generator->generateFile($messages, self::$baseFile);
    }

    /**
     * Merges existing locale files with the base file.
     *
     * @return void
     */
    public static function updateLocaleFiles()
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
