<?php namespace RainLab\Blog\Models;

use Backend\Models\ImportModel;
use Backend\Models\User as AuthorModel;
use ApplicationException;
use Exception;

/**
 * Post Import Model
 */
class PostImport extends ImportModel
{
    public $table = 'rainlab_blog_posts';

    /**
     * Validation rules
     */
    public $rules = [
        'title'   => 'required',
        'content' => 'required'
    ];

    protected $authorEmailCache = [];

    protected $categoryNameCache = [];

    public function getDefaultAuthorOptions()
    {
        return AuthorModel::all()->lists('full_name', 'email');
    }

    public function getCategoriesOptions()
    {
        return Category::lists('name', 'id');
    }

    public function importData($results, $sessionKey = null)
    {
        $firstRow = reset($results);

        /*
         * Validation
         */
        if ($this->auto_create_categories && !array_key_exists('categories', $firstRow)) {
            throw new ApplicationException('Please specify a match for the Categories column.');
        }

        /*
         * Import
         */
        foreach ($results as $row => $data) {
            try {

                if (!$title = array_get($data, 'title')) {
                    $this->logSkipped($row, 'Missing post title');
                    continue;
                }

                /*
                 * Find or create
                 */
                $post = Post::make();

                if ($this->update_existing) {
                    $post = $this->findDuplicatePost($data) ?: $post;
                }

                $postExists = $post->exists;

                /*
                 * Set attributes
                 */
                $except = ['id', 'categories', 'author_email'];

                foreach (array_except($data, $except) as $attribute => $value) {
                    $post->{$attribute} = $value ?: null;
                }

                if ($author = $this->findAuthorFromEmail($data)) {
                    $post->user_id = $author->id;
                }

                $post->forceSave();

                if ($categoryIds = $this->getCategoryIdsForPost($data)) {
                    $post->categories()->sync($categoryIds, false);
                }

                /*
                 * Log results
                 */
                if ($postExists) {
                    $this->logUpdated();
                }
                else {
                    $this->logCreated();
                }
            }
            catch (Exception $ex) {
                $this->logError($row, $ex->getMessage());
            }
        }
    }

    protected function findAuthorFromEmail($data)
    {
        if (!$email = array_get($data, 'email', $this->default_author)) {
            return null;
        }

        if (isset($this->authorEmailCache[$email])) {
            return $this->authorEmailCache[$email];
        }

        $author = AuthorModel::where('email', $email)->first();
        return $this->authorEmailCache[$email] = $author;
    }

    protected function findDuplicatePost($data)
    {
        if ($id = array_get($data, 'id')) {
            return Post::find($id);
        }

        $title = array_get($data, 'title');
        $post = Post::where('title', $title);

        if ($slug = array_get($data, 'slug')) {
            $post->orWhere('slug', $slug);
        }

        return $post->first();
    }

    protected function getCategoryIdsForPost($data)
    {
        $ids = [];

        if ($this->auto_create_categories) {
            $categoryNames = $this->decodeArrayValue(array_get($data, 'categories'));

            foreach ($categoryNames as $name) {
                if (!$name = trim($name)) {
                    continue;
                }

                if (isset($this->categoryNameCache[$name])) {
                    $ids[] = $this->categoryNameCache[$name];
                }
                else {
                    $newCategory = Category::firstOrCreate(['name' => $name]);
                    $ids[] = $this->categoryNameCache[$name] = $newCategory->id;
                }
            }
        }
        elseif ($this->categories) {
            $ids = (array) $this->categories;
        }

        return $ids;
    }
}
