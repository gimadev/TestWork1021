<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Exception;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleController extends Controller
{

    protected $repository;

    public function __construct(RoleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create()
    {
        try {
            $name = request('name');

            if (empty($name)) {
                throw new Exception('Role name is empty');
            }

            $this->repository->save($name);

            return response()->json(['message' => 'Role is created']);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function addPermission()
    {
        try {
            $role_id = request('id');
            $permission = request('permission');

            if (empty($role_id) || empty($permission)) {
                throw new Exception('Input data is incorrect');
            }

            $this->repository->addPermission($role_id, $permission);

            return response()->json(['message' => 'Permission added']);

        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }
}
