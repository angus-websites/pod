<?php

namespace App\Http\Resources\Feedback;

use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackReviewQuestionResource extends JsonResource
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
            'caption' => $this->caption,
            'type' => strtolower($this->question_type),
            'targeted' => ($this->targeted) ?? false,
            'answers' => FeedbackReviewAnswerResource::collection(
                $this->answers()->get()
            )
        ];
    }
}
