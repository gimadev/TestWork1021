<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group([

    'middleware' => 'api'

], function ($router) {

    Route::post('roles', [RoleController::class, 'create'])->middleware('permission:edit_role');
    Route::put('roles', [RoleController::class, 'update'])->middleware('permission:edit_role');

    Route::get('posts', [PostController::class, 'list']);
    Route::get('posts/{id}', [PostController::class, 'post']);
    Route::post('posts', [PostController::class, 'create'])->middleware('permission:edit_post');
    Route::put('posts/{id}', [PostController::class, 'update'])->middleware('permission:edit_post');
    Route::delete('posts/{id}', [PostController::class, 'delete'])->middleware('permission:edit_post');
});
