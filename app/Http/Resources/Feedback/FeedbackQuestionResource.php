<?php

namespace App\Http\Resources\Feedback;

use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackQuestionResource extends JsonResource
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
            'name' => $this->name,
            'group' => $this->group()->id,
            'type' => strtolower($this->question_type),
            'data' => $this->data
        ];
    }
}
