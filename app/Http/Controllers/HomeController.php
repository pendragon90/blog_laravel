<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryTagResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\ShowPostResource;
use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(7);
        $categories = Category::latest()->paginate();

        return inertia('Home', [
            'posts' => PostResource::collection($posts),
            'categories' => CategoryTagResource::collection($categories)
        ]);
    }

    public function show(Post $post)
    {
        $relatedPosts = Post::whereNot('id', $post->id)
            ->whereBelongsTo($post->category)
            ->take(10)->get();

        return inertia('ShowPost', [
            'post' => new ShowPostResource($post),
            'relatedPosts' => PostResource::collection($relatedPosts)
        ]);
    }
}
