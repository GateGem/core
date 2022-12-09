<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\Core;
use GateGem\Core\Facades\Theme;

return [
    'DisableModule' => false,
    'funcData' => function () {
        return Theme::getData()->where(function ($item) {
            if (isset($item['hide']) && $item['hide'] == true) return false;
            return true;
        })->toBase();
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
            'field' => 'key',
            'fieldType' => FieldBuilder::Text,
            'title' => 'core::tables.theme.field.key',
            'keyColumn' => 'row1_1'
        ],
        [
            'field' => 'name',
            'fieldType' => FieldBuilder::Text,
            'title' => 'core::tables.theme.field.name',
            'keyColumn' => 'row1_1'
        ],
        [
            'field' => 'admin',
            'fieldType' => FieldBuilder::Text,
            'title' => 'core::tables.theme.field.admin',
            'funcCell' => function ($row, $column) {
                if (isset($row[$column['field']]) && $row[$column['field']] == 1) {
                    return 'Admin';
                }
                return 'Site';
            },
            'keyColumn' => 'row'
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
                if (Core::checkPermission('core.table.theme.change-status')) {
                    if (isset($row[$column['field']]) && $row[$column['field']] == 1) {
                        return '<button ' . aciton_change_field_value_hook('{"id":"' . $row['name'] . '","field":"' . $column['field'] . '","value":0,"key":"key"}') . ' class="btn btn-primary btn-sm text-nowrap">' . __('core::enums.status.1') . '</button>';
                    }
                    return '<button ' .  aciton_change_field_value_hook('{"id":"' . $row['name'] . '","field":"' . $column['field'] . '","value":1,"key":"key"}') . ' class="btn btn-danger btn-sm text-nowrap">' . __('core::enums.status.0') . '</button>';
                }

                if (isset($row[$column['field']]) && $row[$column['field']] == 1) {
                    return '<span class="bg-primary text-white p-2 rounded">' . __('core::enums.status.1') . '</span>';
                }
                return '<span class="bg-warning text-white p-2 rounded">' . __('core::enums.status.1') . '</span>';
            },
            'field' => 'status',
            'title' => 'core::tables.theme.field.status',
            'keyColumn' => 'row1_2',
        ]
    ]
];
