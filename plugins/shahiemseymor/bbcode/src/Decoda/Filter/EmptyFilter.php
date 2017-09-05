<?php
/**
 * @copyright   2006-2014, Miles Johnson - http://milesj.me
 * @license     https://github.com/milesj/decoda/blob/master/license.md
 * @link        http://milesj.me/code/php/decoda
 */

namespace Decoda\Filter;

/**
 * An empty filter for no operation events.
 */
class EmptyFilter extends AbstractFilter {

    /**
     * Supported tags.
     *
     * @type array
     */
    protected $_tags = array(
        'root' => array()
    );

}