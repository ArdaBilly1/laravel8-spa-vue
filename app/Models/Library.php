<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_buku',
        'penerbit',
        'tgl_terbit',
        'status',
        'is_ready',
    ];

    public function imageBookFiles()
    {
        return $this->hasOne(ImageBookFile::class,'library_id');
    }

    public function setTglTerbitAttribute($value)
    {
        $this->attributes['tgl_terbit'] = (new Carbon($value))->format('Y-m-d');
    }
}
