<?php
namespace GodotEngine\Utility;

use Backend;
use System\Classes\SettingsManager;

class Plugin extends \System\Classes\PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'GodotEngine Utility',
            'description' => 'Provides utility functions for Godot Engine website.',
            'author' => 'Godot Engine',
            'icon' => 'icon-shower',
            'homepage' => 'https://godotengine.org'
        ];
    }

    public function registerSettings()
    {
        return [
            'utilities' => [
                'label'       => 'Godot Utilities',
                'description' => 'Various quick tools for managing this CMS.',
                'category'    => SettingsManager::CATEGORY_SYSTEM,
                'icon'        => 'icon-shower',
                'url'         => Backend::url('godotengine/utility/utilities'),
                'order'       => 600,
                'permissions' => ['system.manage_updates'],
            ]
        ];
    }

    public function register()
    {
        $this->registerConsoleCommand('godotengine.ping', 'GodotEngine\Utility\Console\Ping');
    }
}
