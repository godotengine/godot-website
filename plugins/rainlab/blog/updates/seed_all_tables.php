<?php namespace RainLab\Blog\Updates;

use Carbon\Carbon;
use RainLab\Blog\Models\Post;
use RainLab\Blog\Models\Category;
use October\Rain\Database\Updates\Seeder;

class SeedAllTables extends Seeder
{

    public function run()
    {
        Post::create([
            'title' => 'First blog post',
            'slug' => 'first-blog-post',
            'content' => '
This is your first ever **blog post**! It might be a good idea to update this post with some more relevant content.

You can edit this content by selecting **Blog** from the administration back-end menu.

*Enjoy the good times!*
            ',
            'excerpt' => 'The first ever blog post is here. It might be a good idea to update this post with some more relevant content.',
            'published_at' => Carbon::now(),
            'published' => true
        ]);

        Category::create([
            'name' => trans('rainlab.blog::lang.categories.uncategorized'),
            'slug' => 'uncategorized',
        ]);
    }

}
