<?php

namespace LaraPlatform\Core\Http\Livewire\Common\Profile;

use Illuminate\Support\Facades\Auth;
use LaraPlatform\Core\Facades\Core;
use LaraPlatform\Core\Livewire\Modal;

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
