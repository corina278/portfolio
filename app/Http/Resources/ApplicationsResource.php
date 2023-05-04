<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationsResource extends JsonResource
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
            'cv' => asset('/storage/'. $this->cv),
            'cover_letter' => asset('/storage', $this->cover_letter),
            'skill' => new SkillResource($this->whenLoaded('skill')),
            'project_url' => $this->project_url,
        ];
    }
}
