<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MasterListResource extends JsonResource
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
            'id'    => $this->id,
            'nama_buku' => $this->nama_buku,
            'penerbit' => $this->penerbit,
            // 'tgl_terbit' => ($this->tgl_terbit == null) ? '-' : date('d-m-Y', strtotime($this->tgl_terbit)),
            'tgl_terbit' => $this->tgl_terbit == null ? '-' : date('Y-m-d', strtotime($this->tgl_terbit)),
            'status' => $this->status,
            'created_at' => ($this->created_at == null) ? '-' : date('d-m-Y', strtotime($this->created_at)),
            'file' => $this->imageBookFiles
        ];
    }
}
