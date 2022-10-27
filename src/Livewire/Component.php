<?php

namespace LaraPlatform\Core\Livewire;

use LaraPlatform\Core\Facades\Theme;
use LaraPlatform\Core\Traits\WithDoAction;
use Livewire\Component as ComponentBase;

class Component extends ComponentBase
{
    use WithDoAction;
    protected function getListeners()
    {
        return ['refreshData' . $this->id => 'loadData'];
    }

    public function loadData()
    {
    }

    public function refreshData($option = [])
    {
        $this->dispatchBrowserEvent('reload_component', $option);
    }

    public function showMessage($option)
    {
        $this->dispatchBrowserEvent('swal-message', $option);
    }

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function ensureViewHasValidLivewireLayout($view)
    {
        if ($view == null) {
            return;
        }
        parent::ensureViewHasValidLivewireLayout($view);
        $view->extends(Theme::Layout())->section('content');
    }
}
