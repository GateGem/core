<?php

namespace GateGem\Core\Widget\Demo;


class Index extends \GateGem\Core\Livewire\Widget
{
    public function render()
    {
        return $this->View('views.index');
    }
}
