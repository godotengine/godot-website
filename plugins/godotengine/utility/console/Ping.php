<?php namespace GodotEngine\Utility\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Ping extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'godotengine:ping';

    /**
     * @var string The console command description.
     */
    protected $description = 'Ping the plugin to make sure it is working.';

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
        $this->output->writeln('GodotEngine.Utility pongs in response!');
    }
}
