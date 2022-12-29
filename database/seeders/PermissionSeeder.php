<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\PermissionRepositoryInterface;

class PermissionSeeder extends Seeder
{

    protected $repository;

    public function __construct(PermissionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->repository->create(['name' => 'edit_role']);
        $this->repository->create(['name' => 'edit_post']);
    }
}
