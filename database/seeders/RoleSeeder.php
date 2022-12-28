<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = "admin";
        $role->save();

        $permissions = Permission::all();

        foreach($permissions as $permission) {
            $role->permissions()->attach($permission->id);
        }

        $role = new Role();
        $role->name = "editor";
        $role->save();

        $permission = Permission::where('name','edit_post')->first();
        $role->permissions()->attach($permission->id);
    }
}
