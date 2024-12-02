<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivedEvent extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_title',
        'event_description',
        'event_date',
        'event_time',
        'location',
        'image_path'
    ];
}
