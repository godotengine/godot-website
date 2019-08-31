<?php namespace ArrizalAmin\Portfolio\Components;

use Cms\Classes\ComponentBase;
use ArrizalAmin\Portfolio\Models\Item;
use ArrizalAmin\Portfolio\Models\Category;
use ArrizalAmin\Portfolio\Models\Tag;
use Cms\Classes\Page;
use Lang;

class Portfolio extends ComponentBase
{
    /**
     * Collection of the portfolio items to display
     *
     * @var Collection
     */
    public $portfolio;

    /**
     * Reference to the item page to link items to
     *
     * @var String
     */
    public $itemPage;

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

    /**
     * Component Details
     *
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'arrizalamin.portfolio::lang.components.portfolio.name',
            'description' => 'arrizalamin.portfolio::lang.components.portfolio.description'
        ];
    }

    /**
     * Define component properties
     *
     * @return array
     */
    public function defineProperties()
    {
        return [
            'category' => [
                'title' => 'arrizalamin.portfolio::lang.components.portfolio.properties.category.title',
                'type' => 'dropdown',
                'default' => '1',
                'placeholder' => 'arrizalamin.portfolio::lang.components.portfolio.properties.category.placeholder'
            ],
            'itemsPerPage' => [
                'title'             => 'arrizalamin.portfolio::lang.components.portfolio.properties.itemsPerPage.title',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'arrizalamin.portfolio::lang.components.portfolio.properties.itemsPerPage.validationMessage',
                'default'           => '6',
            ],
            'order' => [
                'title' => 'arrizalamin.portfolio::lang.components.portfolio.properties.order.title',
                'placeholder' => 'arrizalamin.portfolio::lang.components.portfolio.properties.order.placeholder',
                'type' => 'dropdown',
                'default' => 'asc'
            ],
            'pageNumber' => [
                'title' => 'arrizalamin.portfolio::lang.components.portfolio.properties.pageNumber.title',
                'description' => 'arrizalamin.portfolio::lang.components.portfolio.properties.pageNumber.description',
                'type' => 'string',
                'default' => '{{ :page }}',
                'group' => 'arrizalamin.portfolio::lang.components.portfolio.properties.group.advanced'
            ],
            'selectedTag' => [
                'title' => 'arrizalamin.portfolio::lang.components.portfolio.properties.selectedTag.title',
                'description' => 'arrizalamin.portfolio::lang.components.portfolio.properties.selectedTag.description',
                'type' => 'string',
                'default' => '{{ :selected_tag }}',
                'group' => 'arrizalamin.portfolio::lang.components.portfolio.properties.group.advanced'
            ],
            'selectedCat' => [
                'title' => 'arrizalamin.portfolio::lang.components.portfolio.properties.selectedCat.title',
                'description' => 'arrizalamin.portfolio::lang.components.portfolio.properties.selectedCat.description',
                'type' => 'string',
                'default' => '{{ :selected_cat }}',
                'group' => 'arrizalamin.portfolio::lang.components.portfolio.properties.group.advanced'
            ],
            'catListPage' => [
                'title'       => 'arrizalamin.portfolio::lang.components.portfolio.properties.catListPage.title',
                'description' => 'arrizalamin.portfolio::lang.components.portfolio.properties.catListPage.description',
                'type'        => 'dropdown',
                'default'     => 'portfolio/category',
                'group'       => 'arrizalamin.portfolio::lang.components.portfolio.properties.group.links',
            ],
            'itemPage' => [
                'title'       => 'arrizalamin.portfolio::lang.components.portfolio.properties.itemPage.title',
                'description' => 'arrizalamin.portfolio::lang.components.portfolio.properties.itemPage.description',
                'type'        => 'dropdown',
                'default'     => 'portfolio/item',
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
     * Get options for the category dropdown
     *
     * @return mixed
     */
    public function getCategoryOptions()
    {
        $categories = Category::lists('name', 'id');
        $categories[0] = Lang::get('arrizalamin.portfolio::lang.components.portfolio.properties.category.all');
        return $categories;
    }

    /**
     * Get options for the order dropdown
     *
     * @return array
     */
    public function getOrderOptions()
    {
        return [
            'asc' => Lang::get('arrizalamin.portfolio::lang.components.portfolio.properties.order.ascending'),
            'desc' => Lang::get('arrizalamin.portfolio::lang.components.portfolio.properties.order.descending')
        ];
    }

    /**
     * Get options for the dropdown where the link to the item page can be selected
     *
     * @return mixed
     */
    public function getItemPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
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

    /**
     * When running this component, load all items based on the selections.
     */
    public function onRun()
    {
        // Page links
        $this->itemPage = $this->page['itemPage'] = $this->property('itemPage');
        $this->tagListPage = $this->page['tagListPage'] = $this->property('tagListPage');
        $this->catListPage = $this->page['catListPage'] = $this->property('catListPage');

        // find the correct property to select the items with
        $object = null;
        if($this->property('selectedTag') != null){
            $object = $this->loadItemsByTag($this->property('selectedTag'));
        }elseif($this->property('selectedCat') != null){
            $object = $this->loadItemsByCategory($this->property('selectedCat'), true);
        }elseif($this->property('category') != null) {
            $object = $this->loadItemsByCategory($this->property('category'));
        }

        // check if a valid object has been created
        if( !$object ){
            // display all items
            $this->portfolio = Item::paginate($this->property('itemsPerPage'), $this->property('pageNumber'));
        }else{
            // show the items in the portfolio
            $this->portfolio = $object->items()
                ->orderBy('created_at', $this->property('order'))->paginate($this->property('itemsPerPage'), $this->property('pageNumber'));
        }

        // Add url helper to the items
        if($this->portfolio != null) {
            $this->portfolio = $this->updatePageUrls($this->portfolio);
        }
    }

    /**
     * Get the selected category object for further processing.
     *
     * @param $selectedCategory
     * @param bool|false $bySlug
     * @return mixed
     */
    protected function loadItemsByCategory($selectedCategory, $bySlug = false)
    {
        if($bySlug){
            $category = Category::where('slug', '=', $selectedCategory)->first();
        }else{
            $category = Category::find($selectedCategory);
        }

        return $category;
    }

    /**
     * Get the selected tag object for processing
     *
     * @param $selectedTag
     * @return mixed
     */
    protected function loadItemsByTag($selectedTag)
    {
        $tag = Tag::where('name', '=', $selectedTag)->first();
        return $tag;
    }

    /**
     * Add PageUrl helpers to all items which can be linked to a
     * dedicated page to display the item.
     *
     * @param $items
     * @return mixed
     */
    protected function updatePageUrls($items)
    {
        //Add a "url" helper attribute for linking to each item
        $items->each(function($item)
        {
            $item->setPageUrl($this->itemPage, $this->controller);

            $item->tags->each(function ($tag) {
                $tag->setPageUrl($this->tagListPage, $this->controller);
            });

            $item->category->setPageUrl($this->catListPage, $this->controller);
        });

        return $items;
    }
}
