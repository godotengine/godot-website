<?php namespace RainLab\Translate\Classes;

/**
 * Represents a multi-lingual Static Page object.
 *
 * @package rainlab\translate
 * @author Alexey Bobkov, Samuel Georges
 */
class MLStaticPage extends MLCmsObject
{
    /**
     * @var bool Wrap code section in PHP tags.
     */
    protected $wrapCode = false;

    /**
     * @var array List of attribute names which are not considered "settings".
     */
    protected $purgeable = ['placeholders'];

    /**
     * {@inheritDoc}
     */
    public function afterFetch()
    {
        parent::afterFetch();

        $this->getPlaceholdersAttribute();
    }

    /**
     * Parses the page placeholder {% put %} tags and extracts the placeholder values.
     * @return array Returns an associative array of the placeholder names and values.
     */
    public function getPlaceholdersAttribute()
    {
        if (!strlen($this->code)) {
            return [];
        }

        if ($placeholders = array_get($this->attributes, 'placeholders')) {
            return $placeholders;
        }

        $bodyNode = $this->getTwigNodeTree($this->code)->getNode('body')->getNode(0);
        if ($bodyNode instanceof \Cms\Twig\PutNode) {
            $bodyNode = [$bodyNode];
        }

        $result = [];
        foreach ($bodyNode as $node) {
            if (!$node instanceof \Cms\Twig\PutNode) {
                continue;
            }

            $bodyNode = $node->getNode('body');
            $result[$node->getAttribute('name')] = trim($bodyNode->getAttribute('data'));
        }

        $this->attributes['placeholders'] = $result;

        return $result;
    }

    /**
     * Takes an array of placeholder data (key: code, value: content) and renders
     * it as a single string of Twig markup against the "code" attribute.
     * @param array  $value
     * @return void
     */
    public function setPlaceholdersAttribute($value)
    {
        if (!is_array($value)) {
            return;
        }

        $placeholders = $value;
        $result = '';

        foreach ($placeholders as $code => $content) {
            if (!strlen($content)) {
                continue;
            }

            $result .= '{% put '.$code.' %}'.PHP_EOL;
            $result .= $content.PHP_EOL;
            $result .= '{% endput %}'.PHP_EOL;
            $result .= PHP_EOL;
        }

        $this->attributes['code'] = trim($result);
        $this->attributes['placeholders'] = $placeholders;
    }
}
