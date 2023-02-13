<?php

namespace App\Http\Resources;

use App\Http\Resources\TemplateResource;

use Illuminate\Http\Resources\Json\JsonResource;

class EntryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $template = new TemplateResource($this->template());

        return [
            'id' => $this->id,
            'template' => $template,
            'title' => $this->title,
            'data' => $this->data,
        ];
    }
}
