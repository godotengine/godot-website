<?php namespace SerenityNow\Cacheroute\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Artisan;
use Flash;

class CacheRoutes extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\ReorderController'
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = [
        'serenitynow.cacheroute.manage_cacheroute'
    ];

    /**
     * CacheRoutes constructor.
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('SerenityNow.Cacheroute', 'CacheRoute');
    }

    /**
     *
     */
    public function onClear()
    {
        Artisan::call('cache:clear');
        Flash::success('ALL cached content cleared');
    }
}
