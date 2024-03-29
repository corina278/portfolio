<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'image' => asset('/storage/'. $this->image),
            'skills' => $this->skills,
            'project_url' => $this->project_url,
            'updated_at' => date_format($this->updated_at,'Y-m-d'),
        ];
    }
}
