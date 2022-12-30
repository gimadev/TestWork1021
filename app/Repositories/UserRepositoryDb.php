<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepositoryDb implements UserRepositoryInterface
{

    public function create($data)
    {
        return User::create($data);
    }

    public function addRole($email, $role_id)
    {
        $user = $this->getUserByEmail($email);

        if($user) {

            $role = $user->roles->firstWhere('id', $role_id);

            // Проверка существования роли у пользователя, добавляем только если отсутствует
            if(empty($role)) {
                $user->roles()->attach($role_id);
                return true;
            }
        }
    }

    public function getUserById($id)
    {
        return User::find($id);
    }

    public function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

}
