<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Validation\ValidationException;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{

    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    // метод для обновления данных пользователя, в том числе добавления ролей пользователю
    public function update(Request $request)
    {
        if ($request->has('role_id')) {

            $validated = $request->validate([
                'role_id' => 'integer|exists:roles,id',
                'email' => 'required|email|exists:users'
            ]);

            $res = $this->repository->addRole($validated['email'], $validated['role_id']);

            return response()->json([
                'message' => 'Add role for user',
                'res' => $res
            ]);
        }

        return response()->json(['error' => 'Not found'], 404);
    }
}
