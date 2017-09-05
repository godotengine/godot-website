<?php namespace ArrizalAmin\Portfolio\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use ArrizalAmin\Portfolio\Models\Category;
use Lang;

/**
 * Categories Back-end Controller
 */
class Categories extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('ArrizalAmin.Portfolio', 'portfolio', 'categories');
    }

    public function index_onDelete()
    {
        if ($checkedIds = post('checked')) {
            foreach ($checkedIds as $itemId) {
                if (! $table = Category::find($itemId))
                    continue;
                $table->delete();
            }

            Flash::success(Lang::get('backend::lang.form.delete_success', ['name' => Lang::get('arrizalamin.portfolio::lang.controller.form.categories.title')]));
        }

        return $this->listRefresh();
    }
}