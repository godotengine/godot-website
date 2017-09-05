<?php namespace AnandPatel\WysiwygEditors\models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'anandpatel_wysiwygeditors_settings';

    public $settingsFields = 'fields.yaml';

    protected $cache = [];
}
