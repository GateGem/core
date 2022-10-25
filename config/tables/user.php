<?php

use LaraPlatform\Core\Builder\Form\FieldSize;
use LaraPlatform\Core\Builder\Form\FieldType;

return [
    'model' => \DevHau\Modules\Models\User::class,
    'modelkey' => 'id',
    'DisableModule' => true,
    'title' => 'Tài khoản',
    'emptyData' => 'Không có dữ liệu',
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
        'add' => true,
        'edit' => true,
        'delete' => true,
        'export' => true,
        'inport' => true,
        'append' => [
            [
                'title' => 'Phân quyền',
                'icon' => '<i class="bi bi-magic"></i>',
                'permission' => 'admin.user.permission',
                'class' => 'btn-primary',
                'type' => 'update',
                'action' => function ($id) {
                    return 'wire:openmodal="devhau-module::admin.user.permission({\'userId\':\'' . $id . '\'})"';
                }
            ], [
                'title' => 'Quản lý quyền',
                'icon' => '<i class="bi bi-magic"></i>',
                'permission' => 'admin.permission',
                'type' => 'new',
                'action' => function () {
                    return 'wire:openmodal="devhau-module::admin.permission.index()"';
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
            'fieldType' => FieldType::Password,
            'view' => false,
            'edit' => false,
            'keyColumn' => 'row1_1'
        ],
        [
            'fieldType' => FieldType::Dropdown,
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
