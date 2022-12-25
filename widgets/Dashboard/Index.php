<?php

namespace GateGem\Core\Widget\Dashboard;


class Index extends \GateGem\Core\Livewire\Widget
{
    public function render()
    {
        return $this->View('views.' . $this->widget_type);
    }
}
