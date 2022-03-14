<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => $this->User::find($this->user_id),
            'user_id' => $this->user_id,
            'description' => $this->description,
            'rating' => $this->rating,
            'image' => $this->image,
        ];
    }
}
