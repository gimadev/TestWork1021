<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Exception;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    protected $repository;

    public function __construct(RoleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(Request $request)
    {
        try {

            $validated = $request->validate([
                'name' => 'required|unique:roles|max:255'
            ]);

            $this->repository->create($validated);

            return response()->json(['message' => 'Role is created']);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function update(Request $request)
    {
        try {

            $validated = $request->validate([
                'id' => 'required|integer|exists:roles',
                'permission' => 'required|max:255|exists:permissions,name'
            ]);

            $this->repository->addPermission($validated['id'], $validated['permission']);

            return response()->json(['message' => 'Permission added']);
            
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }
}
