<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageBookFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'library_id',
        'name',
        'path',
        'size',
        'ext',
        'is_image'
    ];
}
