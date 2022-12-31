<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Validation\ValidationException;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostController extends Controller
{

    protected $repository;

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $validated['user_id'] = $request->user()->id;

        $post = $this->repository->create($validated);

        return response()->json([
            'message' => 'Post is created',
            'id' => $post->id
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required_without:content|max:255',
            'content' => 'required_without:title'
        ]);

        $res = $this->repository->update($id, $validated);

        return response()->json([
            'message' => 'Post update',
            'res' => $res
        ]);
    }

    public function list()
    {
        $posts = $this->repository->getPosts();
        return response()->json($posts);
    }

    public function post($id)
    {
        $post = $this->repository->getById($id);
        return response()->json($post);
    }

    public function delete($id)
    {
        $res = $this->repository->delete($id);

        return response()->json([
            'message' => 'Post delete',
            'res' => $res
        ]);
    }
}
