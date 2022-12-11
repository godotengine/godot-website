<?php
namespace GodotEngine\I18n;

use Backend;
use RainLab\Translate\Models\Locale;
use GodotEngine\I18n\Classes\TranslationManager;

class Plugin extends \System\Classes\PluginBase
{
    public $require = ['Rainlab.Translate'];

    public function pluginDetails()
    {
        return [
            'name' => 'GodotEngine I18n',
            'description' => 'Enables internationalization of the Godot Engine website.',
            'author' => 'Godot Engine',
            'icon' => 'icon-language',
            'homepage' => 'https://godotengine.org'
        ];
    }

    public function registerSettings()
    {
        return [
            'manage' => [
                'label'       => 'Godot I18n',
                'description' => 'Manage internationalization of the Godot Engine website.',
                'category'    => 'rainlab.translate::lang.plugin.name', /* Groups the menu nicely with Rainlab.Translate. */
                'icon'        => 'icon-globe',
                'url'         => Backend::url('godotengine/i18n/manage'),
                'order'       => 500,
                'permissions' => ['rainlab.translate.manage_messages'], /* Use Rainlab.Translate's permissions for synergy. */
            ]
        ];
    }

    public function registerMarkupTags()
    {
        return [
            'functions' => [
                'TR' => function ($message) {
                    return TranslationManager::translate($message);
                },

                'getDefaultLocale' => function() {
                    return TranslationManager::getDefaultLocale();
                },
                'getCurrentLocale' => function() {
                    return TranslationManager::getCurrentLocale();
                },
            ]
        ];
    }

    public function register()
    {
        Locale::extend(function ($model) {
            $model->bindEvent('model.afterSave', function() use ($model) {
                TranslationManager::createLocale($model->code);
            });
        });
    }
}
