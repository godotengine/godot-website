<?php namespace RainLab\Blog\Models;

use Backend\Models\ExportModel;
use ApplicationException;

/**
 * Post Export Model
 */
class PostExport extends ExportModel
{
    public $table = 'rainlab_blog_posts';

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'post_user' => [
            'Backend\Models\User',
            'key' => 'user_id'
        ]
    ];

    public $belongsToMany = [
        'post_categories' => [
            'RainLab\Blog\Models\Category',
            'table'    => 'rainlab_blog_posts_categories',
            'key'      => 'post_id',
            'otherKey' => 'category_id'
        ]
    ];

    public $hasMany = [
        'featured_images' => [
            'System\Models\File',
            'order' => 'sort_order',
            'key' => 'attachment_id',
            'conditions' => 'field = "featured_images" AND attachment_type = "RainLab\\\\Blog\\\\Models\\\\Post"'
        ]
    ];

    /**
     * The accessors to append to the model's array form.
     * @var array
     */
    protected $appends = [
        'author_email',
        'categories',
        'featured_image_urls'
    ];

    public function exportData($columns, $sessionKey = null)
    {
        $result = self::make()
            ->with([
                'post_user',
                'post_categories',
                'featured_images'
            ])
            ->get()
            ->toArray()
        ;

        return $result;
    }

    public function getAuthorEmailAttribute()
    {
        if (!$this->post_user) {
            return '';
        }

        return $this->post_user->email;
    }

    public function getCategoriesAttribute()
    {
        if (!$this->post_categories) {
            return '';
        }

        return $this->encodeArrayValue($this->post_categories->lists('name'));
    }

    public function getFeaturedImageUrlsAttribute()
    {
        if (!$this->featured_images) {
            return '';
        }

        return $this->encodeArrayValue($this->featured_images->map(function ($image) {
            return $image->getPath();
        }));
    }
}
