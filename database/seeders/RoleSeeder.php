<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface;

class RoleSeeder extends Seeder
{

    protected $role_repository;

    protected $permission_repository;

    public function __construct(RoleRepositoryInterface $role_repository, PermissionRepositoryInterface $permission_repository)
    {
        $this->role_repository = $role_repository;
        $this->permission_repository = $permission_repository;
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = $this->role_repository->create([
            'name' => 'admin'
        ]);

        $permissions = $this->permission_repository->getPermissions();

        foreach($permissions as $permission) {
            $this->role_repository->addPermission($role->id, $permission->name);
        }

    }
}
