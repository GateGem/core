<?php

namespace GateGem\Core\Http\Livewire\Page\Permission;

use GateGem\Core\Models\User as ModelsUser;
use GateGem\Core\Livewire\Modal;
use GateGem\Core\Models\Permission;
use GateGem\Core\Models\Role;

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
        $this->setTitle('Setup:' . $this->user_name);
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
        return $this->viewModal('core::page.permission.user',[
            'roleAll' => Role::orderby('name')->get(),
            'optionTree' => $this->getOptionTree()
        ]);
    }
}
