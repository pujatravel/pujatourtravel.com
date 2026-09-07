<?php

namespace Tests\Feature;

use App\Models\Package;
use App\Models\PackageCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PackagePublicTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $category = PackageCategory::create([
            'name' => 'Body Rafting',
            'slug' => 'body-rafting',
            'description' => 'Petualangan menyusuri jeram air',
            'display_order' => 1,
            'is_active' => true,
        ]);

        Package::create([
            'category_id' => $category->id,
            'name' => 'Body Rafting Green Canyon',
            'slug' => 'body-rafting-green-canyon',
            'short_description' => 'Paket seru menyusuri ngarai stalaktit.',
            'description' => 'Deskripsi lengkap body rafting Green Canyon.',
            'price' => 225000,
            'currency' => 'IDR',
            'price_unit' => 'pax',
            'duration' => '4 Jam',
            'location' => 'Green Canyon, Pangandaran',
            'featured' => true,
            'status' => 'PUBLISHED',
            'inclusions' => ['Pemandu HPI', 'Helm Safety'],
            'exclusions' => ['Pengeluaran pribadi'],
            'itinerary' => [
                ['time' => '08:00', 'activity' => 'Briefing', 'desc' => 'Pemasangan alat'],
            ],
        ]);
    }

    public function test_homepage_displays_limited_packages_and_baca_selengkapnya(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Baca Selengkapnya');
        $response->assertSee('Body Rafting Green Canyon');
        $response->assertDontSee('btn-view-package');
        $response->assertSee('package-card-slider');
        $response->assertSee('hero-slider');
        $response->assertSee('lightbox-modal');
        $response->assertSee('lightbox-autoplay-btn');
    }

    public function test_package_model_provides_gallery_images_array(): void
    {
        $pkg = Package::where('slug', 'body-rafting-green-canyon')->first();
        $this->assertNotNull($pkg);
        $this->assertIsArray($pkg->gallery_images);
        $this->assertNotEmpty($pkg->gallery_images);
    }

    public function test_packages_catalog_displays_published_packages(): void
    {
        $response = $this->get('/paket');

        $response->assertStatus(200);
        $response->assertSee('Semua Paket Wisata');
        $response->assertSee('Body Rafting Green Canyon');
    }

    public function test_package_detail_page_displays_package_information(): void
    {
        $response = $this->get('/paket/body-rafting-green-canyon');

        $response->assertStatus(200);
        $response->assertSee('Body Rafting Green Canyon');
        $response->assertSee('Rp 225.000');
        $response->assertSee('Pemandu HPI');
    }

    public function test_package_detail_page_returns_404_for_nonexistent_package(): void
    {
        $response = $this->get('/paket/paket-yang-tidak-ada');

        $response->assertStatus(404);
    }
}
