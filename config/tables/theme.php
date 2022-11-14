<?php

use LaraIO\Core\Builder\Form\FieldBuilder;
use LaraIO\Core\Facades\Theme;

return [
    'DisableModule' => false,
    'funcData' => function () {
        return Theme::getData();
    },
    'modalkey' => 'name',
    'excel' => [
        'template' => '',
        // 'import' => \LaraIO\Core\Excel\ExcelInport::class,
        // 'export' => \LaraIO\Core\Excel\ExcelExport::class,
        'header' => ['id', 'Họ Tên', 'Trạng thái'],
        'mapdata' => function ($item) {
            return [
                $item->id,
                $item->name,
                $item->status
            ];
        }
    ],
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
            'title' => 'Module Name',
            'keyColumn' => 'row1_1'
        ],
        [
            'field' => 'titile',
            'title' => 'Title',
            'view' => false,
            'keyColumn' => 'row1_2'
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
                if (\Gate::check('core.table.theme.change-status')) {
                    if (isset($row[$column['field']]) && $row[$column['field']] == 1) {
                        return '<button ' . aciton_change_field_value_hook('{"id":' . $row['name'] . ',"field":"' . $column['field'] . '","value":0,"key":"name"}') . ' class="btn btn-primary btn-sm text-nowrap">' . __('core::enums.status.1') . '</button>';
                    }
                    return '<button ' .  aciton_change_field_value_hook('{"id":' . $row['name'] . ',"field":"' . $column['field'] . '","value":1,"key":"name"}') . ' class="btn btn-danger btn-sm text-nowrap">' . __('core::enums.status.0') . '</button>';
                }

                if (isset($row[$column['field']]) && $row[$column['field']] == 1) {
                    return __('core::enums.status.1');
                }
                return __('core::enums.status.0');
            },
            'field' => 'status',
            'title' => 'core::tables.module.field.status',
            'keyColumn' => 'row1_2',
        ]
    ]
];
