<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Admin";
        $user->email = "admin@gmail.com";
        $user->password = bcrypt("secret");
        $user->save();

        $roles = Role::all();

        foreach($roles as $role) {
            $user->roles()->attach($role->id);
        }

        $user = new User();
        $user->name = "Editor";
        $user->email = "editor@gmail.com";
        $user->password = bcrypt("secret2");
        $user->save();

        $role = Role::where('name','editor')->first();
        $user->roles()->attach($role->id);
    }
}
