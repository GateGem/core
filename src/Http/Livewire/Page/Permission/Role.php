<?php

namespace LaraPlatform\Core\Http\Livewire\Page\Permission;

use LaraPlatform\Core\Livewire\Modal;
use LaraPlatform\Core\Models\Permission;
use LaraPlatform\Core\Models\Role as ModelsRole;

class Role extends Modal
{
    public $roleId;
    public $role_name;
    public $permission;
    public ModelsRole $role;
    public function mount($roleId)
    {
        $this->roleId = $roleId;
        $this->role = ModelsRole::with('permissions')->find($this->roleId);
        $this->role_name =  $this->role->name;
        $this->permission =  $this->role->permissions->pluck('id', 'id');
        $this->setTitle('Phân quyền cho:' .  $this->role_name);
    }
    public function doSave()
    {
        $role = ModelsRole::find($this->roleId);
        $role->permissions()->sync(collect($this->permission)->filter(function ($item) {
            return $item > 0;
        })->toArray());
        $this->hideModal();
        $this->ShowMessage("Update successfull!");
    }
    public function render()
    {
        return $this->viewModal('core::page.permission.role', [
            'permissionAll' => Permission::all()
        ]);
    }
}
