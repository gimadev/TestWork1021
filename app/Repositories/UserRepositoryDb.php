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

    public function addRole($user_id, $role_id)
    {
        $user = $this->getUserById($user_id);

        if($user) {

            $role = $user->roles->first(function ($role, $key) use($role_id) {
                return $role->id == $role_id;
            });

            // Проверка существования роли у пользователя, добавляем только если отсутствует
            if(empty($role)) {
                $user->roles()->attach($role_id);
            }
        }
    }

    public function getUserById($id)
    {
        return User::find($id);
    }

}
