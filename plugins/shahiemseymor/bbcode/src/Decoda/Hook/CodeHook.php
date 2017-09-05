<?php
/**
 * @copyright   2006-2014, Miles Johnson - http://milesj.me
 * @license     https://github.com/milesj/decoda/blob/master/license.md
 * @link        http://milesj.me/code/php/decoda
 */

namespace Decoda\Hook;

/**
 * Encodes and decodes [code] blocks so that the inner content doesn't get processed.
 */
class CodeHook extends AbstractHook {

    /**
     * Encode code blocks before parsing.
     *
     * @param string $string
     * @return mixed
     */
    public function beforeParse($string) {
        return preg_replace_callback('/\[code(.*?)\](.*?)\[\/code\]/is', array($this, '_encodeCallback'), $string);
    }

    /**
     * Decode code blocks after parsing.
     *
     * @param string $string
     * @return mixed
     */
    public function afterParse($string) {
        return preg_replace_callback('/\<pre(.*?)><code>(.*?)<\/code>\<\/pre>/is', array($this, '_decodeCallback'), $string);
    }

    /**
     * Encode content using base64.
     *
     * @param array $matches
     * @return string
     */
    protected function _encodeCallback(array $matches) {
        return '[code' . $matches[1] . ']' . base64_encode($matches[2]) . '[/code]';
    }

    /**
     * Decode content using base64.
     *
     * @param array $matches
     * @return string
     */
    protected function _decodeCallback(array $matches) {
        return '<pre' . $matches[1] . '><code>' . base64_decode($matches[2]) . '</code></pre>';
    }

}