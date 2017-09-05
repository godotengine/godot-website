<?php namespace ShahiemSeymor\Bbcode\Models;

use Model;

class Settings extends Model
{
	
    public $implement      = ['System.Behaviors.SettingsModel'];
    public $settingsCode   = 'bbcode_settings';
    public $settingsFields = 'fields.yaml';

}