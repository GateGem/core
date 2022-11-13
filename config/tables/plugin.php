<?php

use LaraIO\Core\Builder\Form\FieldBuilder;
use LaraIO\Core\Facades\Theme;

return [
    'DisableModule' => false,
    'title' => 'Quản lý Plugin',
    'emptyData' => 'Không có dữ liệu',
    'funcData' => function () {
       return collect([]);
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
            'field' => 'admin',
            'title' => 'Type',
            'fieldType' => FieldBuilder::Dropdown,
            'funcData' => function () {
                return [
                    [
                        'id' => 0,
                        'text' => 'User'
                    ],
                    [
                        'id' => 1,
                        'text' => 'Admin'
                    ]
                ];
            },
            'funcCell' => function ($row, $column) {
                if (\Gate::check('core.module.plugin.change-status')) {
                    if (isset($row[$column['field']]) && $row[$column['field']] == 1) {
                        return '<button wire:click="ChangeStatus(\'' . $row['name'] . '\')" class="btn btn-primary btn-sm text-nowrap">Kích hoạt</button>';
                    }
                    return '<button wire:click="ChangeStatus(\'' . $row['name'] . '\')" class="btn btn-danger btn-sm text-nowrap">Chưa kích hoạt</button>';
                } else {
                    if (isset($row[$column['field']]) && $row[$column['field']] == 1) {
                        return 'Admin';
                    }
                    return 'User';
                }
            },
            'keyColumn' => 'row1_1'
        ],
        [
            'fieldType' => FieldBuilder::Dropdown,
            'funcData' => function () {
                return [
                    [
                        'id' => 0,
                        'text' => 'Chưa kích hoạt'
                    ],
                    [
                        'id' => 1,
                        'text' => 'Kích hoạt'
                    ]
                ];
            },
            'funcCell' => function ($row, $column) {
                if (\Gate::check('core.module.change-status')) {
                    if (isset($row[$column['field']]) && $row[$column['field']] == 1) {
                        return '<button wire:click="ChangeStatus(\'' . $row['name'] . '\')" class="btn btn-primary btn-sm text-nowrap">Kích hoạt</button>';
                    }
                    return '<button wire:click="ChangeStatus(\'' . $row['name'] . '\')" class="btn btn-danger btn-sm text-nowrap">Chưa kích hoạt</button>';
                } else {
                    if (isset($row[$column['field']]) && $row[$column['field']] == 1) {
                        return 'Kích hoạt';
                    }
                    return 'Chưa kích hoạt';
                }
            },
            'field' => 'status',

            'title' => '',
            'keyColumn' => 'row1_2',
        ]
    ]
];
