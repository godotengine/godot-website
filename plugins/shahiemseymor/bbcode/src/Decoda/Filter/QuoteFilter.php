<?php
/**
 * @copyright   2006-2014, Miles Johnson - http://milesj.me
 * @license     https://github.com/milesj/decoda/blob/master/license.md
 * @link        http://milesj.me/code/php/decoda
 */

namespace Decoda\Filter;

use Decoda\Decoda;

/**
 * Provides the tag for quoting users and blocks of texts.
 */
class QuoteFilter extends AbstractFilter {

    /**
     * Configuration.
     *
     * @type array
     */
    protected $_config = array(
        'dateFormat' => 'M jS Y, H:i:s'
    );

    /**
     * Supported tags.
     *
     * @type array
     */
    protected $_tags = array(
        'quote' => array(
            'template' => 'quote',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_BOTH,
            'attributes' => array(
                'default' => self::WILDCARD,
                'date' => self::WILDCARD
            ),
            'mapAttributes' => array(
                'default' => 'author'
            ),
            'maxChildDepth' => 2,
            'persistContent' => false,
            'stripContent' => true
        )
    );

}