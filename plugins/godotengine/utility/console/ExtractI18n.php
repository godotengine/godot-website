<?php namespace GodotEngine\Utility\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Cms\Classes\Page;
use Cms\Classes\Theme;
use Cms\Classes\Layout;
use Cms\Classes\Partial;
use RainLab\Translate\Models\Locale;
use GodotEngine\Utility\Classes\TwigMarkupScanner;
use \Gettext\Translations;
use \Gettext\Generator\PoGenerator;
use \Gettext\Loader\PoLoader;
use \Gettext\Merge;

class ExtractI18n extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'godotengine:extracti18n';

    /**
     * @var string The console command description.
     */
    protected $description = 'Extract translation messages and their codes and generate PO files.';

    /**
     * @var string The default domain name for extracted messages (used only internally).
     */
    private $defaultDomain = 'default';

    /**
     * @var string The base file for all localized PO files.
     */
    private $baseFile = 'themes/godotengine/i18n/po/messages.po';

    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        $this->output->writeln('Starting message extraction.');

        $scanner = new TwigMarkupScanner(
            Translations::create($this->defaultDomain)
        );
        $scanner->setDefaultDomain($this->defaultDomain);


        $this->output->writeln('Scanning Layout files.');
        foreach (Layout::all() as $layout) {
            $tree = $layout->getTwigNodeTree();
            $scanner->scanAST($tree, $this->getRelativePath($layout));
        }

        $this->output->writeln('Scanning Page files.');
        foreach (Page::all() as $page) {
            $tree = $page->getTwigNodeTree();
            $scanner->scanAST($tree, $this->getRelativePath($page));
        }

        $this->output->writeln('Scanning Partial files.');
        foreach (Partial::all() as $partial) {
            $tree = $partial->getTwigNodeTree();
            $scanner->scanAST($tree, $this->getRelativePath($partial));
        }

        $this->output->writeln('Merging extracted messages with the current base file.');
        $translations = $scanner->getTranslations()[$this->defaultDomain];
        $translations->getHeaders()->set('Content-Type', 'text/plain; charset=utf-8');

        $loader = new PoLoader();
        $currentEntries = $loader->loadFile($this->baseFile);

        $mergeStrategy = Merge::TRANSLATIONS_THEIRS | Merge::HEADERS_OURS | Merge::COMMENTS_OURS | Merge::REFERENCES_THEIRS;
        $finalTranslations = $currentEntries->mergeWith($translations, $mergeStrategy);

        $this->output->writeln('Writing extracted messages to the base file.');
        $generator = new PoGenerator();
        $generator->generateFile($finalTranslations, $this->baseFile);

        $this->output->writeln('Updating locale-specific files.');
        
        // List is configured in the admin panel (Translate > Manage Languages).
        $availableLocales = Locale::listAvailable();
        foreach ($availableLocales as $lang => $langName) {
            if ($lang == Locale::getDefault()->code) {
                continue;
            }

            $localePath = "themes/godotengine/i18n/po/messages.$lang.po";
            $shellCommand = 'msgmerge -o ' . $localePath .' ' . $localePath . ' ' . $this->baseFile;
            $shellOutput = shell_exec($shellCommand);
            $this->output->writeln($shellOutput);
            $this->output->writeln('Successfully updated "' . $lang . '" translation; file ' . $localePath . ' has been written.');
        }

        $this->output->writeln('Finished message extraction.');
    }

    function getRelativePath($object)
    {
        return $object->theme->getDirName() . '/' . $object->getObjectTypeDirName() . '/' . $object->getFileName();
    }
}
