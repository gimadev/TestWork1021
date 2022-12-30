<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\Permission;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Exception;

class RoleRepositoryDb implements RoleRepositoryInterface
{

    public function create($data)
    {
        return Role::create($data);
    }

    public function addPermission($role_id, $permission)
    {
        $role = Role::find($role_id);
        $permission = Permission::where('name', $permission)->first();

        $role_permission = $role->permissions->first(function ($value, $key) use($permission) {
            return $value->id == $permission->id;
        });

        // Проверка существования разрешения для роли, добавляем только если отсутствует
        if(empty($role_permission)) {
            $role->permissions()->attach($permission->id);
        }

    }

    public function getRoles()
    {
        return Role::all();
    }

    public function getRoleByName($name)
    {
        return Role::where('name', $name)->first();
    }

    public function delete($name)
    {
        $role = $this->getRoleByName($name);

        if($role) {
            return $role->delete();
        }

    }

}
