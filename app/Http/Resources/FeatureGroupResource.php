<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use JustSteveKing\Laravel\FeatureFlags\Models\Feature;

class FeatureGroupResource extends JsonResource
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
            'bg' => $this->bg,
            'fg' => $this->fg,
            'description' => $this->description,
            'features' => FeatureResource::collection($this->belongsToMany(Feature::class)->get()),
            'active' => $this->active,
            'userCount' => DB::table('feature_group_user')->where("feature_group_id", "=", $this->id)->count()
        ];
    }
}
