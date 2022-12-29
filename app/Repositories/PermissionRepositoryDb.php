<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\Interfaces\PermissionRepositoryInterface;

class PermissionRepositoryDb implements PermissionRepositoryInterface
{

    public function create($data)
    {
        return Permission::create($data);
    }

    public function getPermissions()
    {
        return Permission::all();
    }

}
