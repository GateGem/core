<?php

namespace LaraPlatform\Core\Livewire;

use LaraPlatform\Core\Facades\Theme;
use Livewire\Component as ComponentBase;

class Component extends ComponentBase
{
    protected function getListeners()
    {
        return ['refreshData' => 'loadData'];
    }
    public function loadData()
    {
    }
    public function refreshData($option = [])
    {
        $this->dispatchBrowserEvent('refreshData', $option);
    }
    public function ShowMessage($option)
    {
        $this->dispatchBrowserEvent('swal-message', $option);
    }
    public function __construct($id = null)
    {
        parent::__construct($id);
    }
    protected function ensureViewHasValidLivewireLayout($view)
    {
        if ($view == null) return;
        parent::ensureViewHasValidLivewireLayout($view);
        $view->extends(Theme::Layout());
    }
}