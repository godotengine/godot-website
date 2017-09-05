<?php
/**
 * @copyright   2006-2014, Miles Johnson - http://milesj.me
 * @license     https://github.com/milesj/decoda/blob/master/license.md
 * @link        http://milesj.me/code/php/decoda
 */

namespace Decoda;

use Decoda\Exception\MissingFilterException;
use Decoda\Exception\MissingHookException;
use Decoda\Exception\MissingLocaleException;
use \InvalidArgumentException;

if (!defined('ENT_SUBSTITUTE')) {
    define('ENT_SUBSTITUTE', 8);
}

/**
 * A lightweight lexical string parser for simple markup syntax.
 * Provides a very powerful filter and hook system to extend the parsing cycle.
 */
class Decoda {

    /**
     * Tag type constants.
     */
    const TAG_NONE = 0;
    const TAG_OPEN = 1;
    const TAG_CLOSE = 2;
    const TAG_SELF_CLOSE = 3;

    /**
     * Error type constants.
     */
    const ERROR_ALL = 0;
    const ERROR_NESTING = 1;
    const ERROR_CLOSING = 2;
    const ERROR_SCOPE = 3;

    /**
     * Type constants.
     *
     *     TYPE_NONE    - Will not accept block or inline (for validating)
     *     TYPE_INLINE  - Inline element that can only contain child inlines
     *     TYPE_BLOCK   - Block element that can contain both inline and block
     *     TYPE_BOTH    - Will accept either type (for validating)
     */
    const TYPE_NONE = 0;
    const TYPE_INLINE = 1;
    const TYPE_BLOCK = 2;
    const TYPE_BOTH = 3;

    /**
     * Newline and carriage return formatting.
     *
     *     NL_REMOVE    - Will be removed
     *     NL_PRESERVE  - Will be preserved as \n
     *     NL_CONVERT   - Will be converted to <br> tags
     */
    const NL_REMOVE = 0;
    const NL_PRESERVE = 1;
    const NL_CONVERT = 2;

    /**
     * Blacklist of tags not to parse.
     *
     * @type array
     */
    protected $_blacklist = array();

    /**
     * Extracted chunks of text and tags.
     *
     * @type array
     */
    protected $_chunks = array();

    /**
     * Configuration.
     *
     * @type array
     */
    protected $_config = array(
        'open' => '[',
        'close' => ']',
        'locale' => 'en-us',
        'disabled' => false,
        'shorthandLinks' => false,
        'xhtmlOutput' => false,
        'escapeHtml' => true,
        'strictMode' => true,
        'maxNewlines' => 3,
        'lineBreaks' => true,
        'removeEmpty' => false,
        'configPath' => '../config/'
    );

    /**
     * Logged errors for incorrectly nested nodes and types.
     *
     * @type array
     */
    protected $_errors = array();

    /**
     * List of all instantiated filter objects.
     *
     * @type array
     */
    protected $_filters = array();

    /**
     * Mapping of tags to its filter object.
     *
     * @type array
     */
    protected $_filterMap = array();

    /**
     * List of all instantiated hook objects.
     *
     * @type array
     */
    protected $_hooks = array();

    /**
     * Message strings for localization purposes.
     *
     * @type array
     */
    protected $_messages = array();

    /**
     * Children nodes.
     *
     * @type array
     */
    protected $_nodes = array();

    /**
     * The parsed string.
     *
     * @type string
     */
    protected $_parsed = '';

    /**
     * Configuration folder paths.
     *
     * @type array
     */
    protected $_paths = array();

    /**
     * The raw string before parsing.
     *
     * @type string
     */
    protected $_string = '';

    /**
     * The stripped string.
     *
     * @type string
     */
    protected $_stripped = '';

    /**
     * List of tags from filters.
     *
     * @type array
     */
    protected $_tags = array();

    /**
     * Template engine used for parsing.
     *
     * @type \Decoda\Engine
     */
    protected $_engine = null;

    /**
     * Whitelist of tags to parse.
     *
     * @type array
     */
    protected $_whitelist = array();

    /**
     * Store the text and single instance configuration.
     *
     * @param string $string
     * @param array $config
     */
    public function __construct($string = '', array $config = array()) {
        $this->setConfig($config);
        $this->reset($string, true);

        if ($path = $this->getConfig('configPath')) {
            $this->addPath($path);
        }
    }

    /**
     * Add additional filters.
     *
     * @param \Decoda\Filter $filter
     * @param string $key
     * @return \Decoda\Decoda
     */
    public function addFilter(Filter $filter, $key = null) {
        $filter->setParser($this);

        if (!$key) {
            $key = explode('\\', get_class($filter));
            $key = str_replace('Filter', '', end($key));
        }

        $tags = $filter->getTags();

        $this->_filters[$key] = $filter;
        $this->_tags = $tags + $this->_tags;

        foreach ($tags as $tag => $options) {
            $this->_filterMap[$tag] = $key;
        }

        $filter->setupHooks($this);

        return $this;
    }

    /**
     * Add hooks that are triggered at specific events.
     *
     * @param \Decoda\Hook $hook
     * @param string $key
     * @return \Decoda\Decoda
     */
    public function addHook(Hook $hook, $key = null) {
        $hook->setParser($this);

        if (!$key) {
            $key = explode('\\', get_class($hook));
            $key = str_replace('Hook', '', end($key));
        }

        $this->_hooks[$key] = $hook;

        $hook->setupFilters($this);

        ksort($this->_hooks);

        return $this;
    }

    /**
     * Add a loader that will generate localization messages.
     *
     * @param \Decoda\Loader $loader
     * @return \Decoda\Decoda
     */
    public function addMessages(Loader $loader) {
        $loader->setParser($this);

        if ($messages = $loader->load()) {
            foreach ($messages as $locale => $strings) {
                if (!empty($this->_messages[$locale])) {
                    $strings = array_merge($this->_messages[$locale], $strings);
                }

                $this->_messages[$locale] = $strings;
            }
        }

        return $this;
    }

    /**
     * Add a configuration lookup path.
     *
     * @param string $path
     * @return \Decoda\Decoda
     */
    public function addPath($path) {
        if (substr($path, 0, 3) === '../') {
            $path = realpath(__DIR__ . '/' . $path);
        }

        if (substr($path, -1) !== '/') {
            $path .= '/';
        }

        $this->_paths[] = $path;

        return $this;
    }

    /**
     * Add tags to the blacklist.
     *
     * @return \Decoda\Decoda
     */
    public function blacklist() {
        $args = func_get_args();

        if (isset($args[0]) && is_array($args[0])) {
            $args = $args[0];
        }

        $this->_blacklist += $args;
        $this->_blacklist = array_filter($this->_blacklist);

        return $this;
    }

    /**
     * Remove any newlines above the max.
     *
     * @param string $string
     * @return string
     */
    public function cleanNewlines($string) {
        if ($max = $this->getConfig('maxNewlines')) {
            $string = preg_replace('/\n{' . ($max + 1) . ',}/', str_repeat("\n", $max), $string);
        }

        return trim($string);
    }

    /**
     * Convert newlines to line breaks.
     *
     * @param string $string
     * @return string
     */
    public function convertLineBreaks($string) {
        if ($this->getConfig('lineBreaks')) {

            // Don't use nl2br() since it leaves a \n
            if ($this->getConfig('xhtmlOutput')) {
                $string = str_replace("\n", '<br/>', $string);
            } else {
                $string = str_replace("\n", '<br>', $string);
            }
        }

        return $string;
    }

    /**
     * Convert carriage returns to newlines.
     *
     * @param string $string
     * @return string
     */
    public function convertNewlines($string) {
        $string = str_replace("\r\n", "\n", $string);
        $string = str_replace("\r", "\n", $string);

        return $this->cleanNewlines($string);
    }

    /**
     * Apply default filters and hooks if none are set.
     *
     * @return \Decoda\Decoda
     */
    public function defaults() {
        $this->addFilter(new \Decoda\Filter\DefaultFilter());
        $this->addFilter(new \Decoda\Filter\EmailFilter());
        $this->addFilter(new \Decoda\Filter\ImageFilter());
        $this->addFilter(new \Decoda\Filter\UrlFilter());
        $this->addFilter(new \Decoda\Filter\TextFilter());
        $this->addFilter(new \Decoda\Filter\BlockFilter());
        $this->addFilter(new \Decoda\Filter\VideoFilter());
        $this->addFilter(new \Decoda\Filter\CodeFilter());
        $this->addFilter(new \Decoda\Filter\QuoteFilter());
        $this->addFilter(new \Decoda\Filter\ListFilter());

        $this->addHook(new \Decoda\Hook\CensorHook());
        $this->addHook(new \Decoda\Hook\ClickableHook());

        return $this;
    }

    /**
     * Toggle parsing.
     *
     * @param bool $status
     * @return \Decoda\Decoda
     */
    public function disable($status = true) {
        $this->_config['disabled'] = (bool) $status;

        return $this;
    }

    /**
     * Escape HTML characters amd entities.
     *
     * @param string $string
     * @param int $flags
     * @return string
     */
    public function escape($string, $flags = null) {
        if ($flags === null) {
            $flags = ENT_QUOTES;
        }

        $flags |= ENT_SUBSTITUTE;

        return htmlentities($string, $flags, 'UTF-8', false);
    }

    /**
     * Normalize line feeds and escape HTML characters.
     *
     * @param string $string
     * @return string
     */
    public function escapeHtml($string) {
        $string = $this->convertNewlines($string);

        if ($this->getConfig('escapeHtml')) {
            $string = $this->escape($string, ENT_NOQUOTES);
        }

        return $string;
    }

    /**
     * Return the current blacklist.
     *
     * @return array
     */
    public function getBlacklist() {
        return $this->_blacklist;
    }

    /**
     * Return a specific configuration key value.
     *
     * @param string $key
     * @return mixed
     */
    public function getConfig($key) {
        return isset($this->_config[$key]) ? $this->_config[$key] : null;
    }

    /**
     * Return the parsing errors.
     *
     * @param int $type
     * @return array
     */
    public function getErrors($type = self::ERROR_ALL) {
        if ($type === self::ERROR_ALL) {
            return $this->_errors;
        }

        $clean = array();

        if ($this->_errors) {
            foreach ($this->_errors as $error) {
                if ($error['type'] === self::ERROR_NESTING) {
                    $clean[] = $error;

                } else if ($error['type'] === self::ERROR_CLOSING) {
                    $clean[] = $error;

                } else if ($error['type'] === self::ERROR_SCOPE) {
                    $clean[] = $error;
                }
            }
        }

        return $clean;
    }

    /**
     * Return a specific filter based on class name.
     *
     * @param string $filter
     * @return \Decoda\Filter
     * @throws \Decoda\Exception\MissingFilterException
     */
    public function getFilter($filter) {
        if ($this->hasFilter($filter)) {
            return $this->_filters[$filter];
        }

        throw new MissingFilterException(sprintf('Filter %s does not exist', $filter));
    }

    /**
     * Return a filter based on its supported tag.
     *
     * @param string $tag
     * @return \Decoda\Filter
     * @throws \Decoda\Exception\MissingFilterException
     */
    public function getFilterByTag($tag) {
        if (isset($this->_filterMap[$tag])){
            return $this->getFilter($this->_filterMap[$tag]);
        }

        throw new MissingFilterException(sprintf('No filter could be located for tag %s', $tag));
    }

    /**
     * Return all filters.
     *
     * @return array
     */
    public function getFilters() {
        return $this->_filters;
    }

    /**
     * Return a specific hook based on class name.
     *
     * @param string $hook
     * @return \Decoda\Hook
     * @throws \Decoda\Exception\MissingHookException
     */
    public function getHook($hook) {
        if ($this->hasHook($hook)) {
            return $this->_hooks[$hook];
        }

        throw new MissingHookException(sprintf('Hook %s does not exist', $hook));
    }

    /**
     * Return all hooks.
     *
     * @return array
     */
    public function getHooks() {
        return $this->_hooks;
    }

    /**
     * Returns the current used template engine.
     * In case no engine is set the default php engine gonna be used.
     *
     * @return \Decoda\Engine
     */
    public function getEngine() {
        if (!$this->_engine) {
            $engine = new \Decoda\Engine\PhpEngine();
            $engine->addPath(dirname(__DIR__) . '/templates/');

            $this->setEngine($engine);
        }

        return $this->_engine;
    }

    /**
     * Return the configuration folder paths.
     *
     * @return array
     */
    public function getPaths() {
        return $this->_paths;
    }

    /**
     * Return the current whitelist.
     *
     * @return array
     */
    public function getWhitelist() {
        return $this->_whitelist;
    }

    /**
     * Check if a filter exists.
     *
     * @param string $filter
     * @return boolean
     */
    public function hasFilter($filter) {
        return isset($this->_filters[$filter]);
    }

    /**
     * Check if a hook exists.
     *
     * @param string $hook
     * @return boolean
     */
    public function hasHook($hook) {
        return isset($this->_hooks[$hook]);
    }

    /**
     * Return a message string if it exists.
     *
     * @param string $key
     * @param array $vars
     * @return string
     * @throws \Decoda\Exception\MissingLocaleException
     */
    public function message($key, array $vars = array()) {
        if (!$this->_messages) {
            $this->_loadMessages();
        }

        $locale = $this->getConfig('locale');

        if (empty($this->_messages[$locale])) {
            throw new MissingLocaleException(sprintf('Localized messages for %s do not exist', $locale));
        }

        $string = isset($this->_messages[$locale][$key]) ? $this->_messages[$locale][$key] : '';

        if ($string && $vars) {
            foreach ($vars as $key => $value) {
                $string = str_replace('{' . $key . '}', $value, $string);
            }
        }

        return $string;
    }

    /**
     * Parse the node list by looping through each one, validating, applying filters, building and finally concatenating the string.
     *
     * @param bool $echo
     * @return string
     */
    public function parse($echo = false) {
        if ($this->_parsed) {
            if ($echo) {
                echo $this->_parsed;
            }

            return $this->_parsed;
        }

        $this->_triggerHook('startup');

        $string = $this->_triggerHook('beforeParse', $this->_string);

        if ($this->_isParseable($string)) {
            $string = $this->_parse($this->_extractChunks($string));

        } else {
            $string = $this->_triggerHook('beforeContent', $string);
            $string = $this->convertLineBreaks($string);
            $string = $this->_triggerHook('afterContent', $string);
        }

        $string = $this->_triggerHook('afterParse', $string);

        $this->_parsed = $this->cleanNewlines($string);

        if ($echo) {
            echo $this->_parsed;
        }

        return $this->_parsed;
    }

    /**
     * Remove filter(s).
     *
     * @param string|array $filters
     * @return \Decoda\Decoda
     */
    public function removeFilter($filters) {
        foreach ((array) $filters as $filter) {
            unset($this->_filters[$filter]);

            foreach ($this->_filterMap as $tag => $f) {
                if ($f === $filter) {
                    unset($this->_filterMap[$tag]);
                }
            }
        }

        return $this;
    }

    /**
     * Remove hook(s).
     *
     * @param string|array $hooks
     * @return \Decoda\Decoda
     */
    public function removeHook($hooks) {
        foreach ((array) $hooks as $hook) {
            unset($this->_hooks[$hook]);
        }

        return $this;
    }

    /**
     * Reset the parser to a new string.
     *
     * @param string $string
     * @param bool $flush
     * @return \Decoda\Decoda
     */
    public function reset($string, $flush = false) {
        $this->_chunks = array();
        $this->_errors = array();
        $this->_nodes = array();
        $this->_blacklist = array();
        $this->_whitelist = array();
        $this->_parsed = '';
        $this->_stripped = '';
        $this->_string = $this->escapeHtml($string);

        if ($flush) {
            $this->resetFilters();
            $this->resetHooks();
            $this->_paths = array();
        }

        return $this;
    }

    /**
     * Reset all filters.
     *
     * @return \Decoda\Decoda
     */
    public function resetFilters() {
        $this->_filters = array();
        $this->_filterMap = array();
        $this->_tags = array();

        $this->addFilter(new \Decoda\Filter\EmptyFilter());

        return $this;
    }

    /**
     * Reset all hooks.
     *
     * @return \Decoda\Decoda
     */
    public function resetHooks() {
        $this->_hooks = array();

        $this->addHook(new \Decoda\Hook\EmptyHook());

        return $this;
    }

    /**
     * Apply multiple configurations at once.
     *
     * @param array $config
     * @return \Decoda\Decoda
     */
    public function setConfig(array $config) {
        if (!$config) {
            return $this;
        }

        foreach ($config as $key => $value) {
            switch ($key) {
                case 'open':
                case 'close':
                    $this->setBrackets($config['open'], $config['close']);
                break;
                case 'locale':
                    $this->setLocale($value);
                break;
                case 'disable':
                case 'disabled':
                    $this->disable($value);
                break;
                case 'shorthand':
                case 'shorthandLinks':
                    $this->setShorthand($value);
                break;
                case 'xhtml':
                case 'xhtmlOutput':
                    $this->setXhtml($value);
                break;
                case 'escape':
                case 'escapeHtml':
                    $this->setEscaping($value);
                break;
                case 'strict':
                case 'strictMode':
                    $this->setStrict($value);
                break;
                case 'newlines':
                case 'maxNewlines':
                    $this->setMaxNewlines($value);
                break;
                case 'lineBreaks':
                    $this->setLineBreaks($value);
                break;
                case 'removeEmpty':
                    $this->setRemoveEmptyTags($value);
                break;

                // Doesn't need a setter as it's only used in the constructor
                case 'configPath':
                    $this->_config['configPath'] = $value;
                break;
            }
        }

        return $this;
    }

    /**
     * Change the open/close markup brackets.
     *
     * @param string $open
     * @param string $close
     * @return \Decoda\Decoda
     * @throws \InvalidArgumentException
     */
    public function setBrackets($open, $close) {
        if (!$open || !$close) {
            throw new InvalidArgumentException('Both the open and close brackets are required');
        }

        $this->_config['open'] = (string) $open;
        $this->_config['close'] = (string) $close;

        return $this;
    }

    /**
     * Toggle XSS escaping.
     *
     * @param bool $status
     * @return \Decoda\Decoda
     */
    public function setEscaping($status) {
        $this->_config['escapeHtml'] = (bool) $status;

        return $this;
    }

    /**
     * Toggle new line to line break conversion.
     *
     * @param bool $status
     * @return \Decoda\Decoda
     */
    public function setLineBreaks($status) {
        $this->_config['lineBreaks'] = (bool) $status;

        return $this;
    }

    /**
     * Set the locale.
     *
     * @param string $locale
     * @return \Decoda\Decoda
     */
    public function setLocale($locale) {
        $this->_config['locale'] = $locale;

        return $this;
    }

    /**
     * Set the max amount of newlines.
     *
     * @param bool $max
     * @return \Decoda\Decoda
     */
    public function setMaxNewlines($max) {
        $this->_config['maxNewlines'] = (int) $max;

        return $this;
    }

    /**
     * Set empty tag removal.
     *
     * @param bool $status
     * @return \Decoda\Decoda
     */
    public function setRemoveEmptyTags($status) {
        $this->_config['removeEmpty'] = (bool) $status;

        return $this;
    }

    /**
     * Toggle shorthand syntax.
     *
     * @param bool $status
     * @return \Decoda\Decoda
     */
    public function setShorthand($status) {
        $this->_config['shorthandLinks'] = (bool) $status;

        return $this;
    }

    /**
     * Toggle strict parsing.
     *
     * @param bool $strict
     * @return \Decoda\Decoda
     */
    public function setStrict($strict) {
        $this->_config['strictMode'] = (bool) $strict;

        return $this;
    }

    /**
     * Sets the template engine which gonna be used for all tags with templates.
     *
     * @param \Decoda\Engine $engine
     * @return \Decoda\Decoda
     */
    public function setEngine(Engine $engine) {
        $engine->setParser($this);

        $this->_engine = $engine;

        return $this;
    }

    /**
     * Toggle XHTML.
     *
     * @param bool $status
     * @return \Decoda\Decoda
     */
    public function setXhtml($status) {
        $this->_config['xhtmlOutput'] = (bool) $status;

        return $this;
    }

    /**
     * Strip the node list by looping through all the nodes and stripping out tags and content.
     *
     * @param bool $html
     * @param bool $echo
     * @return string
     */
    public function strip($html = false, $echo = false) {
        if ($this->_stripped) {
            if ($echo) {
                echo $this->_stripped;
            }

            return $this->_stripped;
        }

        $this->_triggerHook('startup');

        $string = $this->_triggerHook('beforeStrip', $this->_string);

        if ($this->_isParseable($string)) {
            $string = $this->_strip($this->_extractChunks($string));
        } else {
            $string = $this->convertLineBreaks($string);
        }

        $string = $this->_triggerHook('afterStrip', $string);

        if (!$html) {
            $string = preg_replace('/<br\/?>/', "\n", $string); // convert back
            $string = strip_tags($string);
        }

        $this->_stripped = $this->cleanNewlines($string);

        if ($echo) {
            echo $this->_stripped;
        }

        return $this->_stripped;
    }

    /**
     * Add tags to the whitelist.
     *
     * @return \Decoda\Decoda
     */
    public function whitelist() {
        $args = func_get_args();

        if (isset($args[0]) && is_array($args[0])) {
            $args = $args[0];
        }

        $this->_whitelist += $args;
        $this->_whitelist = array_filter($this->_whitelist);

        return $this;
    }

    /**
     * Determine if the string is an open or closing tag. If so, parse out the attributes.
     *
     * @param string $string
     * @return array
     */
    protected function _buildTag($string) {
        $disabled = $this->getConfig('disabled');
        $oe = preg_quote($this->getConfig('open'), '/');
        $ce = preg_quote($this->getConfig('close'), '/');
        $tag = null;
        $type = self::TAG_NONE;
        $attributes = array();

        // Closing tag
        if (preg_match('/^' . $oe . '\s*\/\s*([-a-z0-9\*]+)\s*' . $ce . '/i', $string, $matches)) {
            $tag = trim($matches[1]);
            $type = self::TAG_CLOSE;

        // Opening tag
        } else if (preg_match('/^' . $oe . '\s*([-a-z0-9\*]+)(.*?)\s*' . $ce . '/i', $string, $matches)) {
            $tag = trim($matches[1]);
            $type = self::TAG_OPEN;
        }

        // Check for lowercase tag in case they uppercased it: IMG, B, etc
        if (isset($this->_tags[strtolower($tag)])) {
            $tag = strtolower($tag);
        }

        if (!isset($this->_tags[$tag])) {
            return false;
        }

        $source = $this->_tags[$tag];

        // Check if is a self closing tag
        if ($type === self::TAG_OPEN && $source['autoClose'] && preg_match('/\/\s*' . $ce . '$/', $string)) {
            $type = self::TAG_SELF_CLOSE;
        }

        // Find attributes
        if (!$disabled) {
            $found = array();

            preg_match_all('/([a-z_\-]+)=\"(.*?)\"/i', $string, $matches, PREG_SET_ORDER);

            if ($matches) {
                foreach ($matches as $match) {
                    $found[$match[1]] = $match[2];
                }
            }

            // Find attributes that aren't surrounded by quotes
            if (!$this->getConfig('strictMode')) {
                preg_match_all('/([a-z_\-]+)=([^\s' . $ce . ']+)/i', $string, $matches, PREG_SET_ORDER);

                if ($matches) {
                    foreach ($matches as $match) {
                        if (!isset($found[$match[1]])) {
                            $found[$match[1]] = $match[2];
                        }
                    }
                }
            }

            if ($found) {
                foreach ($found as $key => $value) {
                    $key = mb_strtolower($key);
                    $value = trim(trim($value), '"');

                    if ($key === $tag) {
                        $key = 'default';
                    }

                    if (isset($source['mapAttributes'][$key])) {
                        $finalKey = $source['mapAttributes'][$key];

                        // Allow for aliasing
                        if (isset($source['attributes'][$finalKey])) {
                            $key = $finalKey;
                        }
                    } else {
                        $finalKey = $key;
                    }

                    if (isset($source['attributes'][$key])) {
                        $pattern = $source['attributes'][$key];

                        if ($pattern === true) {
                            $attributes[$finalKey] = $value;

                        } else if (is_array($pattern)) {
                            if (preg_match($pattern[0], $value)) {
                                $attributes[$finalKey] = str_replace('{' . $key . '}', $value, $pattern[1]);
                            }

                        } else {
                            if (preg_match($pattern, $value)) {
                                $attributes[$finalKey] = $value;
                            }
                        }
                    }
                }
            }
        }

        if (
            $disabled ||
            ($this->_whitelist && !in_array($tag, $this->_whitelist)) ||
            ($this->_blacklist && in_array($tag, $this->_blacklist))
        ) {
            $type = self::TAG_NONE;
            $string = '';
        }

        return array(
            'tag' => $tag,
            'type' => $type,
            'text' => $string,
            'attributes' => $attributes
        );
    }

    /**
     * Clean the chunk list by verifying that open and closing tags are nested correctly.
     *
     * @param array $chunks
     * @param array $wrapper
     * @return string
     */
    protected function _cleanChunks(array $chunks, array $wrapper = array()) {
        $clean = array();
        $openTags = array();
        $prevChunk = array();
        $disallowed = array();
        $parents = array();
        $depths = array();
        $count = count($chunks);
        $i = 0;

        if ($wrapper) {
            $parent = $this->getFilterByTag($wrapper['tag'])->getTag($wrapper['tag']);
            $root = false;
        } else {
            $parent = $this->getFilter('Empty')->getTag('root');
            $root = true;
        }

        while ($i < $count) {
            $chunk = $chunks[$i];
            $tag = isset($chunk['tag']) ? $chunk['tag'] : '';

            switch ($chunk['type']) {
                case self::TAG_NONE:
                    // Disregard deeply nested text nodes if persist is disabled
                    if ($disallowed && !$parent['persistContent']) {
                        continue;
                    }

                    if (!$parent['onlyTags']) {
                        if (!empty($prevChunk) && $prevChunk['type'] === self::TAG_NONE) {
                            $chunk['text'] = $prevChunk['text'] . $chunk['text'];
                            array_pop($clean);
                        }

                        $clean[] = $chunk;
                    }
                break;

                case self::TAG_OPEN:
                    if ($parent['maxChildDepth'] >= 0 && !isset($depths[$tag])) {
                        $depths[$tag] = 1;
                        $parent['currentDepth'] = $depths[$tag];

                    } else if (isset($depths[$tag])) {
                        $depths[$tag] += 1;
                        $parent['currentDepth'] = $depths[$tag];
                    }

                    if ($this->_isAllowed($parent, $tag)) {
                        $prevParent = $parent;
                        $parents[] = $parent;
                        $parent = $this->getFilterByTag($tag)->getTag($tag);

                        // Don't parse Decoda tags if preserve is disabled
                        if ($prevParent['preserveTags']) {
                            $chunk['type'] = self::TAG_NONE;
                            $parent['preserveTags'] = true;
                        }

                        $clean[] = $chunk;

                        if ($root) {
                            $openTags[] = array('tag' => $tag, 'index' => $i);
                        }
                    } else {
                        $disallowed[] = array('tag' => $tag, 'index' => $i);
                    }
                break;

                case self::TAG_CLOSE:
                    // Reduce depth
                    if (isset($depths[$tag])) {
                        $depths[$tag] -= 1;
                    }

                    // If something is not allowed, skip the close tag
                    if ($disallowed) {
                        $last = end($disallowed);

                        if ($last['tag'] === $tag) {
                            array_pop($disallowed);
                            continue;
                        }
                    }

                    // Return to previous parent before allowing
                    if ($parents) {
                        $parent = array_pop($parents);
                    }

                    // Now check for open tags if the tag is allowed
                    if ($this->_isAllowed($parent, $tag)) {
                        if ($parent['preserveTags']) {
                            $chunk['type'] = self::TAG_NONE;
                        }

                        $clean[] = $chunk;

                        if ($root && $openTags) {
                            $last = end($openTags);

                            if ($last['tag'] === $tag) {
                                array_pop($openTags);
                            } else {
                                while ($openTags) {
                                    $last = array_pop($openTags);

                                    if ($last['tag'] !== $tag) {
                                        $this->_errors[] = array(
                                            'type' => self::ERROR_NESTING,
                                            'tag' => $last['tag']
                                        );

                                        unset($clean[$last['index']]);
                                    }
                                }
                            }
                        }
                    }
                break;

                case self::TAG_SELF_CLOSE:
                    $clean[] = $chunk;
                break;
            }

            $i++;
            $prevChunk = $chunk;
        }

        // Remove any unclosed tags
        while ($openTags) {
            $last = array_pop($openTags);

            $this->_errors[] = array(
                'type' => self::ERROR_CLOSING,
                'tag' => $last['tag']
            );

            unset($clean[$last['index']]);
        }

        return array_values($clean);
    }

    /**
     * Scan the string stack and extract any tags and chunks of text that were detected.
     *
     * @param string $string
     * @return array
     */
    protected function _extractChunks($string) {
        $strPos = 0;
        $strLength = mb_strlen($string);
        $openBracket = $this->getConfig('open');
        $closeBracket = $this->getConfig('close');
        $hasList = isset($this->_filters['List']);
        $starOpen = false;

        while ($strPos < $strLength) {
            $tag = array();
            $openPos = mb_strpos($string, $openBracket, $strPos);

            if ($openPos === false) {
                $openPos = $strLength;
            }

            if ($openPos + 1 > $strLength) {
                $nextOpenPos = $strLength;
            } else {
                $nextOpenPos = mb_strpos($string, $openBracket, $openPos + 1);

                if ($nextOpenPos === false) {
                    $nextOpenPos = $strLength;
                }
            }

            $closePos = mb_strpos($string, $closeBracket, $strPos);

            if ($closePos === false) {
                $closePos = $strLength + 1;
            }

            // Possible tag found, lets look
            if ($openPos === $strPos) {

                // Child open tag before closing tag
                if ($nextOpenPos < $closePos) {
                    $newPos = $nextOpenPos;
                    $tag['text'] = mb_substr($string, $strPos, ($nextOpenPos - $strPos));
                    $tag['type'] = self::TAG_NONE;

                // Tag?
                } else {
                    $newPos = $closePos + 1;
                    $newTag = $this->_buildTag(mb_substr($string, $strPos, (($closePos - $strPos) + 1)));

                    // Valid tag
                    if ($newTag) {
                        $tag = $newTag;

                        // Special handling for star list items
                        if ($hasList) {
                            if ($tag['type'] === self::TAG_OPEN) {

                                // A new star item opened
                                if ($tag['tag'] === '*' && !$starOpen) {
                                    $starOpen = true;

                                // Another star item appeared, so close the previous
                                } else if ($starOpen && $tag['tag'] === '*') {
                                    $this->_chunks[] = array(
                                        'tag' => '*',
                                        'type' => self::TAG_CLOSE,
                                        'text' => '[/*]',
                                        'attributes' => array()
                                    );
                                }

                            } else if ($tag['type'] === self::TAG_CLOSE) {
                                if ($starOpen && in_array($tag['tag'], array('list', 'olist'))) {
                                    $starOpen = false;

                                    $this->_chunks[] = array(
                                        'tag' => '*',
                                        'type' => self::TAG_CLOSE,
                                        'text' => '[/*]',
                                        'attributes' => array()
                                    );
                                } else if ($tag['tag'] === '*') {
                                    $starOpen = false;
                                }
                            }
                        }

                    // Not a valid tag
                    } else {
                        $tag['text'] = mb_substr($string, $strPos, $closePos - $strPos + 1);
                        $tag['type'] = self::TAG_NONE;
                    }
                }

            // No tag, just text
            } else {
                $newPos = $openPos;

                $tag['text'] = mb_substr($string, $strPos, ($openPos - $strPos));
                $tag['type'] = self::TAG_NONE;
            }

            // Join consecutive text elements
            if ($tag['type'] === self::TAG_NONE && isset($prev) && $prev['type'] === self::TAG_NONE) {
                $tag['text'] = $prev['text'] . $tag['text'];
                array_pop($this->_chunks);
            }

            $this->_chunks[] = $tag;
            $prev = $tag;
            $strPos = $newPos;
        }

        $this->_nodes = $this->_extractNodes($this->_chunks);

        return $this->_nodes;
    }

    /**
     * Convert the chunks into a child parent hierarchy of nodes.
     *
     * @param array $chunks
     * @param array $wrapper
     * @param int $depth
     * @return array
     */
    protected function _extractNodes(array $chunks, array $wrapper = array(), $depth = 0) {
        $chunks = $this->_cleanChunks($chunks, $wrapper);
        $nodes = array();
        $tag = array();
        $openIndex = -1;
        $openCount = -1;
        $closeCount = -1;
        $count = count($chunks);
        $i = 0;

        while ($i < $count) {
            $chunk = $chunks[$i];

            // Check for an empty tag as we only need to match the open and closing tags
            // The inner chunks will be extracted once a match is found
            if ($chunk['type'] === self::TAG_NONE && empty($tag)) {
                $nodes[] = $chunk['text'];

            } else if ($chunk['type'] === self::TAG_SELF_CLOSE && empty($tag)) {
                $chunk['children'] = array();
                $nodes[] = $chunk;

            } else if ($chunk['type'] === self::TAG_OPEN) {
                $openCount++;

                if (empty($tag)) {
                    $openIndex = $i;
                    $tag = $chunk;
                }

            } else if ($chunk['type'] === self::TAG_CLOSE) {
                $closeCount++;

                if ($openCount === $closeCount && $chunk['tag'] === $tag['tag']) {
                    $index = $i - $openIndex;
                    $tag = array();

                    // Only reduce if not last index
                    if ($index !== $count) {
                        $index = $index - 1;
                    }

                    // Slice a section of the array if the correct closing tag is found
                    $node = $chunks[$openIndex];
                    $node['depth'] = $depth;
                    $node['children'] = $this->_extractNodes(array_slice($chunks, ($openIndex + 1), $index), $chunks[$openIndex], $depth + 1);
                    $nodes[] = $node;

                // There is no opening or a broken opening tag, which means
                // $closeCount should not have been incremented before >> revert
                } else if (empty($tag)) {
                    $closeCount--;
                }
            }

            $i++;
        }

        return $nodes;
    }

    /**
     * Validate that the following child can be nested within the parent.
     *
     * @param array $parent
     * @param string $tag
     * @return boolean
     */
    protected function _isAllowed($parent, $tag) {
        $filter = $this->getFilterByTag($tag);

        if (!$filter) {
            return false;
        }

        $child = $filter->getTag($tag);

        // Remove children after a certain nested depth
        if (isset($parent['currentDepth']) && $parent['maxChildDepth'] >= 0 && $parent['currentDepth'] > $parent['maxChildDepth']) {
            return false;

        // Children that can only be within a certain parent
        } else if ($child['parent'] && !in_array($parent['tag'], $child['parent'])) {
            return false;

        // Parents that can not have specific direct descendant children
        } else if ($parent['childrenBlacklist'] && in_array($child['tag'], $parent['childrenBlacklist'])) {
            return false;

        // Parents that can only have direct descendant children
        } else if ($parent['childrenWhitelist'] && !in_array($child['tag'], $parent['childrenWhitelist'])) {
            return false;
        }

        // Validate the type nesting
        switch ($parent['allowedTypes']) {
            case self::TYPE_INLINE:
                // Inline type only allowed
                if ($child['displayType'] === self::TYPE_INLINE) {
                    return true;
                }
            break;
            case self::TYPE_BLOCK:
                // Block types only allowed if the parent is also a block
                if ($parent['displayType'] === self::TYPE_BLOCK && $child['displayType'] === self::TYPE_BLOCK) {
                    return true;
                }
            break;
            case self::TYPE_BOTH:
                if ($parent['displayType'] === self::TYPE_INLINE) {
                    // Only allow inline if parent is inline
                    if ($child['displayType'] === self::TYPE_INLINE) {
                        return true;
                    }
                } else {
                    return true;
                }
            break;
        }

        // Log the error
        $this->_errors[] = array(
            'type' => self::ERROR_SCOPE,
            'parent' => $parent['tag'],
            'parentType' => $parent['displayType'],
            'parentAllowed' => $parent['allowedTypes'],
            'child' => $child['tag'],
            'childType' => $child['displayType']
        );

        return false;
    }

    /**
     * Return true if the string is parseable.
     *
     * @param string $string
     * @return boolean
     */
    protected function _isParseable($string) {
        return (
            mb_strpos($string, $this->getConfig('open')) !== false &&
            mb_strpos($string, $this->getConfig('close')) !== false &&
            !$this->getConfig('disabled')
        );
    }

    /**
     * Load in all message strings from the config paths.
     */
    protected function _loadMessages() {
        foreach ($this->getPaths() as $path) {
            foreach (glob($path . 'messages.*') as $file) {
                $this->addMessages(new \Decoda\Loader\FileLoader($file));
            }
        }
    }

    /**
     * Cycle through the nodes and parse the string with the appropriate filter.
     *
     * @param array $nodes
     * @param array $wrapper
     * @return string
     */
    protected function _parse(array $nodes, array $wrapper = array()) {
        $parsed = '';

        if (!$nodes) {
            return $parsed;
        }

        foreach ($nodes as $node) {
            if (is_string($node)) {
                $string = $this->_triggerHook('beforeContent', $node);

                if (!$wrapper) {
                    $string = $this->convertLineBreaks($string);
                }

                $string = $this->_triggerHook('afterContent', $string);

            } else {
                $string = $this->getFilterByTag($node['tag'])->parse($node, $this->_parse($node['children'], $node));
            }

            $parsed .= $string;
        }

        return $parsed;
    }

    /**
     * Cycle through the nodes and strip out tags and content.
     *
     * @param array $nodes
     * @param array $wrapper
     * @return string
     */
    protected function _strip(array $nodes, array $wrapper = array()) {
        $parsed = '';

        if (!$nodes) {
            return $parsed;
        }

        foreach ($nodes as $node) {
            if (is_string($node)) {
                if (!$wrapper) {
                    $parsed .= $this->convertLineBreaks($node);
                } else {
                    $parsed .= $node;
                }
            } else {
                $parsed .= $this->getFilterByTag($node['tag'])->strip($node, $this->_strip($node['children'], $node));
            }
        }

        return $parsed;
    }

    /**
     * Trigger all hooks at an event specified by the method name.
     *
     * @param string $method
     * @param string $content
     * @return string
     */
    protected function _triggerHook($method, $content = null) {
        if ($this->_hooks) {
            foreach ($this->_hooks as $hook) {
                if (method_exists($hook, $method)) {
                    if ($content !== null) {
                        $content = $hook->{$method}($content);
                    } else {
                        $hook->{$method}();
                    }
                }
            }
        }

        return $content;
    }

    /**
     * Trim line breaks and not spaces.
     *
     * @deprecated
     * @param string $string
     * @return string
     */
    protected function _trim($string) {
        return trim($string, "\t\n\r\0\x0B");
    }

}
