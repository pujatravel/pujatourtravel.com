<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_url',
        'category',
        'caption',
        'is_slider',
        'is_published',
        'display_order',
    ];

    protected $casts = [
        'is_slider' => 'boolean',
        'is_published' => 'boolean',
        'display_order' => 'integer',
    ];
}
