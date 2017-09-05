<?php
/**
 * @copyright   2006-2014, Miles Johnson - http://milesj.me
 * @license     https://github.com/milesj/decoda/blob/master/license.md
 * @link        http://milesj.me/code/php/decoda
 */

namespace Decoda\Filter;

use Decoda\Decoda;

/**
 * Provides tags for block styled elements.
 */
class BlockFilter extends AbstractFilter {

    /**
     * Configuration.
     *
     * @type array
     */
    protected $_config = array(
        'spoilerToggle' => "$('#spoiler-content-{id}').toggle();"
    );

    /**
     * Supported tags.
     *
     * @type array
     */
    protected $_tags = array(
        'align' => array(
            'htmlTag' => 'div',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_BOTH,
            'attributes' => array(
                'default' => array('/^(?:left|center|right|justify)$/i', 'align-{default}')
            ),
            'mapAttributes' => array(
                'default' => 'class'
            )
        ),
        'left' => array(
            'htmlTag' => 'div',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_BOTH,
            'htmlAttributes' => array(
                'class' => 'align-left'
            )
        ),
        'right' => array(
            'htmlTag' => 'div',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_BOTH,
            'htmlAttributes' => array(
                'class' => 'align-right'
            )
        ),
        'center' => array(
            'htmlTag' => 'div',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_BOTH,
            'htmlAttributes' => array(
                'class' => 'align-center'
            )
        ),
        'justify' => array(
            'htmlTag' => 'div',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_BOTH,
            'htmlAttributes' => array(
                'class' => 'align-justify'
            )
        ),
        'float' => array(
            'htmlTag' => 'div',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_BOTH,
            'attributes' => array(
                'default' => array('/^(?:left|right|none)$/i', 'float-{default}')
            ),
            'mapAttributes' => array(
                'default' => 'class'
            )
        ),
        'hide' => array(
            'htmlTag' => 'span',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_BOTH,
            'htmlAttributes' => array(
                'style' => 'display: none'
            ),
            'stripContent' => true
        ),
        'alert' => array(
            'htmlTag' => 'div',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_BOTH,
            'htmlAttributes' => array(
                'class' => 'decoda-alert'
            ),
            'stripContent' => true
        ),
        'note' => array(
            'htmlTag' => 'div',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_BOTH,
            'htmlAttributes' => array(
                'class' => 'decoda-note'
            ),
            'stripContent' => true
        ),
        'div' => array(
            'htmlTag' => 'div',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_BOTH,
            'attributes' => array(
                'default' => self::ALPHA,
                'class' => self::ALNUM
            ),
            'mapAttributes' => array(
                'default' => 'id'
            ),
            'stripContent' => true
        ),
        'spoiler' => array(
            'template' => 'spoiler',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_BOTH,
            'stripContent' => true
        )
    );

}