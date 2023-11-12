<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // User $user, Post $post
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        Comment::create([
            'user_id' => $user = Auth::user()->id,
            'slug' => Str::slug($user . '-' . 'comment' . uniqid()),
            'post_id' => $post->id,
            'content_comment' => $request->content_comment
        ]);

        return back();
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
    public function edit(Post $post, Comment $comment)
    {
        return inertia('EditComment', [
            'post' => new PostResource($post),
            'comment' => new CommentResource($comment)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post, Comment $comment)
    {
        $comment->update([
            'content_comment' => $request->content_comment
        ]);

        return redirect()->route('home.post.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();
    }
}
