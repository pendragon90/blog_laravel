<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
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
            'comment_id' => $this->comment_id,
            'date' => date_format($this->created_at, 'd M, Y'),
            'content_reply' => $this->content_reply,
        ];
    }
}
