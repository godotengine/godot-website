<?php
/**
 * @copyright   2006-2014, Miles Johnson - http://milesj.me
 * @license     https://github.com/milesj/decoda/blob/master/license.md
 * @link        http://milesj.me/code/php/decoda
 */

namespace Decoda\Filter;

use Decoda\Decoda;

/**
 * Provides tags for text and font styling.
 */
class TextFilter extends AbstractFilter {

    /**
     * Supported tags.
     *
     * @type array
     */
    protected $_tags = array(
        'font' => array(
            'htmlTag' => 'span',
            'displayType' => Decoda::TYPE_INLINE,
            'allowedTypes' => Decoda::TYPE_INLINE,
            'escapeAttributes' => false,
            'attributes' => array(
                'default' => array('/^[a-z0-9\-\s,\.\']+$/i', 'font-family: {default}')
            ),
            'mapAttributes' => array(
                'default' => 'style'
            )
        ),
        'size' => array(
            'htmlTag' => 'span',
            'displayType' => Decoda::TYPE_INLINE,
            'allowedTypes' => Decoda::TYPE_INLINE,
            'attributes' => array(
                'default' => array('/^[1-2]{1}[0-9]{1}$/', 'font-size: {default}px'),
            ),
            'mapAttributes' => array(
                'default' => 'style'
            )
        ),
        'color' => array(
            'htmlTag' => 'span',
            'displayType' => Decoda::TYPE_INLINE,
            'allowedTypes' => Decoda::TYPE_INLINE,
            'attributes' => array(
                'default' => array('/^(?:#[0-9a-f]{3,6}|[a-z]+)$/i', 'color: {default}'),
            ),
            'mapAttributes' => array(
                'default' => 'style'
            )
        ),
        'h1' => array(
            'htmlTag' => 'h1',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_INLINE
        ),
        'h2' => array(
            'htmlTag' => 'h2',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_INLINE
        ),
        'h3' => array(
            'htmlTag' => 'h3',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_INLINE
        ),
        'h4' => array(
            'htmlTag' => 'h4',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_INLINE
        ),
        'h5' => array(
            'htmlTag' => 'h5',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_INLINE
        ),
        'h6' => array(
            'htmlTag' => 'h6',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_INLINE
        )
    );

}