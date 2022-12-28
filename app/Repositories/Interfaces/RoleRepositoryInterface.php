<?php

namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface
{
    public function save($name);

    public function addPermission($role_id, $permission);
}
