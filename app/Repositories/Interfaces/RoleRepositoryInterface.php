<?php

namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface
{
    public function create($data);

    public function addPermission($role_id, $permission);

    public function getRoles();

    public function getRoleByName($name);

}
