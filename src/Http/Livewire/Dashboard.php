<?php

namespace LaraPlatform\Core\Http\Livewire;

use LaraPlatform\Core\Livewire\Component;

class Dashboard extends Component
{
    public $testdata = "";
    public function mount($testdata="")
    {
        $this->testdata = $testdata;
    }
    public $i = 0;
    public function clickDemo()
    {
        $this->i++;
    }
    public function render()
    {
        return view("core::demo");
    }
}
