<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'date' => date_format($this->created_at, 'd M, Y'),
            'content_comment' => $this->content_comment,
            'replies' => $this->replies->map(function ($reply) {
                return [
                    'id' => $reply->id,
                    'slug' => $reply->slug,
                    'user' => $reply->user->name,
                    'content_reply' => $reply->content_reply,
                ];
            })
        ];
    }
}
