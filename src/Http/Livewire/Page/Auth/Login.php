<?php

namespace LaraPlatform\Core\Http\Livewire\Page\Auth;

use Illuminate\Support\Facades\Auth;
use LaraPlatform\Core\Facades\Theme;
use LaraPlatform\Core\Livewire\Modal;

class Login extends Modal
{
    public function boot()
    {
        parent::boot();
        Theme::setLayoutNone();
    }
    public $username;
    public $password;
    public $isRememberMe;

    protected $rules = [
        'password' => 'required|min:6',
        'email' => 'required|email',
    ];
    public function DoLogin()
    {
        $this->validate();
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->isRememberMe)) {
            return redirect('/');
        } else {
            $this->showMessage("Login Fail");
        }
    }
    public function mount()
    {
        $this->setTitle('Login to system');
    }
    public function render()
    {
        return $this->viewModal('core::page.auth.login');
    }
}
