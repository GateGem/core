<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\Core;
use GateGem\Core\Facades\Module;

return [
    'DisableModule' => false,
    'funcData' => function () {
        return Module::getData();
    },
    'modalkey' => 'key',
    'excel' => [],
    'action' => [
        'title' => '#',
        'add' => false,
        'edit' => false,
        'delete' => false,
        'export' => false,
        'inport' => false,
        'append' => []
    ],
    'formEdit' => '',
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
            'title' => 'core::tables.module.field.name',
            'keyColumn' => 'row1_1'
        ],
        [
            'field' => 'key',
            'title' => 'core::tables.module.field.key',
            'keyColumn' => 'row1_2'
        ],
        [
            'field' => 'description',
            'title' => 'core::tables.module.field.description',
            'keyColumn' => 'row1_1'
        ],
        [
            'fieldType' => FieldBuilder::Dropdown,
            'funcData' => function () {
                return collect([0, 1])->map(function ($item) {
                    return [
                        'id' => $item,
                        'text' => __('core::enums.status.' . $item)
                    ];
                });
            },
            'funcCell' => function ($row, $column) {
                if (Core::checkPermission('core.module.change-status')) {
                    if (isset($row[$column['field']]) && $row[$column['field']] == 1) {
                        return '<button ' . aciton_change_field_value_hook('{"id":"' . $row['name'] . '","field":"' . $column['field'] . '","value":0,"key":"key"}') . ' class="btn btn-primary btn-sm text-nowrap">' . __('core::enums.status.1') . '</button>';
                    }
                    return '<button ' .  aciton_change_field_value_hook('{"id":"' . $row['name'] . '","field":"' . $column['field'] . '","value":1,"key":"key"}') . ' class="btn btn-danger btn-sm text-nowrap">' . __('core::enums.status.0') . '</button>';
                }

                if (isset($row[$column['field']]) && $row[$column['field']] == 1) {
                    return '<span class="bg-primary text-white p-2 rounded">'.__('core::enums.status.1').'</span>';
                }
                return '<span class="bg-warning text-white p-2 rounded">'.__('core::enums.status.1').'</span>';
            },
            'field' => 'status',
            'title' => 'core::tables.module.field.status',
            'keyColumn' => 'row1_2',
        ]
    ]
];
