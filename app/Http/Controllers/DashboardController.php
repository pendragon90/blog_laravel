<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $posts = Post::all();
        $categories = Category::all();
        $tags = Tag::all();

        return inertia('Dashboard/Dashboard', [
            'totalPosts' => count($posts),
            'totalCategories' => count($categories),
            'totalTags' => count($tags),
        ]);
    }
}
