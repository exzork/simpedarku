<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ReportResource extends JsonResource
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
            'id'=>$this->id,
            'type'=>$this->type,
            'user'=>UserResource::make($this->user),
            'title'=>$this->title,
            'location'=>$this->location,
            'description'=>$this->description,
            'image_url'=> $this->image_path == null ? "null" : Storage::url($this->image_path),
            'status'=>$this->status,
        ];
    }
}
