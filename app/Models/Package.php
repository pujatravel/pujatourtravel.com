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

    /**
     * Get a list of rich destination images for gallery slider.
     *
     * @return array<int, string>
     */
    public function getGalleryImagesAttribute(): array
    {
        $primary = $this->image_url ?: '/images/greencanyon.jpg';

        $galleries = [
            'body-rafting-green-canyon-full-track' => [
                '/images/greencanyon.jpg',
                '/images/cagar_alam.jpg',
                '/images/hero_pangandaran.jpg',
                '/images/sunset_batu_karas.jpg',
            ],
            'snorkeling-wisata-bahari-pasir-putih' => [
                '/images/pasir_putih.jpg',
                '/images/hero_pangandaran.jpg',
                '/images/cagar_alam.jpg',
                '/images/sunset_batu_karas.jpg',
            ],
            'eksklusif-tour-pangandaran-2d1n' => [
                '/images/sunset_batu_karas.jpg',
                '/images/greencanyon.jpg',
                '/images/pasir_putih.jpg',
                '/images/hero_pangandaran.jpg',
                '/images/cagar_alam.jpg',
            ],
            'river-tubing-santirah-adventure' => [
                '/images/greencanyon.jpg',
                '/images/cagar_alam.jpg',
                '/images/hero_pangandaran.jpg',
            ],
            'safari-hutan-lindung-budaya-pesisir' => [
                '/images/cagar_alam.jpg',
                '/images/pasir_putih.jpg',
                '/images/hero_pangandaran.jpg',
            ],
            'corporate-family-gathering-3d2n' => [
                '/images/hero_pangandaran.jpg',
                '/images/sunset_batu_karas.jpg',
                '/images/pasir_putih.jpg',
                '/images/greencanyon.jpg',
            ],
            'body-rafting-citumang-green-valley' => [
                '/images/greencanyon.jpg',
                '/images/cagar_alam.jpg',
                '/images/hero_pangandaran.jpg',
            ],
            'sunset-surfing-batu-karas-madasari' => [
                '/images/sunset_batu_karas.jpg',
                '/images/hero_pangandaran.jpg',
                '/images/pasir_putih.jpg',
            ],
        ];

        if (isset($this->slug, $galleries[$this->slug])) {
            return $galleries[$this->slug];
        }

        return array_values(array_unique([
            $primary,
            '/images/hero_pangandaran.jpg',
            '/images/pasir_putih.jpg',
            '/images/sunset_batu_karas.jpg',
            '/images/cagar_alam.jpg',
        ]));
    }
}
