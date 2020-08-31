<?php namespace RainLab\Translate\Tests\Fixtures\Models;

use Model;

/**
 * Country Model
 */
class Country extends Model
{
    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = ['name', 'states'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'translate_test_countries';

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array Jsonable fields
     */
    protected $jsonable = ['states'];
}
