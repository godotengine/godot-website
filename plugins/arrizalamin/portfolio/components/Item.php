<?php namespace ArrizalAmin\Portfolio\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Lang;
use ArrizalAmin\Portfolio\Models\Item as PortfolioItem;

class Item extends ComponentBase
{
    /**
     * Value holds the selected item to display
     * @var
     */
    public $item;

    /**
     * Reference to the page where tagged items are displayed
     *
     * @var String;
     */
    public $tagListPage;

    /**
     * Reference to the page where items of a category are displayed
     *
     * @var
     */
    public $catListPage;


    public function componentDetails()
    {
        return [
            'name'        => 'arrizalamin.portfolio::lang.components.item.name',
            'description' => 'arrizalamin.portfolio::lang.components.item.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'item' => [
                'title'       => 'arrizalamin.portfolio::lang.components.item.properties.item.title',
                'description' => 'arrizalamin.portfolio::lang.components.item.properties.item.description',
                'type'        => 'dropdown',
                'default'     => '1',
            ],
            'itemSlug' => [
                'title'       => 'arrizalamin.portfolio::lang.components.item.properties.itemSlug.title',
                'description' => 'arrizalamin.portfolio::lang.components.item.properties.itemSlug.description',
                'type'        => 'string',
                'default'     => '{{ :item_slug }}',
                'group'       => 'arrizalamin.portfolio::lang.components.portfolio.properties.group.advanced',
            ],
            'catListPage' => [
                'title'       => 'arrizalamin.portfolio::lang.components.portfolio.properties.catListPage.title',
                'description' => 'arrizalamin.portfolio::lang.components.portfolio.properties.catListPage.description',
                'type'        => 'dropdown',
                'default'     => 'portfolio/category',
                'group'       => 'arrizalamin.portfolio::lang.components.portfolio.properties.group.links',
            ],
            'tagListPage' => [
                'title'       => 'arrizalamin.portfolio::lang.components.portfolio.properties.tagListPage.title',
                'description' => 'arrizalamin.portfolio::lang.components.portfolio.properties.tagListPage.description',
                'type'        => 'dropdown',
                'default'     => 'portfolio/tag',
                'group'       => 'arrizalamin.portfolio::lang.components.portfolio.properties.group.links',
            ],
        ];
    }

    /**
     * Get options for the item dropdown
     *
     * @return mixed
     */
    public function getItemOptions()
    {
        $categories = PortfolioItem::lists('title', 'slug');
        $categories[0] = Lang::get('arrizalamin.portfolio::lang.components.item.properties.item.none');
        return $categories;
    }

    /**
     * Get options for the dropdown where the link to the tag list page can be selected
     *
     * @return mixed
     */
    public function getTagListPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    /**
     * Get options for the dropdown where the link to the category list page can be selected
     *
     * @return mixed
     */
    public function getCatListPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        // Page links
        $this->tagListPage = $this->page['tagListPage'] = $this->property('tagListPage');
        $this->catListPage = $this->page['catListPage'] = $this->property('catListPage');

        // find the correct property to select the items with
        $object = null;
        if($this->property('itemSlug') != null && $this->property('itemSlug') != 'default'){
            $object = $this->loadItemBySlug($this->property('itemSlug'));
        }elseif ($this->property('item') != null && $this->property('item') != 'None') {
            $object = $this->loadItemBySlug($this->property('item'));
        }

        // check if a valid object has been created
        if( !$object ){
            // todo : throw error
            $this->item = null;
        }else{
            // show the items in the portfolio
            $this->item = $object;
        }

        // Add url helper to the items
        if($this->item != null) {
            $this->item = $this->updatePageUrls($this->item);
        }
    }

    /**
     * Load the selected item by its slug
     *
     * @param $selectedItem
     * @return mixed
     */
    protected function loadItemBySlug($selectedItem)
    {
        $item = PortfolioItem::where('slug', '=', $selectedItem)->first();
        return $item;
    }

    /**
     * Add PageUrl helpers to all items which can be linked to a
     * dedicated page to display the item.
     *
     * @param $item
     * @return mixed
     */
    protected function updatePageUrls($item)
    {
        // add to tags
        $item->tags->each(function ($tag) {
            $tag->setPageUrl($this->tagListPage, $this->controller);
        });

        // add to category
        $item->category->setPageUrl($this->catListPage, $this->controller);

        return $item;
    }

}
