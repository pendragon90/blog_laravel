<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PostResource extends JsonResource
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
            'user' => $this->user->name,
            'slug' => $this->slug,
            'title' => $this->title,
            'img' => $this->img ? asset("/storage/{$this->img}") : null,
            'date' => date_format($this->created_at, 'd M, Y'),
            'likes' => $this->likes->map(function ($like) {
                return [
                    'user_id' => $like->user_id,
                    'post_id' => $like->post_id,
                    'post_likes' => $like->post_likes
                ];
            }),
            'category' => [
                'id' => $this->category->id,
                'slug' => $this->category->slug,
                'title' => $this->category->title,
            ],
            'tags' => $this->tags->map(function ($tag) {
                return [
                    'id' => $tag->id,
                    'title' => $tag->title,
                    'slug' => $tag->slug,
                ];
            }),
        ];
    }
}
