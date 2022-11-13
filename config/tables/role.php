<?php

use LaraIO\Core\Livewire\Modal;

return [
    'model' => \LaraIO\Core\Models\Role::class,
    //'DisableModule' => true,
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
               'permission' => 'core.module.user.permission',
                'type' => 'update',
                'action' => function ($id) {
                    return 'wire:component="core::page.permission.role({\'roleId\':\'' . $id . '\'})"';
                }
            ], [
                'title' => 'Quản lý quyền',
                'icon' => '<i class="bi bi-magic"></i>',
                'permission' => 'core.permission',
                'class' => 'btn-primary',
                'type' => 'new',
                'action' => function () {
                    return 'wire:component="core::table.index({\'module\':\'permission\'})"';
                }
            ]
        ]
    ],
    'formSize' => Modal::Small,
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
