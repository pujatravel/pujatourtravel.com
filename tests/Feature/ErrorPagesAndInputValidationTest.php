<?php

namespace Tests\Feature;

use App\Models\Package;
use App\Models\PackageCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ErrorPagesAndInputValidationTest extends TestCase
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
        ]);
    }

    public function test_unknown_route_returns_custom_404_page(): void
    {
        $response = $this->get('/halaman-yang-sama-sekali-tidak-ada');

        $response->assertStatus(404);
        $response->assertSee('Jalur Wisata Belum Terpetakan');
        $response->assertSee('Error 404');
        $response->assertSee('PUJA TOUR & TRAVEL', false);
        $response->assertSee('Kembali ke Beranda');
    }

    public function test_nonexistent_package_slug_returns_custom_404_page(): void
    {
        $response = $this->get('/paket/paket-fiktif-12345');

        $response->assertStatus(404);
        $response->assertSee('Jalur Wisata Belum Terpetakan');
        $response->assertSee('Katalog Paket Wisata');
    }

    public function test_custom_error_views_render_successfully(): void
    {
        $view403 = view('errors.403')->render();
        $this->assertStringContainsString('Error 403', $view403);
        $this->assertStringContainsString('Area Akses Terbatas', $view403);

        $view419 = view('errors.419')->render();
        $this->assertStringContainsString('Error 419', $view419);
        $this->assertStringContainsString('Sesi Keamanan Telah Berakhir', $view419);

        $view500 = view('errors.500')->render();
        $this->assertStringContainsString('Error 500', $view500);
        $this->assertStringContainsString('Sistem Sedang Mengalami Kendala', $view500);

        $view503 = view('errors.503')->render();
        $this->assertStringContainsString('Error 503', $view503);
        $this->assertStringContainsString('Sedang Peningkatan Sistem', $view503);

        $view429 = view('errors.429')->render();
        $this->assertStringContainsString('Error 429', $view429);
        $this->assertStringContainsString('Mohon Tunggu Sejenak', $view429);

        $view400 = view('errors.400')->render();
        $this->assertStringContainsString('Error 400', $view400);
        $this->assertStringContainsString('Permintaan Tidak Dapat Diproses', $view400);
    }

    public function test_package_search_handles_special_characters_and_wildcards_without_error(): void
    {
        // Test with raw wildcards and potential injection syntax
        $response = $this->get('/paket?search=%25%20_%27%22%3Cscript%3Ealert(1)%3C/script%3E');

        $response->assertStatus(200);
        $response->assertDontSee('<script>alert(1)</script>', false);
    }

    public function test_package_category_filter_handles_invalid_category_gracefully(): void
    {
        $response = $this->get('/paket?category=kategori-tidak-ada-xyz');

        $response->assertStatus(200);
        $response->assertSee('Kategori yang Anda pilih tidak tersedia');
    }

    public function test_package_sorting_handles_all_whitelisted_and_unwhitelisted_options(): void
    {
        $options = ['price_asc', 'price_desc', 'popular', 'latest', 'unknown_sort_injection_123'];

        foreach ($options as $opt) {
            $response = $this->get("/paket?sort={$opt}");
            $response->assertStatus(200);
            $response->assertSee('Pilihan Paket Wisata Pangandaran');
        }
    }
}
