<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowPostResource extends JsonResource
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
            'user' => $this->user->name,
            'title' => $this->title,
            'img' => $this->img ? asset("/storage/{$this->img}") : null,
            'content' => $this->content,
            'date' => date_format($this->created_at, 'd M, Y'),
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
            'comments' => $this->comments->map(function ($comment) {
                return [
                    'user' => $comment->user->name,
                    'id' => $comment->id,
                    'slug' => $comment->slug,
                    'content' => $comment->content_comment,
                    'date' => date_format($comment->created_at, 'd M, Y'),
                    'replies' => $comment->replies->map(function ($reply) {
                        return [
                            'user' => $reply->user->name,
                            'id' => $reply->id,
                            'slug' => $reply->slug,
                            'content' => $reply->content_reply,
                            'date' => date_format($reply->created_at, 'd M, Y'),
                        ];
                    })
                ];
            })
        ];
    }
}
