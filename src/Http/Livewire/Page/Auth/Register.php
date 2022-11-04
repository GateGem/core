<?php

namespace LaraPlatform\Core\Http\Livewire\Page\Auth;

use LaraPlatform\Core\Facades\Theme;
use LaraPlatform\Core\Livewire\Modal;

class Register extends Modal
{
    public function boot()
    {
        parent::boot();
        Theme::setLayoutNone();
    }
    public function mount()
    {
        $this->setTitle('Register to system');
    }
    public function render()
    {
        return $this->viewModal('core::page.auth.register');
    }
}
