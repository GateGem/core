<?php

namespace LaraIO\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use LaraIO\Core\Facades\Core;
use LaraIO\Core\Http\Action\LoadPermission;
use LaraIO\Core\Models\Role;
use LaraIO\Core\Models\User;

class InitLaraIOSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Load All Perrmission
        LoadPermission::UpdatePermission();
        //
        $roleAdmin = new Role();
        $roleAdmin->name = Core::RoleAdmin();
        $roleAdmin->slug = Core::RoleAdmin();
        $roleAdmin->save();
        $userAdmin = new User();
        $userAdmin->name = "nguyen van hau";
        $userAdmin->email = "admin@lara.asia";
        $userAdmin->password = "AdMin@123";
        $userAdmin->status = 1;
        $userAdmin->save();
        $userAdmin->roles()->sync([$roleAdmin->id]);
    }
}
