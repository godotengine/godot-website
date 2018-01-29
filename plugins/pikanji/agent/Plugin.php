<?php namespace Pikanji\Agent;

use System\Classes\PluginBase;
use Illuminate\Foundation\AliasLoader;
use App;

/**
 * Agent Plugin Information File
 */
class Plugin extends PluginBase
{
    public function boot()
    {
        // Enable jessengers/agent package and register Agent facade.
        App::register('Jenssegers\Agent\AgentServiceProvider');
        AliasLoader::getInstance()->alias('Agent', 'Jenssegers\Agent\Facades\Agent');
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Pikanji\Agent\Components\Agent' => 'Agent',
        ];
    }
}
