<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\Permission;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Exception;

class RoleRepository implements RoleRepositoryInterface
{

    public function save($name)
    {
        $role = new Role();
        $role->name = $name;
        $role->save();
    }

    public function addPermission($role_id, $permission)
    {
        $role = Role::find($role_id);
        $permission = Permission::where('name', $permission)->first();

        if (empty($role) || empty($permission)) {
            throw new Exception('Input data is incorrect');
        }

        $filtered = $role->permissions->filter(function ($value, $key) use($permission) {
            return $value->id == $permission->id;
        });

        // Проверка существования разрешения для роли, добавляем только если отсутствует
        if($filtered->count() == 0) {
            $role->permissions()->attach($permission->id);
        }

    }
}
