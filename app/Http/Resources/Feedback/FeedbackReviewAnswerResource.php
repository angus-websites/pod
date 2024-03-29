<?php

namespace App\Http\Resources\Feedback;

use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackReviewAnswerResource extends JsonResource
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
            'answer' => $this->answer,
        ];
    }
}
