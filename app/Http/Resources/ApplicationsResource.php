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
            'cover_letter' => asset('/storage/'. $this->cover_letter),
            'skills' => $this->skills,
            'project' => new ProjectResource($this->whenLoaded('project')),
            'project_url' => $this->project->project_url,
            'updated_at' => date_format($this->updated_at,'Y-m-d'),
        ];
    }
}
