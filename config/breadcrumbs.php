<?php

return [
    'admin' => [
        'dashboard' => [
            'name' => 'Dashboard',
            'route_name' => 'admin.dashboard',
            'posts' => [
                'name' => 'Posts',
                'route_name' => 'admin.posts.index',
                'create' => [
                    'name' => 'Create Post',
                    'route_name' => 'admin.posts.create',
                ],
                'update' => [
                    'name' => 'Update Post',
                    'route_name' => 'admin.posts.edit',
                ],
            ],
            'categories' => [
                'name' => 'Categories',
                'route_name' => 'admin.categories.index',
                'create' => [
                    'name' => 'Create Category',
                    'route_name' => 'admin.categories.create',
                ],
                'update' => [
                    'name' => 'Update Category',
                    'route_name' => 'admin.categories.edit',
                ],
            ]
        ]
    ],

];