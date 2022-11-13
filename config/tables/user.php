<?php

use LaraIO\Core\Builder\Form\FieldBuilder;

return [
    'model' => LaraIO\Core\Models\User::class,
    'modelkey' => 'id',
    //'DisableModule' => true,
    'title' => 'Tài khoản',
    'emptyData' => 'Không có dữ liệu',
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
                'class' => 'btn-primary',
                'type' => 'update',
                'action' => function ($id) {
                    return 'wire:component="core::page.permission.user({\'userId\':\'' . $id . '\'})"';
                }
            ], [
                'title' => 'Quản lý quyền',
                'icon' => '<i class="bi bi-magic"></i>',
                'permission' => 'core.permission',
                'type' => 'new',
                'action' => function () {
                    return 'wire:component="core::table.index({\'module\':\'permission\'})"';
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
            'title' => 'Họ tên',
            'keyColumn' => 'row1_1'
        ],
        [
            'field' => 'email',
            'title' => 'Email',
            'view' => false,
            'keyColumn' => 'row1_2'
        ],
        [
            'field' => 'info',
            'title' => 'Thông tin',
            'keyColumn' => 'row1_1'
        ],
        [
            'field' => 'password',
            'title' => 'Mật khẩu',
            'fieldType' => FieldBuilder::Password,
            'view' => false,
            'edit' => false,
            'keyColumn' => 'row1_1'
        ],
        [
            'fieldType' => FieldBuilder::Dropdown,
            'default' => 0,
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
            'field' => 'status',
            'title' => 'Trạng thái',
            'keyColumn' => 'row1_2',
        ]
    ]
];
