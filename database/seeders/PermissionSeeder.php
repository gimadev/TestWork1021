<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = new Permission();
        $permission->name = "edit_role";
        $permission->save();

        $permission2 = new Permission();
        $permission2->name = "edit_post";
        $permission2->save();
    }
}
