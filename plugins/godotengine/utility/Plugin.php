<?php
namespace GodotEngine\Utility;

class Plugin extends \System\Classes\PluginBase
{
    public $require = ['Rainlab.Translate'];

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
        $this->registerConsoleCommand('godotengine.extracti18n', 'GodotEngine\Utility\Console\ExtractI18n');
        $this->registerConsoleCommand('godotengine.updatei18n', 'GodotEngine\Utility\Console\UpdateI18n');
        $this->registerConsoleCommand('godotengine.addi18n', 'GodotEngine\Utility\Console\AddI18n');
    }

    public function registerMarkupTags()
    {
        return [
            'functions' => [
                'TR' => function($msg) { return $msg; }
            ]
        ];
    }
}
