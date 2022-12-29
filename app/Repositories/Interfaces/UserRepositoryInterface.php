<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function create($data);

    public function addRole($user_id, $role_id);

    public function getUserById($id);
}
