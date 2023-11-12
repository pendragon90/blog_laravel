<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryTagResource;
use App\Http\Resources\PostResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagPageController extends Controller
{
    public function index()
    {
        $tags = Tag::latest()->get();
        return inertia('Tags', [
            'tagsPage' => CategoryTagResource::collection($tags)
        ]);
    }

    public function show(Tag $tag)
    {
        return inertia('ShowTag', [
            'tagPage' => new CategoryTagResource($tag)
        ]);
    }
}
