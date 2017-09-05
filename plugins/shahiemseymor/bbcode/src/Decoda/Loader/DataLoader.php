<?php
/**
 * @copyright   2006-2014, Miles Johnson - http://milesj.me
 * @license     https://github.com/milesj/decoda/blob/master/license.md
 * @link        http://milesj.me/code/php/decoda
 */

namespace Decoda\Loader;

/**
 * A resource loader that returns data passed directly through the constructor.
 */
class DataLoader extends AbstractLoader {

    /**
     * Raw data.
     *
     * @type mixed
     */
    protected $_data;

    /**
     * Store the data directly for later use.
     *
     * @param mixed $data
     */
    public function __construct($data) {
        $this->_data = $data;
    }

    /**
     * Load the data.
     *
     * @return array
     */
    public function load() {
        return (array) $this->_data;
    }

}