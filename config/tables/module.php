<?php

use LaraPlatform\Core\Builder\Form\FieldSize;
use LaraPlatform\Core\Builder\Form\FieldType;

return [
    'DisableModule' => true,
    'title' => 'Quản lý Module',
    'emptyData' => 'Không có dữ liệu',
    'modalkey' => 'name',
    'excel' => [
        'template' => '',
        'import' => \DevHau\Modules\Excel\ExcelInport::class,
        'export' => \DevHau\Modules\Excel\ExcelExport::class,
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
        'append' => [
            [
                'title' => 'Tạo File',
                'permission' => 'admin.module.add-file',
                'icon' => '<i class="bi bi-magic"></i>',
                'type' => 'update',
                'class' => 'btn-primary',
                'action' => function ($id) {
                    return 'wire:openmodal="devhau-module::admin.module.create-file({\'module\':\'' . $id . '\'})"';
                }
            ], [
                'title' => 'Xóa module',
                'permission' => 'admin.module.remove',
                'icon' => '<i class="bi bi-eraser"></i>',
                'type' => 'update',
                'action' => function ($id) {
                    return 'data-confirm-message="bạn có muốn xóa không? Lưu ý: không thể lấy lại khi xóa đi." wire:confirm=\'RemoveRow("' .  $id . '")\'';
                }
            ],
            [
                'title' => 'Tạo mới module',
                'permission' => 'admin.module.add',
                'icon' => '<i class="bi bi-folder-plus"></i>',
                'class' => 'btn-primary',
                'type' => 'new',
                'action' => function () {
                    return 'wire:openmodal="devhau-module::admin.module.create()"';
                }
            ]
        ]
    ],
    'formEdit' => '',
    'formInclude' => '',
    'formClass' => 'p-1',
    'layoutForm' => [
        'common' => [
            [
                ['key' => 'row1_1', 'column' => FieldSize::Col6],
                ['key' => 'row1_2', 'column' => FieldSize::Col6],
            ],
            [
                ['key' => 'row2_1', 'column' => FieldSize::Col12],
            ]
        ]
    ],
    'fields' => [
        [
            'field' => 'name',
            'fieldType' => FieldType::Text,
            'title' => 'Module Name',
            'keyColumn' => 'row1_1'
        ],
        [
            'field' => 'email',
            'title' => 'Email',
            'view' => false,
            'keyColumn' => 'row1_2'
        ],
        [
            'field' => 'description',
            'title' => 'Thông tin',
            'keyColumn' => 'row1_1'
        ],
        [
            'fieldType' => FieldType::Dropdown,
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
                if (\Gate::check('admin.module.change-status')) {
                    if ($row[$column['field']] == 1) {
                        return '<button wire:click="ChangeStatus(\'' . $row['name'] . '\')" class="btn btn-primary btn-sm text-nowrap">Kích hoạt</button>';
                    }
                    return '<button wire:click="ChangeStatus(\'' . $row['name'] . '\')" class="btn btn-danger btn-sm text-nowrap">Chưa kích hoạt</button>';
                } else {
                    if ($row[$column['field']] == 1) {
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
