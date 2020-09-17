<?php namespace GodotEngine\Utility\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Cms\Classes\Theme;
use GodotEngine\Utility\Classes\TranslationHelper;
use \Gettext\Generator\PoGenerator;
use \Gettext\Loader\PoLoader;

class AddI18n extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'godotengine:addi18n';

    /**
     * @var string The console command description.
     */
    protected $description = 'Generate the necessary files for a new translation.';

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
        return [
            ['lang', InputArgument::REQUIRED, 'The locale language code.'],
        ];
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
        $lang = $this->argument('lang');
        $this->output->writeln('Adding "' . $lang . '" translation.');

        $loader = new PoLoader();
        $baseFile = $loader->loadFile($this->baseFile);
        $baseFile->getHeaders()->set('Language', $lang);

        $poPath = "themes/godotengine/i18n/po/messages.$lang.po";
        $yamlPath = "themes/godotengine/i18n/$lang.yaml";

        if (!file_exists($poPath))
        {
            $this->output->writeln('Writing translation PO file ' . $poPath . '.');
            $generator = new PoGenerator();
            $generator->generateFile($baseFile, $poPath);
        } else {
            $this->output->writeln('Skipped writing ' . $poPath . ' file; file exists.');
        }


        if (!file_exists($yamlPath))
        {
            $this->output->writeln('Writing translation YAML file ' . $yamlPath . '.');
            $yamlFile = fopen($yamlPath, 'w');

            foreach ($baseFile->getTranslations() as $entry) {
                $originalMessage = $entry->getOriginal();

                fwrite($yamlFile, TranslationHelper::generateTranslationKey($originalMessage) . ': ' . "\r\n");
            }

            fclose($yamlFile);
        } else {
            $this->output->writeln('Skipped writing ' . $yamlPath . ' file; file exists.');
        }

        $this->output->writeln('Updating Theme configuration.');
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

        $this->output->writeln('Successfully added "' . $lang . '" translation.');
    }
}
