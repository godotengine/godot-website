<?php
/**
 * @copyright   2006-2014, Miles Johnson - http://milesj.me
 * @license     https://github.com/milesj/decoda/blob/master/license.md
 * @link        http://milesj.me/code/php/decoda
 */

namespace Decoda\Filter;

use Decoda\Decoda;
use Decoda\Component\AbstractComponent;
use Decoda\Exception\MissingFilterException;
use Decoda\Filter;

/**
 * A filter defines the list of tags and its associative markup to parse out of a string.
 * Supports a wide range of parameters to customize the output of each tag.
 */
abstract class AbstractFilter extends AbstractComponent implements Filter {

    /**
     * Default tag configuration.
     *
     * @type array
     */
    protected $_defaults = array(
        /**
         * tag              - (string) Decoda tag
         * htmlTag          - (string) HTML replacement tag
         * template         - (string) Template file to use for rendering
         * displayType      - (constant) Type of HTML element: block or inline
         * allowedTypes     - (constant) What types of elements are allowed to be nested
         * aliasFor         - (string) Inherits settings from another filter
         */
        'tag' => '',
        'htmlTag' => '',
        'template' => '',
        'displayType' => Decoda::TYPE_BLOCK,
        'allowedTypes' => Decoda::TYPE_BOTH,
        'aliasFor' => '',

        /**
         * attributes       - (array) Custom attributes to parse out of the Decoda tag
         * mapAttributes    - (array) Map parsed and custom attributes to HTML equivalent attribute names
         * htmlAttributes   - (array) Custom HTML attributes to append to the parsed tag
         * aliasAttributes  - (array) Custom attributes to alias to another attribute
         * escapeAttributes - (boolean) Escape HTML entities within the parsed attributes
         */
        'attributes' => array(),
        'mapAttributes' => array(),
        'htmlAttributes' => array(),
        'aliasAttributes' => array(),
        'escapeAttributes' => true,

        /**
         * lineBreaks       - (boolean) Convert line breaks within the content body
         * autoClose        - (boolean) HTML tag is self closing
         * preserveTags     - (boolean) Will not convert nested Decoda markup within this tag
         * onlyTags         - (boolean) Only Decoda tags are allowed within this tag, no text nodes
         */
        'lineBreaks' => Decoda::NL_CONVERT,
        'autoClose' => false,
        'preserveTags' => false,
        'onlyTags' => false,

        /**
         * contentPattern   - (string) Regex pattern that the content or default attribute must pass
         * stripContent     - (boolean) Should content within tags be removed when stripping tags
         */
        'contentPattern' => '',
        'stripContent' => false,

        /**
         * parent               - (array) List of Decoda tags that this tag can only be a direct child of
         * childrenWhitelist    - (array) List of Decoda tags that can only be a direct descendant
         * childrenBlacklist    - (array) List of Decoda tags that can not be a direct descendant
         * maxChildDepth        - (integer) Max depth for nested children of the same tag (-1 to disable)
         * persistContent       - (boolean) Should we persist text content from within deeply nested tags (but remove their wrapping tags)
         */
        'parent' => array(),
        'childrenWhitelist' => array(),
        'childrenBlacklist' => array(),
        'maxChildDepth' => -1,
        'persistContent' => true
    );

    /**
     * Supported tags.
     *
     * @type array
     */
    protected $_tags = array();

    /**
     * Generate all the tags on construction.
     */
    public function construct() {
        $tags = array();
        $defaults = $this->_defaults;

        foreach ($this->_tags as $tag => $settings) {
            $filter = $settings;
            $filter['tag'] = $tag;

            // Inherit from another tag and merge recursively
            if (!empty($filter['aliasFor'])) {
                $base = $tags[$filter['aliasFor']];

                foreach ($filter as $key => $value) {
                    if (is_array($value)) {
                        $base[$key] = $value + $base[$key];
                    } else if ($value !== '') {
                        $base[$key] = $value;
                    }
                }

                $filter = $base;

            // Or inherit from defaults
            } else {
                $filter = array_merge($defaults, $filter);
            }

            // Alias attributes
            if ($filter['aliasAttributes']) {
                foreach ($filter['aliasAttributes'] as $attr => $alias) {
                    $filter['attributes'][$attr] = $filter['attributes'][$alias];
                }
            }

            $tags[$tag] = $filter;
        }

        $this->_tags = $tags;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Decoda\Exception\MissingFilterException
     */
    public function getTag($tag) {
        if (isset($this->_tags[$tag])) {
            return $this->_tags[$tag];
        }

        throw new MissingFilterException(sprintf('No filter can be found with $s tag', $tag));
    }

    /**
     * {@inheritdoc}
     */
    public function getTags() {
        return $this->_tags;
    }

    /**
     * {@inheritdoc}
     */
    public function parse(array $tag, $content) {
        $setup = $this->getTag($tag['tag']);
        $parser = $this->getParser();
        $xhtml = $parser->getConfig('xhtmlOutput');
        $content = !empty($tag['content']) ? $tag['content'] : $content;

        // Test for an empty filter or empty tag
        if (!$setup || (!$content && $parser->getConfig('removeEmpty'))) {
            return null;
        }

        // Merge arguments with method of same tag name
        // If the method returns false, exit early
        if (method_exists($this, $tag['tag'])) {
            if ($response = call_user_func_array(array($this, $tag['tag']), array($tag, $content))) {
                list($tag, $content) = $response;
            } else {
                return null;
            }
        }

        if ($content) {
            // If content doesn't match the pattern, don't wrap in a tag
            if ($setup['contentPattern']) {
                if (!preg_match($setup['contentPattern'], $content)) {
                    return sprintf('(Invalid %s)', $tag['tag']);
                }
            }

            // Process line breaks
            switch ($setup['lineBreaks']) {
                case Decoda::NL_CONVERT:
                    $content = str_replace("\r", "", $parser->convertLineBreaks($content));
                break;
                case Decoda::NL_REMOVE:
                    $content = str_replace(array("\r", "\n"), "", $content);
                break;
            }
        }

        // Format attributes
        $attributes = (array) $setup['htmlAttributes'];
        $attr = '';

        if ($tag['attributes']) {
            foreach ($tag['attributes'] as $key => $value) {
                if ($key === 'default' || mb_substr($value, 0, 11) === 'javascript:') {
                    continue;
                }

                if ($setup['escapeAttributes']) {
                    $value = $parser->escape($value);
                }

                if (!empty($attributes[$key])) {
                    $attributes[$key] .= ' ' . $value;
                } else {
                    $attributes[$key] = $value;
                }
            }
        }

        foreach ($attributes as $key => $value) {
            $attr .= ' ' . $key . '="' . $value . '"';
        }

        // Use a template if it exists
        if ($setup['template']) {
            $tag['attributes'] = $attributes + $this->_config;

            $engine = $parser->getEngine();
            $engine->setFilter($this);

            $parsed = $engine->render($tag, $content);

            if ($setup['lineBreaks'] !== Decoda::NL_PRESERVE) {
                $parsed = str_replace(array("\r", "\n"), "", $parsed);

            // Normalize
            } else {
                $parsed = $parser->convertNewlines($parsed);
            }

            return $parsed;
        }

        // Build HTML tag
        $html = $setup['htmlTag'];

        if (is_array($html)) {
            $html = $html[$xhtml];
        }

        if ($setup['autoClose']) {
            $parsed = '<' . $html . $attr . ($xhtml ? ' /' : '') . '>';
        } else {
            $parsed = '<' . $html . $attr . '>' . $content . '</' . $html . '>';
        }

        return $parsed;
    }

    /**
     * {@inheritdoc}
     */
    public function setupHooks(Decoda $decoda) {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function strip(array $tag, $content) {
        $setup = $this->getTag($tag['tag']);

        if (!$setup || $setup['stripContent']) {
            return '';
        }

        return $content;
    }

}