<?php namespace GodotEngine\Utility\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Cms\Classes\Page;
use Cms\Classes\Theme;
use Cms\Classes\Layout;
use Cms\Classes\Partial;
use System\Helpers\Cache as CacheHelper;
use RainLab\Translate\Models\Locale;
use RainLab\Translate\Models\Message;
use RainLab\Translate\Classes\ThemeScanner;
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
            // English is the default language and does not need to be translated.
            // In theory, this can be compared to the stored default value from the Translate plugin.
            // But we probably won't ever change the default to anything but English.
            if ($lang == 'en') {
                continue;
            }

            $inputPath = "themes/godotengine/i18n/po/messages.$lang.po";
            $outputPath = "themes/godotengine/i18n/$lang.yaml";

            $inputFile = $loader->loadFile($inputPath);
            $outputFile = fopen($outputPath, 'w');

            foreach ($inputFile->getTranslations() as $entry) {
                $originalMessage = $entry->getOriginal();
                $translatedMessage = $entry->getTranslation();

                fwrite($outputFile, Message::makeMessageCode($originalMessage) . ': ' . $translatedMessage . "\r\n");
            }

            fclose($outputFile);
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
