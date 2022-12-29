<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class UserSeeder extends Seeder
{

    protected $repository;

    protected $role_repository;

    public function __construct(UserRepositoryInterface $repository, RoleRepositoryInterface $role_repository)
    {
        $this->repository = $repository;
        $this->role_repository = $role_repository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = $this->repository->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret')
        ]);

        $roles = $this->role_repository->getRoles();

        // Админу добавляем все роли
        foreach ($roles as $role) {
            $this->repository->addRole($user->id, $role->id);
        }

        $user = $this->repository->create([
            'name' => 'Editor',
            'email' => 'editor@gmail.com',
            'password' => bcrypt('secret2')
        ]);

        $role = $this->role_repository->getRoleByName('editor');

        $this->repository->addRole($user->id, $role->id);
    }
}
