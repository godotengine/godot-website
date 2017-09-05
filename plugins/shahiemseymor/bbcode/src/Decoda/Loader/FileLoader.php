<?php
/**
 * @copyright   2006-2014, Miles Johnson - http://milesj.me
 * @license     https://github.com/milesj/decoda/blob/master/license.md
 * @link        http://milesj.me/code/php/decoda
 */

namespace Decoda\Loader;

use \Decoda\Exception\IoException;
use \Decoda\Exception\UnsupportedTypeException;

/**
 * A resource loader for files on the local system.
 */
class FileLoader extends AbstractLoader {

    /**
     * Path to file.
     *
     * @type string
     */
    protected $_path;

    /**
     * Store the path and validate the files existence.
     *
     * @param string $path
     * @throws \Decoda\Exception\IoException
     */
    public function __construct($path) {
        if (!file_exists($path)) {
            throw new IoException(sprintf('File %s does not exist', $path));
        }

        $this->_path = $path;
    }

    /**
     * Load the resources contents.
     *
     * @return array
     * @throws \Decoda\Exception\UnsupportedTypeException
     */
    public function load() {
        $ext = mb_strtolower(pathinfo($this->_path, PATHINFO_EXTENSION));

        switch ($ext) {
            case 'php':
                return include $this->_path;
            break;
            case 'json':
                return json_decode(file_get_contents($this->_path), true);
            break;
            case 'ini':
                return parse_ini_file($this->_path, true);
            break;
            case 'txt':
                return file($this->_path, FILE_IGNORE_NEW_LINES);
            break;
        }

        throw new UnsupportedTypeException(sprintf('Unsupported FileLoader file type %s', $ext));
    }

}