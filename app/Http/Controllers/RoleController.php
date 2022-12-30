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
        try {

            $validated = $request->validate([
                'name' => 'required|unique:roles|max:255'
            ]);

            $role = $this->repository->create($validated);

            return response()->json([
                'message' => 'Role is created',
                'id' => $role->id
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()]);
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
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()]);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function delete(Request $request)
    {
        try {

            $validated = $request->validate([
                'name' => 'required|exists:roles'
            ]);

            $res = $this->repository->delete($validated['name']);

            return response()->json([
                'message' => 'Role delete',
                'res' => $res
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()]);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }
}
