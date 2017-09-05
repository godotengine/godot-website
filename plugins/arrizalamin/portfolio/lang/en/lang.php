<?php

return [
    'plugin' => [
        'name' => 'Portfolio',
        'description' => 'A plugin that allows you to show off your past projects.',
    ],
    'navigation' => [
        'label' => 'Portfolio',
        'sideMenu' => [
            'items' => 'Items',
            'categories' => 'Categories',
            'tags' => 'Tags'
        ]
    ],
    'permissions' => [
        'tab' => 'Portfolio',
        'manage' => 'Manage Portfolio'
    ],
    'components' => [
        'portfolio' => [
            'name' => 'Portfolio List',
            'description' => 'Create a list of portfolio.',
            'properties' => [
                'category' => [
                    'title' => 'Category',
                    'placeholder' => 'Select Category',
                    'all' => 'All'
                ],
                'pageNumber' => [
                    'title' => 'Page Number',
                    'description' => 'This value is used to determine what page the user is on.'
                ],
                'itemsPerPage' => [
                    'title' => 'Items per page',
                    'validationMessage' => 'Invalid format of the items per page value'
                ],
                'order' => [
                    'title' => 'Order',
                    'placeholder' => 'Select Order',
                    'ascending' => 'Ascending',
                    'descending' => 'Descending'
                ],
                'group' => [
                    'advanced' => 'Advanced',
                    'links' => 'Links'
                ],
                'selectedTag' => [
                    'title' => 'Selected tag',
                    'description' => 'Don\'t change this value (default: {{ :selected_tag }})'
                ],
                'selectedCat' => [
                    'title' => 'Selected category',
                    'description' => 'Don\'t change this value (default: {{ :selected_cat }})'
                ],
                'itemPage' => [
                    'title' => 'Item page',
                    'description' => 'Page where portfolio items can be displayed.'
                ],
                'tagListPage' => [
                    'title' => 'Tag list page',
                    'description' => 'Page where portfolio items with matching tag are listed.'
                ],
                'catListPage' => [
                    'title' => 'Category page',
                    'description' => 'Page where portfolio items of the selected category are listed.'
                ],
            ],
        ],
        'item' => [
            'name' => 'Portfolio Item',
            'description' => 'Display a single item from the portfolio collection.',
            'properties' => [
                'item' => [
                    'title' => 'Item to show',
                    'description' => 'Select a item to show. Will be overridden by URL item selection.',
                    'none' => 'None',
                ],
                'itemSlug' => [
                    'title' => 'Item slug',
                    'description' => 'Item slug URL identifier'
                ],
            ],
        ],
    ],
    'controller' => [
        'view' => [
            'items' => [
                'new' => 'New Item',
                'breadcrumb_label' => 'Items',
                'return' => 'Return to items list',
                'creating' => 'Creating Item...',
                'delete_confirmation' => 'Do you really want to delete this item?'
            ],
            'categories' => [
                'new' => 'New Item',
                'breadcrumb_label' => 'Categories',
                'return' => 'Return to categories list',
                'creating' => 'Creating Category...',
                'delete_confirmation' => 'Do you really want to delete this category?'
            ],
            'tags' => [
                'new' => 'New Tag',
                'breadcrumb_label' => 'Tags',
                'return' => 'Return to tags list',
                'creating' => 'Creating Tag...',
                'delete_confirmation' => 'Do you really want to delete this tag?'
            ]
        ],
        'list' => [
            'items' => 'Manage Items',
            'categories' => 'Manage Categories',
            'tags' => 'Manage Tags'
        ],
        'form' => [
            'items' => [
                'title' => 'Item',
                'create' => 'Create Item',
                'update' => 'Update Item',
                'flashCreate' => 'The Item has been created successfully',
                'flashUpdate' => 'The Item has been updated successfully',
                'flashDelete' => 'The Item has been deleted successfully'
            ],
            'categories' => [
                'title' => 'Category',
                'create' => 'Create Category',
                'update' => 'Update Category',
                'flashCreate' => 'The Category has been created successfully',
                'flashUpdate' => 'The Category has been updated successfully',
                'flashDelete' => 'The Category has been deleted successfully'
            ],
            'tags' => [
                'title' => 'Tags',
                'create' => 'Create Tag',
                'update' => 'Update Tag',
                'flashCreate' => 'The Tag has been created successfully',
                'flashUpdate' => 'The Tag has been updated successfully',
                'flashDelete' => 'The Tag has been deleted successfully'
            ]
        ],
    ],
    'columns' => [
        'item' => [
            'id' => 'ID',
            'title' => 'Title',
            'category' => 'Category',
            'tags' => 'Tags',
            'video_url' => 'Video URL',
        ],
        'category' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description'
        ],
        'tag' => [
            'id' => 'ID',
            'name' => 'Name',
            'items' => 'Items with Tag'
        ]
    ],
    'fields' => [
        'item' => [
            'title' => 'Title',
            'category' => 'Category',
            'slug' => 'Slug',
            'tags' => 'Tags',
            'description' => 'Description',
            'images' => 'Images',
            'url' => 'URL',
            'video_url' => 'Video URL'
        ],
        'category' => [
            'name' => 'Name',
            'slug' => 'Slug',
            'description' => 'Description'
        ],
        'tag' => [
            'name' => 'Name',
            'items' => 'Items',
            'notavailable' => 'No items available'
        ]
    ],
];
