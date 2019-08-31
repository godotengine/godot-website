<?php namespace RainLab\Blog\Classes;

/**
 * Blog Markdown tag processor.
 *
 * @package rainlab\blog
 * @author Alexey Bobkov, Samuel Georges
 */
class TagProcessor
{
    use \October\Rain\Support\Traits\Singleton;

    /**
     * @var array Cache of processing callbacks.
     */
    private $callbacks = [];

    /**
     * Registers a callback function that handles blog post markup.
     * The callback function should accept two arguments - the HTML string
     * generated from Markdown contents and the preview flag determining whether
     * the function should return a markup for the blog post preview form or for the
     * front-end.
     * @param callable $callback A callable function.
     */
    public function registerCallback(callable $callback)
    {
        $this->callbacks[] = $callback;
    }

    public function processTags($markup, $preview)
    {
        foreach ($this->callbacks as $callback) {
            $markup = $callback($markup, $preview);
        }

        return $markup;
    }
}
