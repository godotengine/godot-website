<?php namespace ArrizalAmin\Portfolio\Models;

use Model;

/**
 * Category Model
 */
class Category extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'arrizalamin_portfolio_categories';

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array Translatable fields
     */
    public $translatable = ['name', 'description'];

    /**
     * @var array Relations
     */
    public $hasMany = [
        'items' => ['ArrizalAmin\Portfolio\Models\Item']
    ];

    /**
     * Set the PageUrl parameter to link the correct page
     *
     * @param $pageName
     * @param $controller
     * @return mixed
     */
    public function setPageUrl($pageName, $controller)
    {
        $params = [
            'selected_cat' => $this->slug,
        ];

        return $this->pageUrl = $controller->pageUrl($pageName, $params);
    }

    /**
     * Add translation support to this model, if available.
     * @return void
     */
    public static function boot()
    {
        // Call default functionality (required)
        parent::boot();

        // Check the translate plugin is installed
        if (!class_exists('RainLab\Translate\Behaviors\TranslatableModel'))
            return;

        // Extend the constructor of the model
        self::extend(function($model){

            // Implement the translatable behavior
            $model->implement[] = 'RainLab.Translate.Behaviors.TranslatableModel';
        });
    }

}
