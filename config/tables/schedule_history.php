<?php

use LaraIO\Core\Livewire\Modal;

return [
    'model' => \LaraIO\Core\Models\ScheduleHistory::class,
    'permission' => [
        'view' => ''
    ],
    'DisableModule' => true,
    'enableAction' => false,
    'action' => [
        'title' => '#',
        'add' => false,
        'edit' => false,
        'delete' => false,
        'export' => true,
        'inport' => true,
        'append' => [
            [
                'title' => 'Xóa hết lịch sử',
                'icon' => '<i class="bi bi-magic"></i>',
                'type' => 'new',
                'action' => function () {
                    return 'wire:click=\'clearData()\'';
                }
            ]
        ]
    ],
    'formSize' => Modal::ExtraLarge,
    'fields' => [
        [
            'field' => 'command',
            'title' => 'Lệnh chạy'
        ],
        [
            'field' => 'params',
            'title' => 'params'
        ],
        [
            'field' => 'options',
            'title' => 'options'
        ],
        [
            'field' => 'output',
            'title' => 'Kết quả'
        ],
        [
            'field' => 'created_at',
            'title' => 'Chạy lúc'
        ]
    ]
];
