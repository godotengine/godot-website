<?php namespace RainLab\Translate\Tests\Fixtures\Classes;

use Model;
use Cms\Classes\CmsCompoundObject;

/**
 * Feature Model
 */
class Feature extends CmsCompoundObject
{
    public $implement = ['@RainLab.Translate.Behaviors.TranslatableCmsObject'];

    /**
     * @var array Attributes that support translation, if available.
     */
    public $translatable = [
        'markup'
    ];

    /**
     * @var string The container name associated with the model, eg: pages.
     */
    protected $dirName = 'features';
}
