<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookFileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'library_id' => $this->id_izin,  
            'name' => $this->name,
            'size' => $this->size,
            'ext' => $this->ext,
            'is_image' => $this->is_image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'url' => url($this->path),
        ];
    }
}
