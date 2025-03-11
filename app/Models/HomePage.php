<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    use HasFactory;
    protected $fillable = [
     'title',
     'foto_path',
     'content',
     'button',
     'button_alt',
     'status',
     'order',
     'colour_text',
     'colour_background',
     'colour_button',
    ];
}
