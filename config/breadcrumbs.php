<?php

return [
    'admin' => [
        'dashboard' => [
            'name' => 'Dashboard',
            'route_name' => 'admin.dashboard',
            'posts' => [
                'name' => 'Posts',
                'route_name' => 'admin.posts.index',
                'show' => [
                    'name' => 'Post Details',
                    'route_name' => 'admin.posts.show',
                ],
                'create' => [
                    'name' => 'Add New Post',
                    'route_name' => 'admin.posts.create',
                ],
                'edit' => [
                    'name' => 'Edit Post',
                    'route_name' => 'admin.posts.edit',
                ],
            ],
            'categories' => [
                'name' => 'Categories',
                'route_name' => 'admin.categories.index',
                'create' => [
                    'name' => 'Add New Category',
                    'route_name' => 'admin.categories.create',
                ],
                'edit' => [
                    'name' => 'Edit Category',
                    'route_name' => 'admin.categories.edit',
                ],
            ],
            'media' => [
                'name' => 'Media Manager',
                'route_name' => 'admin.media.index',
                'create' => [
                    'name' => 'Add New Media',
                    'route_name' => 'admin.media.create'
                ],
            ]
        ]
    ],

];
