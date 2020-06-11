<?php namespace PaulVonZimmerman\Patreon;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
      return [
        'PaulVonZimmerman\Patreon\Components\Goal' => 'Goal'
      ];
    }

    public function registerSettings()
    {
      return [
        'settings' => [
            'label'       => 'Patreon Settings',
            'description' => 'Set your patreon client_id and client_secret',
            'icon'        => 'icon-money',
            'class'       => 'PaulVonZimmerman\Patreon\Models\Settings',
            'order'       => 0,
            'keywords'    => 'security location',
            'permissions' => ['paulvonzimmerman.patreon.access_settings']
        ]
    ];
    }
}
