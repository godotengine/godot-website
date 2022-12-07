<?php
namespace GodotEngine\Utility;

class Plugin extends \System\Classes\PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'GodotEngine Utility',
            'description' => 'Provides utility functions for Godot Engine website.',
            'author' => 'Godot Engine',
            'icon' => 'icon-leaf',
            'homepage' => 'https://godotengine.org'
        ];
    }

    public function register()
    {
        $this->registerConsoleCommand('godotengine.ping', 'GodotEngine\Utility\Console\Ping');
    }
}
