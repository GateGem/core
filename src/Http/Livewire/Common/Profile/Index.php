<?php

namespace GateGem\Core\Http\Livewire\Common\Profile;

use Illuminate\Support\Facades\Auth;
use GateGem\Core\Facades\Core;
use GateGem\Core\Livewire\Modal;

class Index extends Modal
{
    public $fullname;
    public function mount()
    {
        $this->fullname = auth()->user()->name;
    }
    public function DoLogout(){
        Auth::logout();
        return $this->redirectCurrent();
    }
    public function render()
    {
        return $this->viewModal('core::common.profile.index');
    }
}
