<?php

namespace GateGem\Core\Http\Livewire\Page\Dashboard;

use GateGem\Core\Facades\Core;
use GateGem\Core\Livewire\Component;

class Index extends Component
{
    public $page_title;

    public $option = [
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
                    'label' => '5 of Votes',
                    'data' => [9, 10, 3, 5, 2, 3],
                    'borderWidth' => 1
                ],
                [
                    'label' => 'Nội dung biến thể abc',
                    'data' => [4, 27, 10, 0, 9, 8],
                    'borderWidth' => 1
                ],
                [
                    'label' => 'Nội dung biến thể ef',
                    'data' => [10, 0, 19, 8, 2, 10],
                    'borderWidth' => 1
                ]
            ]
        ]
    ];
    public function mount()
    {
        $this->page_title = 'Dashboard';
    }
    public function render()
    {
        return view('core::page.dashboard.index', [
            'data1' => Core::getWidgets()
        ]);
    }
}
