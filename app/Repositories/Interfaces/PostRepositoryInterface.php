<?php

namespace App\Repositories\Interfaces;

interface PostRepositoryInterface
{
    public function create($data);

    public function update($id, $data);

    public function getById($id);

    public function getPosts();

    public function delete($id);
}
