<?php
/**
 * @copyright   2006-2014, Miles Johnson - http://milesj.me
 * @license     https://github.com/milesj/decoda/blob/master/license.md
 * @link        http://milesj.me/code/php/decoda
 */

namespace Decoda;

/**
 * Defines the methods for all Components to implement.
 */
interface Component {

    /**
     * Add a loader.
     *
     * @param \Decoda\Loader $loader
     * @return \Decoda\Component
     */
    public function addLoader(Loader $loader);

    /**
     * Method called immediately after the constructor.
     *
     * @return void
     */
    public function construct();

    /**
     * Return a specific configuration key value.
     *
     * @param string $key
     * @return mixed
     */
    public function getConfig($key);

    /**
     * Return all the Loaders.
     *
     * @return \Decoda\Loader[]
     */
    public function getLoaders();

    /**
     * Return the Decoda parser.
     *
     * @return \Decoda\Decoda
     */
    public function getParser();

    /**
     * Return a message string from the parser.
     *
     * @param string $key
     * @param array $vars
     * @return string
     */
    public function message($key, array $vars = array());

    /**
     * Modify configuration.
     *
     * @param array $config
     * @return \Decoda\Component
     */
    public function setConfig(array $config);

    /**
     * Set the Decoda parser.
     *
     * @param \Decoda\Decoda $parser
     * @return \Decoda\Component
     */
    public function setParser(Decoda $parser);

}