<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Like;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ShowPostResource;
use App\Http\Resources\CategoryTagResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $totalPosts = Post::all();
        $search = $request->input('search');
        $category = $request->input('category');
        $tag = $request->input('tag');

        $query = Post::query();

        if ($search) {
            $query->where('title', 'LIKE', '%' . $search . '%');
        } else if ($category && $category !== 'All') {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('title', $category);
            });
        } else if ($tag && $tag !== 'All') {
            $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('title', $tag);
            });
        }

        $posts = $query->latest()->paginate($request->perpage ?? 10)->withQueryString();

        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();

        // return response()->json(PostResource::collection($posts));

        return inertia('Dashboard/Posts/DashboardPosts', [
            'totalPosts' => $totalPosts->count(),
            'posts' => PostResource::collection($posts),
            'categories' => CategoryTagResource::collection($categories),
            'tags' => CategoryTagResource::collection($tags),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();

        return inertia('Dashboard/Posts/DashboardCreatePost', [
            'categories' => CategoryTagResource::collection($categories),
            'tags' => CategoryTagResource::collection($tags),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $img = '';
        $slug =  Str::slug($request->title . '-' . uniqid());

        if ($request->file('img')) {
            $imgName = $slug . '.' . $request->file('img')->getClientOriginalExtension();
            $img = $request->file('img')->storeAs('img/posts', $imgName);
        }

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'slug' => $slug,
            'img' =>  $img,
            'category_id' => $request->category_id,
            'content' => $request->content
        ]);

        $post->tags()->sync($request->tags);

        Session::flash('success', 'Post was Created!');

        return to_route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();

        // return response()->json($postSingle);
        return inertia('Dashboard/Posts/DashboardEditPost', [
            'postSingle' => new ShowPostResource($post),
            'categories' => CategoryTagResource::collection($categories),
            'tags' => CategoryTagResource::collection($tags),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $img = '';
        $slug =  Str::slug($request->title . '-' . uniqid());

        if ($request->hasFile('img')) {
            Storage::disk('public')->delete($post->img);
            $imgName = $slug . '.' . $request->file('img')->getClientOriginalExtension();
            $img = $request->file('img')->storeAs('img/posts', $imgName);
        }

        $post->update([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'slug' => $slug,
            'img' => $img,
            'category_id' => $request->category_id,
            'content' => $request->content
        ]);

        $post->tags()->sync($request->tags);

        Session::flash('updated', 'Post was Updated!');

        return to_route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->img) {
            Storage::disk('public')->delete($post->img);
        }

        $post->delete();

        return back();
    }
}
