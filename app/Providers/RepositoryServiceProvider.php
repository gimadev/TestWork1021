<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\RoleRepositoryDb;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\PermissionRepositoryDb;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepositoryDb;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            RoleRepositoryInterface::class,
            RoleRepositoryDb::class
        );

        $this->app->bind(
            PermissionRepositoryInterface::class,
            PermissionRepositoryDb::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepositoryDb::class
        );
    }
}
