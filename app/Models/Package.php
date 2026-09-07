<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'short_description',
        'description',
        'price',
        'currency',
        'price_unit',
        'duration',
        'location',
        'image_url',
        'featured',
        'status',
        'inclusions',
        'exclusions',
        'itinerary',
        'seo_title',
        'seo_description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'featured' => 'boolean',
        'inclusions' => 'array',
        'exclusions' => 'array',
        'itinerary' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(PackageCategory::class, 'category_id');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'package_id');
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp '.number_format((float) $this->price, 0, ',', '.');
    }
}
