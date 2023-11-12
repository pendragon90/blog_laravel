<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reply;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentResource;
use App\Http\Resources\ReplyResource;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Post $post, Comment $comment)
    {
        Reply::create([
            'user_id' => $user = Auth::user()->id,
            'slug' => Str::slug($user . '-' . 'reply' . uniqid()),
            'comment_id' => $comment->id,
            'content_reply' => $request->content_reply
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
    public function edit(Post $post, Comment $comment, Reply $reply)
    {
        return inertia('EditReply', [
            'post' => new PostResource($post),
            'comment' => new CommentResource($comment),
            'reply' => new ReplyResource($reply),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post, Comment $comment, Reply $reply)
    {
        $reply->update([
            'content_reply' => $request->content_reply
        ]);

        return redirect()->route('home.post.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, Comment $comment, Reply $reply)
    {
        $reply->delete();
    }
}
