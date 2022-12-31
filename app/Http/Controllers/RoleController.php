<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Validation\ValidationException;
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
        $validated = $request->validate([
            'name' => 'required|unique:roles|max:255'
        ]);

        $role = $this->repository->create($validated);

        return response()->json([
            'message' => 'Role is created',
            'id' => $role->id
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:roles',
            'permission' => 'required|max:255|exists:permissions,name'
        ]);

        $this->repository->addPermission($validated['id'], $validated['permission']);

        return response()->json(['message' => 'Permission added']);
    }

    public function delete(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|exists:roles'
        ]);

        $res = $this->repository->delete($validated['name']);

        return response()->json([
            'message' => 'Role delete',
            'res' => $res
        ]);
    }
}
