<?php
/**
 * @copyright   2006-2014, Miles Johnson - http://milesj.me
 * @license     https://github.com/milesj/decoda/blob/master/license.md
 * @link        http://milesj.me/code/php/decoda
 */

namespace Decoda;

/**
 * Defines the methods for all resource Loaders to implement.
 */
interface Loader extends Component {

    /**
     * Load the resources contents.
     *
     * @return array
     */
    public function load();

}