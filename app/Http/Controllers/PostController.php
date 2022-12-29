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
        try {

            $validated = $request->validate([
                'title' => 'required|unique:posts|max:255',
                'content' => 'required'
            ]);

            $validated['user_id'] = $request->user()->id;

            $post = $this->repository->create($validated);

            return response()->json([
                'message' => 'Post is created',
                'id' => $post->id
            ]);
        } catch (ValidationException $e) {

            return response()->json(['error' => $e->getMessage()]);
        } catch (Exception $e) {

            logger()->error($e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'title' => 'required_without:content|unique:posts|max:255',
                'content' => 'required_without:title'
            ]);

            $res = $this->repository->update($id, $validated);

            return response()->json([
                'message' => 'Post update',
                'res' => $res
            ]);
        } catch (ValidationException $e) {

            return response()->json(['error' => $e->getMessage()]);
        } catch (Exception $e) {

            logger()->error($e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function list()
    {
        try {

            $posts = $this->repository->getPosts();
            return response()->json($posts);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function post($id)
    {
        try {

            $post = $this->repository->getById($id);
            return response()->json($post);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function delete($id)
    {
        try {

            $res = $this->repository->delete($id);

            return response()->json([
                'message' => 'Post delete',
                'res' => $res
            ]);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }
}
