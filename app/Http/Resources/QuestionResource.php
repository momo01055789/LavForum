<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title, 
            'path' => $this->path, 
            'body' => $this->body, 
            'created_at' => $this->created_at->diffFOrHumans(), 
            'user_name' => $this->user->name, 
            'user_id' => $this->user->id, 
            'replies' => ReplyResource::collection($this->reply),
            'replies_count' => $this->reply->count()
        ];
    }
}
