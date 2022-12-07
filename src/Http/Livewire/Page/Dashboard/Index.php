<?php

namespace GateGem\Core\Http\Livewire\Page\Dashboard;

use GateGem\Core\Livewire\Component;

class Index extends Component
{
    public $page_title;
    public function mount()
    {
        $this->page_title = 'Dashboard';
    }
    public function render()
    {
        return view('core::page.dashboard.index');
    }
}
