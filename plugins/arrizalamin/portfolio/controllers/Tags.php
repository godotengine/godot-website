<?php namespace ArrizalAmin\Portfolio\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use ArrizalAmin\Portfolio\Models\Tag;
use Lang;

/**
 * Categories Back-end Controller
 */
class Tags extends Controller
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

        BackendMenu::setContext('ArrizalAmin.Portfolio', 'portfolio', 'tags');
    }

    /**
     * Delete tags
     *
     * @return mixed $this->listRefresh()
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds))
            $delete = Tag::whereIn('id', $checkedIds)->delete();

        if(!isset($delete) && !$delete)
            return Flash::error('An unknown error has occured.');

        Flash::success(Lang::get('backend::lang.form.delete_success', ['name' => Lang::get('arrizalamin.portfolio::lang.controller.form.tags.title')]));

        return $this->listRefresh();
    }

    /**
     * Removes tags with no associated posts
     *
     * @return  $this->listRefresh()
     */
    public function index_onRemoveOrphanedTags()
    {
        if (!$delete = Tag::has('items', 0)->delete())
            return Flash::error('An unknown error has occured.');

        Flash::success('Successfully deleted orphaned tags.');

        return $this->listRefresh();
    }
}