<?php

use LaraIO\Core\Http\Action\LoadPermission;
use LaraIO\Core\Livewire\Modal;

return [
    'model' => \LaraIO\Core\Models\Permission::class,
   // 'DisableModule' => true,
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
                'title' => 'core::tables.permission.button.load',
                'icon' => '<i class="bi bi-magic"></i>',
                'type' => 'new',
                'permission' => 'core.module.permission.load-permission',
                'action' => function () {
                    return get_do_action_hook(LoadPermission::class, '{}');
                }
            ]
        ]
    ],
    'modal_size' => Modal::Small,
    'fields' => [
        [
            'field' => 'group',
            'title' => 'core::tables.permission.field.group'
        ],
        [
            'field' => 'slug',
            'title' => 'core::tables.permission.field.slug'
        ],
        [
            'field' => 'name',
            'title' => 'core::tables.permission.field.name'
        ],
    ]
];
