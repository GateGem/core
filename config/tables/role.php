<?php

use GateGem\Core\Livewire\Modal;

return [
    'model' => \GateGem\Core\Models\Role::class,
    //'DisableModule' => true,
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
                'title' =>  'core::tables.role.button.permission',
                'icon' => '<i class="bi bi-magic"></i>',
                'permission' => 'core.role.permission',
                'class' => 'btn-primary',
                'type' => 'update',
                'action' => function ($id) {
                    return 'wire:component="core::page.permission.role({\'roleId\':\'' . $id . '\'})"';
                }
            ]
        ]
    ],
    'formSize' => Modal::Small,
    'fields' => [
        [
            'field' => 'slug',
            'title' => 'core::tables.role.field.slug'
        ],
        [
            'field' => 'name',
            'title' => 'core::tables.role.field.name'
        ],
    ]
];
