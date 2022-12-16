<?php namespace GodotEngine\Utility\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use System\Classes\SettingsManager;
use System\Classes\UpdateManager;

class Utilities extends Controller
{
    /**
     * A list of permissions required to access this controller.
     */
	public $requiredPermissions = ['system.manage_updates'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('GodotEngine.Utility', 'utilities');
	}

    /**
     * An entry point for the index page of this controller.
     */
    public function index()
    {
        $this->pageTitle = 'Godot Utilities';
    }

    /**
     * An AJAX handler for the "Perform Migration" button.
     */
    public function onWinterMigrate()
    {
        $updateManager = UpdateManager::instance();
        $updateManager->resetNotes();
        $updateManager->update();

        $this->vars['logs'] = $updateManager->getNotes();

        return $this->makePartial('migrate_logs');
    }
}
