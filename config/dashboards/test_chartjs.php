<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Models\Permission;

return GateConfig::Widget('Biểu đồ tài chính hàng ngày trong tháng')
    ->setPoll('.5s')
    ->setColumn(FieldBuilder::Col6)
    ->setFuncData(function () {
        return [
            'type' => 'bar',
            'responsive' => true,
            'options' => [
                'scales' => [
                    'y' => [
                        'beginAtZero' => true
                    ]
                ]
            ],
            'data' => [
                'labels' => ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                'datasets' => [
                    [
                        'label' => 'Biến thể A',
                        'data' => [rand(0, 30), rand(0, 30), rand(0, 30), rand(0, 30), rand(0, 30), rand(0, 30)],
                        'borderWidth' => 1
                    ],
                    [
                        'label' => 'Biến thể B',
                        'data' => [rand(0, 30), rand(0, 30), rand(0, 30), rand(0, 30), rand(0, 30), rand(0, 30)],
                        'borderWidth' => 1
                    ],
                    [
                        'label' => 'Biến thể C',
                        'data' => [rand(0, 30), rand(0, 30), rand(0, 30), rand(0, 30), rand(0, 30), rand(0, 30)],
                        'borderWidth' => 1
                    ]
                ]
            ]
        ];
    })
    ->setPosition('body')
    ->setType('chartjs')
    ->Disable()
    //->setIcon('bi bi-shield-fill-check')
;
