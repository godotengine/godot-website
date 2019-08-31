<?php namespace RainLab\Blog\Classes;

use Cms\Classes\Page;
use Cms\Classes\Theme;
use Cms\Classes\ComponentBase;

abstract class ComponentAbstract extends ComponentBase
{
    /**
     * Reference to the page name for linking to posts
     *
     * @var string
     */
    public $postPage;

    /**
     * Reference to the page name for linking to categories
     *
     * @var string
     */
    public $categoryPage;

    /**
     * @param string $componentName
     * @param string $page
     * @return ComponentBase|null
     */
    protected function getComponent(string $componentName, string $page)
    {
        $component = null;

        $page = Page::load(Theme::getActiveTheme(), $page);

        if (!is_null($page)) {
            $component = $page->getComponent($componentName);
        }

        return $component;
    }

    /**
     * A helper function to get the real URL parameter name. For example, slug for posts
     * can be injected as :post into URL. Real argument is necessary if you want to generate
     * valid URLs for such pages
     *
     * @param ComponentBase|null $component
     * @param string $name
     *
     * @return string|null
     */
    protected function urlProperty(ComponentBase $component = null, string $name = '')
    {
        $property = null;

        if ($component !== null && ($property = $component->property($name))) {
            preg_match('/{{ :([^ ]+) }}/', $property, $matches);

            if (isset($matches[1])) {
                $property = $matches[1];
            }
        } else {
            $property = $name;
        }

        return $property;
    }
}
