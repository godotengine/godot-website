<?php
/**
 * @copyright   2006-2014, Miles Johnson - http://milesj.me
 * @license     https://github.com/milesj/decoda/blob/master/license.md
 * @link        http://milesj.me/code/php/decoda
 */

namespace Decoda\Engine;

use Decoda\Component\AbstractComponent;
use Decoda\Filter;
use Decoda\Engine;

/**
 * Provides default methods for engines.
 */
abstract class AbstractEngine extends AbstractComponent implements Engine {

    /**
     * Lookup paths.
     *
     * @type array
     */
    protected $_paths = array();

    /**
     * Current filter.
     *
     * @type \Decoda\Filter
     */
    protected $_filter;

    /**
     * {@inheritdoc}
     */
    public function addPath($path) {
        if (substr($path, -1) !== '/') {
            $path .= '/';
        }

        $this->_paths[] = $path;

        return $this;
    }

    /**
     * Escape HTML characters and entities.
     *
     * @param string $string
     * @return string
     */
    public function escape($string) {
        return $this->getParser()->escape($string);
    }

    /**
     * {@inheritdoc}
     */
    public function getFilter() {
        return $this->_filter;
    }

    /**
     * {@inheritdoc}
     */
    public function getPaths() {
        return $this->_paths;
    }

    /**
     * {@inheritdoc}
     */
    public function setFilter(Filter $filter) {
        $this->_filter = $filter;

        return $this;
    }

}
