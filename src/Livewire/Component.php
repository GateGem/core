<?php

namespace GateGem\Core\Livewire;

use GateGem\Core\Facades\Core;
use GateGem\Core\Facades\Theme;
use GateGem\Core\Traits\WithDoAction;
use Illuminate\Support\Facades\File;
use Livewire\Component as ComponentBase;

class Component extends ComponentBase
{
    public $childSlot;
    use WithDoAction;
    public $_code_permission = "";
    public function checkPermissionView()
    {
        return !$this->_code_permission || ($this->_code_permission && Core::checkPermission($this->_code_permission));
    }
    public $_dataTemps = [];
    protected function getListeners()
    {
        return ['refreshData' . $this->id => '__loadData'];
    }

    public function __loadData()
    {
    }

    public function refreshData($option = [])
    {
        if (!isset($option['id'])) $option['id'] = $this->id;
        $this->dispatchBrowserEvent('reload_component', $option);
    }

    public function redirectCurrent()
    {
        return redirect(request()->header('Referer'));;
    }
    public function showMessage($option)
    {
        $this->dispatchBrowserEvent('swal-message', $option);
    }

    public function __construct($id = null)
    {
        parent::__construct($id);
    }
    public function View($view)
    {
        return File::get(Core::getPathDirFromClass($this) . '/' . str_replace('.', '/', $view) . '.blade.php');
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
