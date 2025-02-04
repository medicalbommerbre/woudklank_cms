<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePhotos extends Model
{
    use HasFactory;
    protected $table = 'home_photos';
    
    protected $fillable = [
        'photo_path',
        'caption',
        'home_id'
    ];
}
