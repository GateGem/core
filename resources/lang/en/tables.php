<?php
return [
    'module' => [
        'title' => 'Module managment',
        'field' => [
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'title'=>'Title',
            'key'=>'Key'
        ]
    ],
    'plugin' => [
        'title' => 'Plugin managment',
        'field' => [
            'name' => 'Name',
            'description' => 'Description',
            'title'=>'Title',
            'status' => 'Status'
        ]
    ],
    'theme' => [
        'title' => 'Theme managment',
        'field' => [
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'title'=>'Title'
        ]
    ],
    'user' => [
        'title' => 'User managment',
        'field' => [
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'info' => 'Info',
            'email'=>'Email'
        ],
        'message' => [
            'unactivated' => 'UnActivated'
        ],
        'button' => [
            'permission' => 'Setup permission'
        ]
    ],
    'role' => [
        'title' => 'Role managment',
        'field' => [
            'name' => 'Name',
            'slug' => 'Slug',
            'status' => 'Status',

        ],
        'message' => [
            'unactivated' => 'UnActivated'
        ],
        'button' => [
            'permission' => 'Setup permission'
        ]
    ],
    'permission' => [
        'title' => 'Permission managment',
        'field' => [
            'name' => 'Name',
            'slug' => 'slug',
            'group' => 'group'
        ],
        'message' => [
            'unactivated' => 'UnActivated'
        ],
        'button' => [
            'load' => 'Load'
        ]
    ],
    'schedule' => [
        'title' => 'Schedule managment'
    ],
    'schedule_history' => [
        'title' => 'Schedule history managment'
    ]
];
