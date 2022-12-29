<?php

namespace App\Repositories\Interfaces;

interface PermissionRepositoryInterface
{
    public function create($data);

    public function getPermissions();
}
