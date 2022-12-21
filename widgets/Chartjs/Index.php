<?php

namespace GateGem\Core\Widget\Chartjs;

use Illuminate\Support\Facades\Log;

class Index extends \GateGem\Core\Livewire\Widget
{
    public $option = [];
    public function mount($option = [], $poll = '')
    {
        $this->option = $option;
        $this->poll = $poll;
    }
    public function render()
    {
        $this->option['data']['datasets'][0]['label'] = time() . ' of Votes';
        $this->option['data']['datasets'][0]['data'][0]=rand(0,20);
        $this->option['data']['datasets'][rand(0,2)]['data'][rand(0,2)]=rand(0,20);
        return $this->View('views.index');
    }
}
