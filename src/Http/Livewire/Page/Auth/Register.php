<?php

namespace LaraPlatform\Core\Http\Livewire\Page\Auth;

use LaraPlatform\Core\Facades\Theme;
use LaraPlatform\Core\Livewire\Modal;
use LaraPlatform\Core\Models\User;

class Register extends Modal
{
    public function boot()
    {
        parent::boot();
        Theme::setLayoutNone();
    }
    public $email;
    public $name;
    public $password;
    protected $rules = [
        'password' => 'required|min:6',
        'name' => 'required|min:6',
        'email' => 'required|min:6',
    ];
    public function DoWork()
    {
        $this->validate();
        $user = new User();
        $user->email = $this->email;
        $user->name = $this->name;
        $user->password = $this->password;
        $user->save();
        return redirect(route('core.login'));
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
