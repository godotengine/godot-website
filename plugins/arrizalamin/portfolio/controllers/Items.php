<?php namespace ArrizalAmin\Portfolio\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use ArrizalAmin\Portfolio\Models\Item;
use Lang;

/**
 * Items Back-end Controller
 */
class Items extends Controller
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

        BackendMenu::setContext('ArrizalAmin.Portfolio', 'portfolio', 'items');
    }

    public function index_onDelete()
    {
        if ($checkedIds = post('checked')) {
            foreach ($checkedIds as $itemId) {
                if (! $table = Item::find($itemId))
                    continue;
                $table->delete();
            }

            Flash::success(Lang::get('backend::lang.form.delete_success', ['name' => Lang::get('arrizalamin.portfolio::lang.controller.form.items.title')]));
        }

        return $this->listRefresh();
    }
}