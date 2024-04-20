<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class PollsResource extends JsonResource
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
            'poll_tittle' => $this->poll_tittle,
            'question_description' => Str::limit($this->question_description, 60),
            'votes' => $this->votes,
            'choices' => $this->choices,
        ];
    }
}
