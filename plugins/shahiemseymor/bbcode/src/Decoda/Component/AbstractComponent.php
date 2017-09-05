<?php
/**
 * @copyright   2006-2014, Miles Johnson - http://milesj.me
 * @license     https://github.com/milesj/decoda/blob/master/license.md
 * @link        http://milesj.me/code/php/decoda
 */

namespace Decoda\Component;

use Decoda\Decoda;
use Decoda\Component;
use Decoda\Loader;

/**
 * Provides default shared functionality for Filters, Hooks and Engines.
 */
abstract class AbstractComponent implements Component {

    /**
     * Configuration.
     *
     * @type array
     */
    protected $_config = array();

    /**
     * List of Loaders.
     *
     * @type \Decoda\Loader[]
     */
    protected $_loaders = array();

    /**
     * Decoda object.
     *
     * @type \Decoda\Decoda
     */
    protected $_parser;

    /**
     * Apply configuration.
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        $this->setConfig($config);
        $this->construct();
    }

    /**
     * {@inheritdoc}
     */
    public function addLoader(Loader $loader) {
        $this->_loaders[] = $loader;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function construct() {
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig($key) {
        return isset($this->_config[$key]) ? $this->_config[$key] : null;
    }

    /**
     * {@inheritdoc}
     */
    public function getLoaders() {
        return $this->_loaders;
    }

    /**
     * {@inheritdoc}
     */
    public function getParser() {
        return $this->_parser;
    }

    /**
     * {@inheritdoc}
     */
    public function message($key, array $vars = array()) {
        return $this->getParser()->message($key, $vars);
    }

    /**
     * {@inheritdoc}
     */
    public function setConfig(array $config) {
        $this->_config = $config + $this->_config;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setParser(Decoda $parser) {
        $this->_parser = $parser;

        return $this;
    }

}