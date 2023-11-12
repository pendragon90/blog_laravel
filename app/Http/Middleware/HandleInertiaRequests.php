<?php

namespace App\Http\Middleware;

use App\Http\Resources\PostResource;
use App\Models\Tag;
use App\Models\Post;
use Inertia\Middleware;
use App\Models\Category;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Http\Request;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $search = $request->input('search');

        $posts = $search
            ? Post::query()->where('title', 'LIKE', '%' . $search . '%')->take(10)->get()
            : Post::latest()->take(10)->get();

        $postResources = PostResource::collection($posts);

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'postsNavbar' => $postResources,
            'latestPosts' => Post::latest()->take(10)->get(),
            'tagsNavbar' => Tag::latest()->get(),
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'updated' => fn () => $request->session()->get('updated'),
            ],
        ];
    }
}
