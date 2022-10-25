<?php

use LaraPlatform\Core\Builder\Form\FieldType;
use LaraPlatform\Core\Builder\Modal\ModalSize;

return [
    'model' => \DevHau\Modules\Models\Schedule::class,
    'poll' => '10s',
    'DisableModule' => true,
    'title' => 'Schedule',
    'emptyData' => 'Không có dữ liệu',
    'enableAction' => true,
    'formInclude' => 'devhau-module::admin.schedule.edit',
    'viewEdit' => 'devhau-module::admin.schedule.edit',
    'action' => [
        'title' => '#',
        'add' => true,
        'edit' => true,
        'delete' => true,
        'export' => true,
        'inport' => true,
        'append' => [
            [
                'title' => 'Run now',
                'icon' => '<i class="bi bi-magic"></i>',
                'permission' => 'admin.schedule.run-now',
                'type' => 'update',
                'action' => function ($id) {
                    return 'wire:click="RunNow(\'' . $id . '\')"';
                }
            ], [
                'title' => 'Lịch sử bot chạy',
                'permission' => 'admin.schedule.view-history',
                'icon' => '<i class="bi bi-magic"></i>',
                'type' => 'new',
                'action' => function () {
                    return 'wire:openmodal=\'devhau-module::admin.schedule.history()\'';
                }
            ]
        ]
    ],
    'formSize' => ModalSize::FullscreenMd,
    'fields' => [
        [
            'field' => 'command',
            'title' => 'Lệnh chạy'
        ],
        [
            'field' => 'command_custom',
            'title' => 'Lệnh mở rộng chạy'
        ],
        [
            'field' => 'expression',
            'title' => 'Chạy tiếp theo vào lúc',
            'funcCell' => function ($row, $column) {
                return CronNextRunDate($row['expression']);
            },
            'default' => '*/5 * * * *'
        ],
        [
            'field' => 'sendmail_success',
            'view' => false
        ],
        [
            'field' => 'run_in_background',
            'view' => false,
        ],
        [
            'field' => 'email_output',
            'view' => false
        ],
        [
            'field' => 'webhook_before',
            'view' => false
        ],
        [
            'field' => 'webhook_after',
            'view' => false
        ],
        [
            'field' => 'sendmail_error',
            'view' => false,
        ],
        [
            'field' => 'even_in_maintenance_mode',
            'view' => false,
        ],
        [
            'field' => 'without_overlapping',
            'view' => false,
        ],
        [
            'field' => 'on_one_server',
            'view' => false
        ],
        [
            'field' => 'log_success',
            'view' => false
        ],
        [
            'field' => 'groups',
            'view' => false
        ],
        [
            'fieldType' => FieldType::Dropdown,
            'default' => 1,
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
        ],
        [
            'field' => 'environments',
            'view' => false,
        ],
        [
            'field' => 'params',
            'view' => false,
            'default' => []
        ],
        [
            'field' => 'options',
            'view' => false,
            'default' => []
        ]
    ]
];
