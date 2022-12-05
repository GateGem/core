<?php

namespace GateGem\Core\Http\Livewire\Page\Permission;

use GateGem\Core\Livewire\Modal;
use GateGem\Core\Models\Permission;
use GateGem\Core\Models\Role as ModelsRole;

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
    public function getOptionTree()
    {
        return [
            'field'=>'permission',
            'funcData' => function () {
                return Permission::all()->map(function ($item) {
                    return [
                        'key' => $item->slug,
                        'text'=>$item->name,
                        'value'=>$item->id
                    ];
                })->toArray();
            }
        ];
    }
    public function render()
    {
        return $this->viewModal('core::page.permission.role', [
            'optionTree' => $this->getOptionTree()
        ]);
    }
}
