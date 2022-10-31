<?php

namespace LaraPlatform\Core\Http\Livewire\Page\Permission;

use LaraPlatform\Core\Models\User as ModelsUser;
use LaraPlatform\Core\Livewire\Modal;
use LaraPlatform\Core\Models\Permission;
use LaraPlatform\Core\Models\Role;

class User extends Modal
{
    public $userId;
    public $user_name;
    public $role;
    public $permission;
    public function mount($userId)
    {
        $this->userId = $userId;
        $user = ModelsUser::with('roles', 'permissions')->find($this->userId);
        $this->user_name = $user->email;
        $this->role = $user->roles->pluck('id', 'id');
        $this->permission = $user->permissions->pluck('id', 'id');
        $this->setTitle('Phân quyền cho:' . $this->user_name);
    }
    public function doSave()
    {
        $user = ModelsUser::find($this->userId);
        $user->permissions()->sync(collect($this->permission)->filter(function ($item) {
            return $item > 0;
        })->toArray());
        $user->roles()->sync(collect($this->role)->filter(function ($item) {
            return $item > 0;
        })->toArray());
        $this->hideModal();
        $this->ShowMessage("Update successfull!");
    }
    public function render()
    {
        return $this->viewModal('core::page.permission.user',[
            'roleAll' => Role::orderby('name')->get(),
            'permissionAll' => Permission::orderby('name')->get(),
        ]);
    }
}
