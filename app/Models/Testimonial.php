<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_city',
        'avatar_url',
        'package_name',
        'rating',
        'review_text',
        'is_featured',
        'is_published',
        'trip_date',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'trip_date' => 'date',
    ];
}
