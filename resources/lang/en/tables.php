<?php
return [
    'module' => [
        'title' => 'Module managment',
        'field' => [
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'key'=>'Key'
        ]
    ],
    'plugin' => [
        'title' => 'Plugin managment',
        'field' => [
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status'
        ]
    ],
    'theme' => [
        'title' => 'Theme managment',
        'field' => [
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status'
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
        'title' => 'role managment',
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
        'title' => 'permission managment',
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
        'title' => 'schedule managment'
    ],
    'schedule_history' => [
        'title' => 'schedule history managment'
    ]
];
