<?php
/**
 * @copyright   2006-2014, Miles Johnson - http://milesj.me
 * @license     https://github.com/milesj/decoda/blob/master/license.md
 * @link        http://milesj.me/code/php/decoda
 */

namespace Decoda\Hook;

use Decoda\Decoda;
use Decoda\Loader\FileLoader;

/**
 * Converts smiley faces into emoticon images.
 */
class EmoticonHook extends AbstractHook {

    /**
     * Configuration.
     *
     * @type array
     */
    protected $_config = array(
        'path' => '/images/',
        'extension' => 'png'
    );

    /**
     * Mapping of emoticons to smilies.
     *
     * @type array
     */
    protected $_emoticons = array();

    /**
     * Map of smilies to emoticons.
     *
     * @type array
     */
    protected $_smilies = array();

    /**
     * Read the contents of the loaders into the emoticons list.
     */
    public function startup() {
        if ($this->_emoticons) {
            return;
        }

        // Load files from config paths
        foreach ($this->getParser()->getPaths() as $path) {
            foreach (glob($path . 'emoticons.*') as $file) {
                $this->addLoader(new FileLoader($file));
            }
        }

        // Load the contents into the emoticon and smiley list
        foreach ($this->getLoaders() as $loader) {
            $loader->setParser($this->getParser());

            if ($emoticons = $loader->load()) {
                foreach ($emoticons as $emoticon => $smilies) {
                    foreach ($smilies as $smile) {
                        $this->_smilies[$smile] = $emoticon;
                    }
                }

                $this->_emoticons = array_merge($this->_emoticons, $emoticons);
            }
        }
    }

    /**
     * Parse out the emoticons and replace with images.
     *
     * @param string $content
     * @return string
     */
    public function beforeContent($content) {
        $smilies = $this->getSmilies();

        // Build the smilies regex
        $smiliesRegex = implode('|', array_map(function ($smile) {
            return preg_quote($smile, '/');
        }, $smilies));

        $pattern = sprintf('/(?P<left>^|\n|\s)(?:%s)(?P<right>\n|\s|$)/is', $smiliesRegex);

        // Make two passes to accept that one delimiter can use two smilies
        $content = preg_replace_callback($pattern, array($this, '_emoticonCallback'), $content);
        $content = preg_replace_callback($pattern, array($this, '_emoticonCallback'), $content);

        return $content;
    }

    /**
     * Gets the mapping of emoticons and smilies.
     *
     * @return array
     */
    public function getEmoticons() {
        return $this->_emoticons;
    }

    /**
     * Returns all available smilies.
     *
     * @return array
     */
    public function getSmilies() {
        return array_keys($this->_smilies);
    }

    /**
     * Checks if a smiley is set for the given id.
     *
     * @param string $smiley
     * @return bool
     */
    public function hasSmiley($smiley) {
        return isset($this->_smilies[$smiley]);
    }

    /**
     * Convert a smiley to an HTML representation.
     *
     * @param string $smiley
     * @param bool $isXhtml
     * @return string
     */
    public function render($smiley, $isXhtml = true) {
        if (!$this->hasSmiley($smiley)) {
            return null;
        }

        $path = sprintf('%s',  $this->_smilies[$smiley]);

        if ($isXhtml) {
            $tpl = '<img src="%s" alt="" />';
        } else {
            $tpl = '<img src="%s" alt="">';
        }

        return sprintf($tpl, $path);
    }

    /**
     * Callback for smiley processing.
     *
     * @param array $matches
     * @return string
     */
    protected function _emoticonCallback($matches) {
        $smiley = trim($matches[0]);

        if (count($matches) === 1 || !$this->hasSmiley($smiley)) {
            return $matches[0];
        }

        $l = isset($matches['left']) ? $matches['left'] : '';
        $r = isset($matches['right']) ? $matches['right'] : '';

        return $l . $this->render($smiley, $this->getParser()->getConfig('xhtmlOutput')) . $r;
    }

}
