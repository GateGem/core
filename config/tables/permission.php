<?php

use LaraPlatform\Core\Http\Action\LoadPermission;

return [
    'model' => \LaraPlatform\Core\Models\Permission::class,
   // 'DisableModule' => true,
    'title' => 'Quyền',
    'emptyData' => 'Không có dữ liệu',
    'enableAction' => true,

    'action' => [
        'title' => '#',
        'add' => true,
        'edit' => true,
        'delete' => true,
        'export' => true,
        'inport' => true,
        'append' => [
            [
                'title' => 'Cập nhật quyền',
                'icon' => '<i class="bi bi-magic"></i>',
                'type' => 'new',
                'permission' => 'core.module.load-permission',
                'action' => function () {
                    return get_do_action_hook(LoadPermission::class, '{}');
                }
            ]
        ]
    ],
    'fields' => [
        [
            'field' => 'group',
            'title' => 'Nhóm'
        ],
        [
            'field' => 'slug',
            'title' => 'slug'
        ],
        [
            'field' => 'name',
            'title' => 'Tên Quyền'
        ],
    ]
];
