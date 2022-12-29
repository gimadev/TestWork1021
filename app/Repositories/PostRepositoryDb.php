<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepositoryDb implements PostRepositoryInterface
{

    public function create($data)
    {
        return Post::create($data);
    }

    public function update($id, $data)
    {
        $post = $this->getById($id);

        if ($post) {
            return $post->update($data);
        }
    }

    public function getById($id)
    {
        return Post::find($id);
    }

    public function getPosts()
    {
        return Post::all();
    }

    public function delete($id)
    {
        $post = $this->getById($id);

        if ($post) {
            return $post->delete();
        }
    }
}
