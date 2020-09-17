<?php
namespace GodotEngine\Utility;

use Str;
use RainLab\Translate\Models\Locale;
use RainLab\Translate\Models\Message;
use GodotEngine\Utility\Classes\TranslationHelper;

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
                'TR' => function ($message) {
                    if (Message::$locale == Locale::getDefault()->code) {
                        return $message;
                    }
                    
                    // Possibly sanitize the message beforehand to exclude any HTML tags.
                    // Non-alphanumeric characters are removed by this regardless.
                    $translationKey = TranslationHelper::generateTranslationKey($message);
                    
                    // Translated messages can contain HTML tags.
                    // We trust that strings are sanitized via Weblate 
                    // (https://docs.weblate.org/en/latest/user/checks.html#unsafe-html).
                    $translatedMessage = Message::trans($translationKey, [], null);

                    // Message was not translated, fallback to the English variant.
                    if ($translatedMessage == $translationKey)
                    {
                        return $message;
                    }
                    return Message::trans($translationKey, [], null);
                },
            ]
        ];
    }
}
