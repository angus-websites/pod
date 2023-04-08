<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'groups' => FeatureGroupResource::collection($this->groups()->get()),
            'streak' => number_format($this->streak()),
            'entry count' => number_format(count($this->entries)),
            'total word count' => number_format($this->totalWordCount())
        ];
    }
}
