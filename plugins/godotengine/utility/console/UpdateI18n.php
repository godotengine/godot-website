<?php namespace GodotEngine\Utility\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Cms\Classes\Page;
use Cms\Classes\Theme;
use Cms\Classes\Layout;
use Cms\Classes\Partial;
use System\Helpers\Cache as CacheHelper;
use Symfony\Component\Yaml\Yaml;
use RainLab\Translate\Models\Locale;
use RainLab\Translate\Models\Message;
use RainLab\Translate\Classes\ThemeScanner;
use GodotEngine\Utility\Classes\TranslationHelper;
use \Gettext\Loader\PoLoader;

class UpdateI18n extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'godotengine:updatei18n';

    /**
     * @var string The console command description.
     */
    protected $description = 'Parse PO files and generate internal data for RainLab Translate plugin.';

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
        $this->output->writeln('Starting translation update.');

        $loader = new PoLoader();

        // List is configured in the admin panel (Translate > Manage Languages).
        $availableLocales = Locale::listAvailable();
        foreach ($availableLocales as $lang => $langName) {
            if ($lang == Locale::getDefault()->code) {
                continue;
            }

            $inputPath = "themes/godotengine/i18n/po/messages.$lang.po";
            $outputPath = "themes/godotengine/i18n/$lang.yaml";

            $inputFile = $loader->loadFile($inputPath);
            $yamlData = [];

            foreach ($inputFile->getTranslations() as $entry) {
                $originalMessage = $entry->getOriginal();
                $translatedMessage = $entry->getTranslation();

                $translationKey = TranslationHelper::generateTranslationKey($originalMessage);
                $yamlData[$translationKey] = $translatedMessage;
            }

            file_put_contents($outputPath, Yaml::dump($yamlData));
            $this->output->writeln('Successfully updated "' . $lang . '" translation; file ' . $outputPath . ' has been written.');
        }

        $this->output->writeln('Updating translation database.');
        Message::truncate();
        ThemeScanner::scan();

        $this->output->writeln('Flushing CMS cache.');
        CacheHelper::clear();

        $this->output->writeln('Finished translation update.');
    }
}
