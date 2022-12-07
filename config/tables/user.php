<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\Core;

return [
    'model' => GateGem\Core\Models\User::class,
    'modelkey' => 'id',
    'excel' => [],
    'action' => [
        'title' => '#',
        'add' => true,
        'edit' => true,
        'delete' => true,
        'export' => true,
        'inport' => true,
        'append' => [
            [
                'title' => 'core::tables.user.button.permission',
                'icon' => '<i class="bi bi-magic"></i>',
                'permission' => 'core.user.permission',
                'class' => 'btn-primary',
                'type' => 'update',
                'action' => function ($id) {
                    return 'wire:component="core::page.permission.user({\'userId\':\'' . $id . '\'})"';
                }
            ]
        ]
    ],
    'formEdit' => '',
    'formRule' => function ($id, $isNew) {
        return [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    },

    'ruleMessages' => function ($id, $isNew) {
        return [];
    },
    'formInclude' => '',
    'formClass' => 'p-1',
    'layoutForm' => [
        'common' => [
            [
                ['key' => 'row1_1', 'column' => FieldBuilder::Col6],
                ['key' => 'row1_2', 'column' => FieldBuilder::Col6],
            ],
            [
                ['key' => 'row2_1', 'column' => FieldBuilder::Col12],
            ]
        ]
    ],
    'fields' => [
        [
            'field' => 'name',
            'fieldType' => FieldBuilder::Text,
            'title' => 'core::tables.user.field.name',
            'keyColumn' => 'row1_1'
        ],
        [
            'field' => 'avatar',
            'imageFolder' => 'user',
            'fieldType' => FieldBuilder::Image,
            'title' => 'core::tables.user.field.avatar',
            'keyColumn' => 'row1_1'
        ],
        [
            'field' => 'email',
            'title' => 'core::tables.user.field.email',
            'view' => false,
            'keyColumn' => 'row1_2'
        ],
        [
            'field' => 'info',
            'title' => 'core::tables.user.field.info',
            'fieldType' => FieldBuilder::Textarea,
            'keyColumn' => 'row2_1'
        ],
        [
            'field' => 'password',
            'title' => 'core::tables.user.field.password',
            'fieldType' => FieldBuilder::Password,
            'view' => false,
            'edit' => false,
            'keyColumn' => 'row1_1'
        ],
        [
            'fieldType' => FieldBuilder::Dropdown,
            'default' => 0,
            'funcData' => function () {
                return collect([0, 1])->map(function ($item) {
                    return [
                        'id' => $item,
                        'text' => __('core::enums.status.' . $item)
                    ];
                });
            },
            'funcCell' => function ($row, $column) {
                if (Core::checkPermission('core.user.change-status')) {
                    if (isset($row[$column['field']]) && $row[$column['field']] == 1) {
                        return '<button ' . aciton_change_field_value_hook('{"message":"core::tables.user.message.unactivated","id":' . $row['id'] . ',"field":"' . $column['field'] . '","value":0}') . ' class="btn btn-primary btn-sm text-nowrap">' . __('core::enums.status.1') . '</button>';
                    }
                    return '<button ' . aciton_change_field_value_hook('{"id":' . $row['id'] . ',"field":"' . $column['field'] . '","value":1}') . ' class="btn btn-danger btn-sm text-nowrap">' . __('core::enums.status.0') . '</button>';
                }
                if (isset($row[$column['field']]) && $row[$column['field']] == 1) {
                    return __('core::enums.status.1');
                }
                return __('core::enums.status.0');
            },
            'field' => 'status',
            'title' => 'core::tables.user.field.status',
            'keyColumn' => 'row1_2',
        ]
    ]
];
