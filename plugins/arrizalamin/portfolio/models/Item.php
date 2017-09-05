<?php namespace ArrizalAmin\Portfolio\Models;

use Model;

/**
 * Item Model
 */
class Item extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'arrizalamin_portfolio_items';

    /**
     * @var array Translatable fields
     */
    public $translatable = ['title', 'description'];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'category' => ['ArrizalAmin\Portfolio\Models\Category']
    ];
    public $attachMany = [
        'images' => ['System\Models\File']
    ];

    public $belongsToMany = [
        'tags' => [
            'ArrizalAmin\Portfolio\Models\Tag',
            'table' => 'arrizalamin_portfolio_item_tag',
            'order' => 'name'
        ]
    ];

    /**
     * @var array Container for tags to be attached
     */
    private $tags = [];

    /**
     * Get tagbox
     *
     * @return mixed
     */
    public function getTagboxAttribute(){
        return $this->tags()->lists('name');
    }

    /**
     * Set tags
     *
     * @param $tags
     */
    public function setTagboxAttribute($tags){
        $this->tags = $tags;
    }

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
            'item_slug' => $this->slug,
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

    public function save(array $options = NULL, $sessionKey = NULL)
    {
        parent::save($options, $sessionKey);

        if($this->tags){
            $ids = [];
            foreach($this->tags as $name){
                $create = Tag::firstOrCreate(['name' => $name]);
                $ids[] = $create->id;
            }

            $this->tags()->sync($ids);
        }
    }
}