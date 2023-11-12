<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryTagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'posts' => $this->posts->map(function ($post) {
                return [
                    'id' => $post->id,
                    'user' => $post->user->name,
                    'slug' => $post->slug,
                    'title' => $post->title,
                    'img' => $post->img ? asset("/storage/{$post->img}") : null,
                    'date' => date_format($post->created_at, 'd M, Y'),
                    'category' => [
                        'id' => $post->category->id,
                        'slug' => $post->category->slug,
                        'title' => $post->category->title,
                    ],
                    'tags' => $post->tags->map(function ($tag) {
                        return [
                            'id' => $tag->id,
                            'title' => $tag->title,
                            'slug' => $tag->slug,
                        ];
                    }),
                ];
            })
        ];
    }
}
