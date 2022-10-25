<?php

use LaraPlatform\Core\Builder\Modal\ModalSize;

return [
    'model' => \DevHau\Modules\Models\Role::class,
    'DisableModule' => true,
    'title' => 'Vai trò',
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
                'title' => 'Phân quyền',
                'icon' => '<i class="bi bi-magic"></i>',
                'permission' => 'admin.role.permission',
                'type' => 'update',
                'action' => function ($id) {
                    return 'wire:openmodal="devhau-module::admin.role.permission({\'roleId\':\'' . $id . '\'})"';
                }
            ], [
                'title' => 'Quản lý quyền',
                'icon' => '<i class="bi bi-magic"></i>',
                'permission' => 'admin.permission',
                'class' => 'btn-primary',
                'type' => 'new',
                'action' => function () {
                    return 'wire:openmodal="devhau-module::admin.permission.index()"';
                }
            ]
        ]
    ],
    'formSize' => ModalSize::Small,
    'fields' => [
        [
            'field' => 'slug',
            'title' => 'slug'
        ],
        [
            'field' => 'name',
            'title' => 'Tên vai trò'
        ],
    ]
];
