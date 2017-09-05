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
 * Censors words found within the censored.txt blacklist.
 */
class CensorHook extends AbstractHook {

    /**
     * List of words to censor.
     *
     * @type array
     */
    protected $_blacklist = array();

    /**
     * Configuration.
     *
     * @type array
     */
    protected $_config = array(
        'suffix' => array('ing', 'in', 'er', 'r', 'ed', 'd')
    );

    /**
     * Read the contents of the loaders into the emoticons list.
     */
    public function startup() {
        if ($this->_blacklist) {
            return;
        }

        // Load files from config paths
        foreach ($this->getParser()->getPaths() as $path) {
            foreach (glob($path . 'censored.*') as $file) {
                $this->addLoader(new FileLoader($file));
            }
        }

        // Load the contents into the blacklist
        foreach ($this->getLoaders() as $loader) {
            $loader->setParser($this->getParser());

            if ($blacklist = $loader->load()) {
                $this->blacklist($blacklist);
            }
        }
    }

    /**
     * Parse the content by censoring blacklisted words.
     *
     * @param string $content
     * @return string
     */
    public function beforeParse($content) {
        return $this->_censor($content);
    }

    /**
     * Parse the content by censoring blacklisted words.
     *
     * @param string $content
     * @return string
     */
    public function beforeStrip($content) {
        return $this->_censor($content);
    }

    /**
     * Add words to the blacklist.
     *
     * @param array $words
     * @return \Decoda\Hook\CensorHook
     */
    public function blacklist(array $words) {
        $this->_blacklist = array_map('trim', array_filter($words)) + $this->_blacklist;
        $this->_blacklist = array_unique($this->_blacklist);

        return $this;
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
     * Trigger censoring.
     *
     * @param string $content
     * @return string
     */
    protected function _censor($content) {
        $pattern = implode('|', array_map(array($this, '_prepareRegex'), $this->getBlacklist()));
        $content = preg_replace_callback('/(?:^|\b)(?:' . $pattern . ')(?:\b|$)/is', array($this, '_censorCallback'), $content);

        return $content;
    }

    /**
     * Censor a word if its only by itself.
     *
     * @param array $matches
     * @return string
     */
    protected function _censorCallback($matches) {
        $length = mb_strlen(trim($matches[0]));
        $censored = '';
        $symbols = str_shuffle('*@#$*!?%');
        $i = 0;
        $s = 0;

        if ($length > 10) {
            $length = 10;
        }

        while ($i < $length) {
            $censored .= $symbols[$s];

            $i++;
            $s++;

            if ($s > 7) {
                $s = 0;
            }
        }

        return $censored;
    }

    /**
     * Prepare the regex pattern for each word.
     *
     * @param string $word
     * @return string
     */
    protected function _prepareRegex($word) {
        $letters = str_split($word);
        $regex = '';

        foreach ($letters as $letter) {
            $regex .= preg_quote($letter, '/') . '+';
        }

        $suffix = $this->getConfig('suffix');

        if (is_array($suffix)) {
            $suffix = implode('|', $suffix);
        }

        $regex .= '(?:' . $suffix . ')?';

        return $regex;
    }

}
