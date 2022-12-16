<?php namespace GodotEngine\I18n\Controllers;

use BackendMenu;
use Flash;
use Redirect;
use Backend\Classes\Controller;
use System\Classes\SettingsManager;
use GodotEngine\I18n\Classes\TranslationManager;
use GodotEngine\I18n\Classes\TranslationExtractor;

class Manage extends Controller
{
    /**
     * A list of permissions required to access this controller.
     */
	public $requiredPermissions = ['rainlab.translate.manage_messages'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('GodotEngine.I18n', 'manage');

        $this->addCss('/plugins/godotengine/i18n/assets/css/manage.css');
	}

    /**
     * An entry point for the index page of this controller.
     */
    public function index()
    {
        $this->pageTitle = 'Godot I18n';

        $this->vars['defaultLocale'] = TranslationManager::getDefaultLocale();
        $this->vars['cmsLocales'] = TranslationManager::getCMSLocales();
        $this->vars['poValid'] = TranslationManager::isSetupValid();
        $this->vars['poLocales'] = TranslationManager::getLocales();
    }

    /**
     * An AJAX handler for the "Setup" button.
     */
    public function onSetup()
    {
        $messages = TranslationExtractor::extractMessages();
        TranslationManager::generateBaseFile($messages);

        Flash::success('First-time setup complete!');
        return Redirect::refresh();
    }

    /**
     * An AJAX handler for the "Refresh Locales" button.
     */
    public function onSyncLocales()
    {
        TranslationManager::restoreLocales();
        TranslationManager::restoreCMSLocales();

        Flash::success('CMS locales and PO files are synced!');
        return Redirect::refresh();
    }

    /**
     * An AJAX handler for the "Extract Messages" button.
     */
    public function onExtractMessages()
    {
        $messages = TranslationExtractor::extractMessages();
        TranslationManager::generateBaseFile($messages);
        TranslationManager::updateLocaleFiles();

        Flash::success('Messages successfully extracted!');
        return Redirect::refresh();
    }

    /**
     * An AJAX handler for the "Update Translation" button.
     */
    public function onUpdateTranslation()
    {
        TranslationManager::updateTranslation();

        Flash::success('Translation successfully updated!');
        return Redirect::refresh();
    }

    /**
     * Checks if the initial setup needs to be performed.
     */
    public function isSetupValid()
    {
        return TranslationManager::isSetupValid();
    }
}
