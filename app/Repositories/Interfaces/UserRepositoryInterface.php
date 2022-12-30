<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function create($data);

    public function addRole($email, $role_id);

    public function getUserById($id);

    public function getUserByEmail($email);
}
