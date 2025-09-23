<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $postsQuery = Post::with('category')
            ->where('is_active' , true)
            ->latest();

        if ($request->has('categoryId')) {
            $postsQuery->where('category_id' , $request->input('categoryId'));
        }

        return PostResource::collection($postsQuery->get());
    }

    public function store(PostRequest $request)
    {
        $data = array_merge($request->validated(), ['views' => 0]);
        $post = Post::create($data);
        return PostResource::make($post->load('category'));
    }

    public function show(Post $post)
    {
        $post->increment('views');

        return new PostResource($post->load('category'));
    }
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->validated());

        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->noContent();
    }
}
