<?php namespace PaulVonZimmerman\Patreon\Models;

use Model;

/**
 * Model
 */
class Settings extends Model
{
    // Settings
    public $implement = ['System.Behaviors.SettingsModel'];

    // Settings field & Code
    public $settingsFields = 'fields.yaml';
    public $settingsCode = 'paulvonzimmerman_patreon_system_settings';
}
