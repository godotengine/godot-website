<?php namespace RainLab\Blog;

use Backend;
use Controller;
use RainLab\Blog\Models\Post;
use System\Classes\PluginBase;
use RainLab\Blog\Classes\TagProcessor;
use RainLab\Blog\Models\Category;
use Event;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'rainlab.blog::lang.plugin.name',
            'description' => 'rainlab.blog::lang.plugin.description',
            'author'      => 'Alexey Bobkov, Samuel Georges',
            'icon'        => 'icon-pencil',
            'homepage'    => 'https://github.com/rainlab/blog-plugin'
        ];
    }

    public function registerComponents()
    {
        return [
            'RainLab\Blog\Components\Post'       => 'blogPost',
            'RainLab\Blog\Components\Posts'      => 'blogPosts',
            'RainLab\Blog\Components\Categories' => 'blogCategories',
            'RainLab\Blog\Components\RssFeed'    => 'blogRssFeed'
        ];
    }

    public function registerPermissions()
    {
        return [
            'rainlab.blog.manage_settings' => [
                'tab'   => 'rainlab.blog::lang.blog.tab',
                'label' => 'rainlab.blog::lang.blog.manage_settings'
            ],
            'rainlab.blog.access_posts' => [
                'tab'   => 'rainlab.blog::lang.blog.tab',
                'label' => 'rainlab.blog::lang.blog.access_posts'
            ],
            'rainlab.blog.access_categories' => [
                'tab'   => 'rainlab.blog::lang.blog.tab',
                'label' => 'rainlab.blog::lang.blog.access_categories'
            ],
            'rainlab.blog.access_other_posts' => [
                'tab'   => 'rainlab.blog::lang.blog.tab',
                'label' => 'rainlab.blog::lang.blog.access_other_posts'
            ],
            'rainlab.blog.access_import_export' => [
                'tab'   => 'rainlab.blog::lang.blog.tab',
                'label' => 'rainlab.blog::lang.blog.access_import_export'
            ],
            'rainlab.blog.access_publish' => [
                'tab'   => 'rainlab.blog::lang.blog.tab',
                'label' => 'rainlab.blog::lang.blog.access_publish'
            ]
        ];
    }

    public function registerNavigation()
    {
        return [
            'blog' => [
                'label'       => 'rainlab.blog::lang.blog.menu_label',
                'url'         => Backend::url('rainlab/blog/posts'),
                'icon'        => 'icon-pencil',
                'iconSvg'     => 'plugins/rainlab/blog/assets/images/blog-icon.svg',
                'permissions' => ['rainlab.blog.*'],
                'order'       => 300,

                'sideMenu' => [
                    'new_post' => [
                        'label'       => 'rainlab.blog::lang.posts.new_post',
                        'icon'        => 'icon-plus',
                        'url'         => Backend::url('rainlab/blog/posts/create'),
                        'permissions' => ['rainlab.blog.access_posts']
                    ],
                    'posts' => [
                        'label'       => 'rainlab.blog::lang.blog.posts',
                        'icon'        => 'icon-copy',
                        'url'         => Backend::url('rainlab/blog/posts'),
                        'permissions' => ['rainlab.blog.access_posts']
                    ],
                    'categories' => [
                        'label'       => 'rainlab.blog::lang.blog.categories',
                        'icon'        => 'icon-list-ul',
                        'url'         => Backend::url('rainlab/blog/categories'),
                        'permissions' => ['rainlab.blog.access_categories']
                    ]
                ]
            ]
        ];
    }

    public function registerSettings()
    {
        return [
            'blog' => [
                'label' => 'rainlab.blog::lang.blog.menu_label',
                'description' => 'rainlab.blog::lang.blog.settings_description',
                'category' => 'rainlab.blog::lang.blog.menu_label',
                'icon' => 'icon-pencil',
                'class' => 'RainLab\Blog\Models\Settings',
                'order' => 500,
                'keywords' => 'blog post category',
                'permissions' => ['rainlab.blog.manage_settings']
            ]
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register()
    {
        /*
         * Register the image tag processing callback
         */
        TagProcessor::instance()->registerCallback(function($input, $preview) {
            if (!$preview) {
                return $input;
            }

            return preg_replace('|\<img src="image" alt="([0-9]+)"([^>]*)\/>|m',
                '<span class="image-placeholder" data-index="$1">
                    <span class="upload-dropzone">
                        <span class="label">Click or drop an image...</span>
                        <span class="indicator"></span>
                    </span>
                </span>',
            $input);
        });
    }

    public function boot()
    {
        /*
         * Register menu items for the RainLab.Pages plugin
         */
        Event::listen('pages.menuitem.listTypes', function() {
            return [
                'blog-category'       => 'rainlab.blog::lang.menuitem.blog_category',
                'all-blog-categories' => 'rainlab.blog::lang.menuitem.all_blog_categories',
                'blog-post'           => 'rainlab.blog::lang.menuitem.blog_post',
                'all-blog-posts'      => 'rainlab.blog::lang.menuitem.all_blog_posts',
                'category-blog-posts' => 'rainlab.blog::lang.menuitem.category_blog_posts',
            ];
        });

        Event::listen('pages.menuitem.getTypeInfo', function($type) {
            if ($type == 'blog-category' || $type == 'all-blog-categories') {
                return Category::getMenuTypeInfo($type);
            }
            elseif ($type == 'blog-post' || $type == 'all-blog-posts' || $type == 'category-blog-posts') {
                return Post::getMenuTypeInfo($type);
            }
        });

        Event::listen('pages.menuitem.resolveItem', function($type, $item, $url, $theme) {
            if ($type == 'blog-category' || $type == 'all-blog-categories') {
                return Category::resolveMenuItem($item, $url, $theme);
            }
            elseif ($type == 'blog-post' || $type == 'all-blog-posts' || $type == 'category-blog-posts') {
                return Post::resolveMenuItem($item, $url, $theme);
            }
        });
    }
}
