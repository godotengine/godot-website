<?php
/**
 * @copyright   2006-2014, Miles Johnson - http://milesj.me
 * @license     https://github.com/milesj/decoda/blob/master/license.md
 * @link        http://milesj.me/code/php/decoda
 */

namespace Decoda\Hook;

use Decoda\Hook\AbstractHook;

/**
 * Converts URLs and emails (not wrapped in tags) into clickable links.
 */
class ClickableHook extends AbstractHook {

    /**
     * Matches a link or an email, and converts it to an anchor tag.
     *
     * @param string $content
     * @return string
     */
    public function afterParse($content) {
        $parser = $this->getParser();

        // Janky way of detecting if a link is wrapped in an anchor tag
        // We have to check the values before the link and validate them
        // If quotes or a closing carrot exist, do not wrap
        // <br> is acceptable since \n are completely removed
        if ($parser->hasFilter('Url')) {
            $protocols = $parser->getFilter('Url')->getConfig('protocols');
            $chars = preg_quote('-_=+|\;:&?/[]%,.!@#$*(){}"\'', '/');

            $pattern = implode('', array(
                '(' . implode('|', $protocols) . ')s?:\/\/', // protocol
                '([\w\.\+]+:[\w\.\+]+@)?', // login
                '([\w\.]{5,255}+)', // domain, tld
                '(:[0-9]{0,6}+)?', // port
                '([a-z0-9' . $chars . ']+)?', // query
                '(#[a-z0-9' . $chars . ']+)?' // fragment
            ));

            $content = preg_replace_callback('/("|\'|>|<br>|<br\/>)?(' . $pattern . ')/is', array($this, '_urlCallback'), $content);
        }

        // Based on schema: http://en.wikipedia.org/wiki/Email_address
        if ($parser->hasFilter('Email')) {
            $pattern = '/("|\'|>|:|<br>|<br\/>)?(([-a-z0-9\.\+!]{1,64}+)@([-a-z0-9]+\.[a-z\.]+))/is';

            $content = preg_replace_callback($pattern, array($this, '_emailCallback'), $content);
        }

        return $content;
    }

    /**
     * Callback for email processing.
     *
     * @param array $matches
     * @return string
     */
    protected function _emailCallback($matches) {
        if ($matches[1] === '<br>' || $matches[1] === '<br/>') {
            $matches[0] = $matches[2];

        } else if ($matches[1] !== '') {
            return $matches[0];
        }

        return $matches[1] . $this->getParser()->getFilter('Email')->parse(array(
            'tag' => 'email',
            'attributes' => array()
        ), trim($matches[0]));
    }

    /**
     * Callback for URL processing.
     *
     * @param array $matches
     * @return string
     */
    protected function _urlCallback($matches) {
        if ($matches[1] === '<br>' || $matches[1] === '<br/>') {
            $matches[0] = $matches[2];

        } else if ($matches[1] !== '') {
            return $matches[0];
        }

        return $matches[1] . $this->getParser()->getFilter('Url')->parse(array(
            'tag' => 'url',
            'attributes' => array()
        ), trim($matches[0]));
    }

}