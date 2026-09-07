<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Package;
use App\Models\PackageCategory;
use App\Models\Reservation;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User (id/username: admin, pw: admin)
        User::updateOrCreate(
            ['email' => 'admin@pujatourtravel.com'],
            [
                'name' => 'Administrator Puja Tour',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        // 2. Categories
        $catRafting = PackageCategory::updateOrCreate(['slug' => 'body-rafting'], [
            'name' => 'Body Rafting & River Adventure',
            'description' => 'Petualangan menyusuri jeram air zamrud dan ngarai alami Pangandaran.',
            'display_order' => 1,
            'is_active' => true,
        ]);

        $catBahari = PackageCategory::updateOrCreate(['slug' => 'wisata-bahari'], [
            'name' => 'Wisata Bahari & Snorkeling',
            'description' => 'Eksplorasi bawah laut Pasir Putih, pantai karang, dan perahu wisata.',
            'display_order' => 2,
            'is_active' => true,
        ]);

        $catVip = PackageCategory::updateOrCreate(['slug' => 'eksklusif-gathering'], [
            'name' => 'Paket VIP 2D1N & Corporate Gathering',
            'description' => 'Paket all-inclusive hotel resort pantai, gala dinner seafood, dan outbound.',
            'display_order' => 3,
            'is_active' => true,
        ]);

        $catEdukasi = PackageCategory::updateOrCreate(['slug' => 'edukasi-konservasi'], [
            'name' => 'Semi Edukasi & Konservasi Alam',
            'description' => 'Penjelajahan cagar alam, satwa liar, gua purba, dan pelestarian penyu.',
            'display_order' => 4,
            'is_active' => true,
        ]);

        // 3. Packages
        $pkg1 = Package::updateOrCreate(['slug' => 'body-rafting-green-canyon-full-track'], [
            'category_id' => $catRafting->id,
            'name' => 'Body Rafting Green Canyon Full Track',
            'short_description' => 'Menyusuri ngarai stalaktit abadi sejauh 10 km dengan air zamrud jernih, lompatan tebing, dan air terjun alami.',
            'description' => 'Petualangan menyusuri Green Canyon sepanjang 10 km dengan pemandu lokal profesional. Rasakan sensasi berenang di celah ngarai purba yang megah, lompat tebing dengan ketinggian bervariasi (aman & opsional), serta relaksasi di kolam alami.',
            'price' => 225000,
            'currency' => 'IDR',
            'price_unit' => 'pax',
            'duration' => '4 - 5 Jam',
            'location' => 'Green Canyon (Cukang Taneuh), Pangandaran',
            'image_url' => '/images/greencanyon.jpg',
            'featured' => true,
            'status' => 'PUBLISHED',
            'inclusions' => ['Pemandu Resmi HPI', 'Helm & Rompi Pelampung Standar', 'Perahu Jemputan (Boat)', 'Makan Siang Prasmanan Khas Sunda', 'Tiket Masuk & Asuransi Jiwa', 'Dokumentasi Foto'],
            'exclusions' => ['Transportasi dari kota asal', 'Pengeluaran pribadi di luar paket', 'Tip sukarela pemandu'],
            'itinerary' => [
                ['time' => '08:00', 'activity' => 'Briefing & Pemasangan Alat', 'desc' => 'Tiba di dermaga Green Canyon, cek kesehatan singkat, pemakaian helm & pelampung.'],
                ['time' => '08:30', 'activity' => 'Start Body Rafting Hulu Sungai', 'desc' => 'Menyusuri hulu sungai Cijulang dengan air jernih kehijauan.'],
                ['time' => '11:00', 'activity' => 'Spot Lompat Tebing & Gua Abadi', 'desc' => 'Eksplorasi stalaktit Cukang Taneuh dan titik lompat tebing 5-10 meter (opsional).'],
                ['time' => '12:30', 'activity' => 'Penjemputan Perahu & Makan Siang', 'desc' => 'Naik perahu kembali ke dermaga dan santap siang prasmanan khas Sunda.'],
            ],
            'seo_title' => 'Paket Body Rafting Green Canyon Pangandaran Full Track Resmi',
            'seo_description' => 'Paket Body Rafting Green Canyon Pangandaran bergaransi pemandu lisensi HPI, all-inclusive makan siang dan asuransi.',
        ]);

        $pkg2 = Package::updateOrCreate(['slug' => 'snorkeling-wisata-bahari-pasir-putih'], [
            'category_id' => $catBahari->id,
            'name' => 'Snorkeling & Wisata Bahari Pasir Putih',
            'short_description' => 'Mengarungi laut dengan perahu wisata khas Pangandaran, melihat bangkai kapal MV Viking, dan snorkeling terumbu karang.',
            'description' => 'Eksplorasi keindahan bawah laut Pasir Putih Pangandaran. Naik perahu tradisional menyusuri teluk, melihat situs bersejarah bangkai kapal MV Viking, dan menikmati jernihnya air laut bersama ikan karang.',
            'price' => 175000,
            'currency' => 'IDR',
            'price_unit' => 'pax',
            'duration' => '3 - 4 Jam',
            'location' => 'Pantai Pasir Putih & Cagar Alam, Pangandaran',
            'image_url' => '/images/pasir_putih.jpg',
            'featured' => true,
            'status' => 'PUBLISHED',
            'inclusions' => ['Sewa Perahu Wisata Pantai', 'Peralatan Snorkeling Lengkap', 'Pemandu Renang & Rescue', 'Tiket Masuk Cagar Alam', 'Foto & Video Underwater'],
            'exclusions' => ['Pakaian renang pribadi', 'Makan & minum tambahan'],
            'itinerary' => [
                ['time' => '08:30', 'activity' => 'Berlayar dari Pantai Barat', 'desc' => 'Naik perahu melintasi tebing cagar alam menuju spot Pasir Putih.'],
                ['time' => '09:00', 'activity' => 'Snorkeling & Foto Bawah Air', 'desc' => 'Berenang bersama ikan nemo dan terumbu karang dengan pendampingan guide.'],
                ['time' => '11:00', 'activity' => 'Kunjungan Spot MV Viking', 'desc' => 'Melihat bangkai kapal legendaris dan bersantai di pantai pasir putih.'],
            ],
            'seo_title' => 'Snorkeling Pasir Putih Pangandaran Terbaik',
            'seo_description' => 'Paket wisata bahari snorkeling Pasir Putih Pangandaran dengan pemandu dan dokumentasi underwater.',
        ]);

        $pkg3 = Package::updateOrCreate(['slug' => 'eksklusif-tour-pangandaran-2d1n'], [
            'category_id' => $catVip->id,
            'name' => 'Eksklusif Tour Pangandaran 2D1N',
            'short_description' => 'Paket lengkap hotel resort tepi pantai, Green Canyon, Pasir Putih, sunset dinner seafood, dan transportasi AC private.',
            'description' => 'Nikmati liburan mewah dan praktis di Pangandaran selama 2 hari 1 malam. Akomodasi hotel resort bintang 3/4 pilihan tepi pantai, gala dinner seafood bakar khas pesisir, dan trip all-in tanpa ribet.',
            'price' => 750000,
            'currency' => 'IDR',
            'price_unit' => 'pax',
            'duration' => '2 Hari 1 Malam',
            'location' => 'All-Highlights Pangandaran & Batu Karas',
            'image_url' => '/images/sunset_batu_karas.jpg',
            'featured' => true,
            'status' => 'PUBLISHED',
            'inclusions' => ['Hotel Resort Tepi Pantai 1 Malam', 'Makan 4x (Termasuk Gala Dinner Seafood)', 'Paket Body Rafting Green Canyon', 'Wisata Perahu Pasir Putih', 'Tiket Masuk Semua Wisata', 'Dokumentasi Foto & Video Drone'],
            'exclusions' => ['Pengeluaran di mini bar hotel', 'Kebutuhan obat-obatan khusus'],
            'itinerary' => [
                ['time' => 'Hari 1 - 09:00', 'activity' => 'Penjemputan & Check-in Hotel', 'desc' => 'Penyambutan tamu, welcome drink, dan istirahat sejenak.'],
                ['time' => 'Hari 1 - 13:00', 'activity' => 'Wisata Green Canyon & Rafting', 'desc' => 'Petualangan menyusuri ngarai stalaktit.'],
                ['time' => 'Hari 1 - 18:30', 'activity' => 'Sunset Seafood Gala Dinner', 'desc' => 'Makan malam romantis dengan hidangan seafood segar di pinggir pantai Batu Karas.'],
                ['time' => 'Hari 2 - 08:00', 'activity' => 'Pasir Putih & Snorkeling', 'desc' => 'Bermain air laut di Pasir Putih dan belanja oleh-oleh khas Pangandaran.'],
            ],
            'seo_title' => 'Paket Tour Pangandaran 2D1N All Inclusive',
            'seo_description' => 'Liburan eksklusif 2 hari 1 malam di Pangandaran, hotel resort, dinner seafood, dan body rafting.',
        ]);

        $pkg4 = Package::updateOrCreate(['slug' => 'river-tubing-santirah-adventure'], [
            'category_id' => $catRafting->id,
            'name' => 'River Tubing Santirah & Gua Air Purba',
            'short_description' => 'Menyusuri jeram sungai dengan ban pelampung khusus menembus 4 lorong gua alami yang menakjubkan.',
            'description' => 'Pacu adrenalin dengan river tubing Santirah. Mengarungi aliran sungai jernih yang membelah dinding tebing batu kapur dan 4 lorong gua alami dengan air terjun di tengah lintasan.',
            'price' => 125000,
            'currency' => 'IDR',
            'price_unit' => 'pax',
            'duration' => '2.5 - 3 Jam',
            'location' => 'Santirah River, Selasari Pangandaran',
            'image_url' => '/images/greencanyon.jpg',
            'featured' => false,
            'status' => 'PUBLISHED',
            'inclusions' => ['Ban Tubing Khusus & Rompi Pelampung', 'Helm Safety', 'River Guide Berpengalaman', 'Asuransi', 'Kelapa Muda Segar di Finish'],
            'exclusions' => ['Transportasi antar-jemput ke lokasi'],
            'itinerary' => [],
            'seo_title' => 'River Tubing Santirah Pangandaran',
            'seo_description' => 'Petualangan river tubing Santirah Pangandaran menembus 4 gua alami eksotis.',
        ]);

        $pkg5 = Package::updateOrCreate(['slug' => 'safari-hutan-lindung-budaya-pesisir'], [
            'category_id' => $catEdukasi->id,
            'name' => 'Safari Hutan Lindung & Budaya Pesisir',
            'short_description' => 'Eksplorasi flora-fauna rusa Pananjung, gua peninggalan purba, dan edukasi pelestarian penyu hijau serta hutan mangrove.',
            'description' => 'Program semi-edukasi yang ideal untuk keluarga, sekolah, dan komunitas. Menjelajahi cagar alam Pananjung, mengamati satwa liar, mengunjungi gua bersejarah, dan berpartisipasi dalam konservasi penyu.',
            'price' => 150000,
            'currency' => 'IDR',
            'price_unit' => 'pax',
            'duration' => '4 Jam',
            'location' => 'Cagar Alam Pananjung & Batu Hiu',
            'image_url' => '/images/cagar_alam.jpg',
            'featured' => false,
            'status' => 'PUBLISHED',
            'inclusions' => ['Naturalist Guide', 'Tiket Cagar Alam & Konservasi', 'Pelepasan Tukik (Musiman)', 'Snack Khas Lokal & Air Mineral'],
            'exclusions' => ['Pengeluaran pribadi'],
            'itinerary' => [],
            'seo_title' => 'Safari Cagar Alam Pangandaran',
            'seo_description' => 'Wisata edukasi cagar alam Pananjung dan konservasi penyu Pangandaran.',
        ]);

        $pkg6 = Package::updateOrCreate(['slug' => 'corporate-family-gathering-3d2n'], [
            'category_id' => $catVip->id,
            'name' => 'Family & Corporate Gathering 3D2N',
            'short_description' => 'Program lengkap outbound pantai, gala dinner live music & seafood bakar, Green Canyon, dan armada bus pariwisata.',
            'description' => 'Paket gathering terlengkap untuk perusahaan dan keluarga besar. Dirancang untuk mempererat kebersamaan dengan games outbound seru, malam keakraban live music seafood barbecue, dan eksplorasi destinasi terbaik.',
            'price' => 1150000,
            'currency' => 'IDR',
            'price_unit' => 'pax',
            'duration' => '3 Hari 2 Malam',
            'location' => 'Pangandaran - Green Canyon - Batu Karas',
            'image_url' => '/images/hero_pangandaran.jpg',
            'featured' => true,
            'status' => 'PUBLISHED',
            'inclusions' => ['Hotel Bintang 4 Pangandaran 2 Malam', 'Fun Games Outbound + Fasilitator', 'Gala Dinner Seafood Live Music', 'Armada Bus AC Pariwisata', 'Spanduk / Banner Acara', 'Video Dokumentasi Profesional'],
            'exclusions' => ['Seragam kaos custom (opsional disiapkan)'],
            'itinerary' => [],
            'seo_title' => 'Paket Gathering Pangandaran 3D2N Corporate & Family',
            'seo_description' => 'Paket corporate gathering dan outbound Pangandaran 3 hari 2 malam terlengkap.',
        ]);

        // 4. Sample Reservations
        Reservation::updateOrCreate(['code' => 'RES-2026-000101'], [
            'customer_name' => 'Budi Santoso',
            'customer_phone' => '081298765432',
            'customer_email' => 'budi.santoso@gmail.com',
            'package_id' => $pkg1->id,
            'package_name' => $pkg1->name,
            'travel_date' => now()->addDays(5)->format('Y-m-d'),
            'pax_count' => 6,
            'total_price' => 1215000, // discount 10%
            'source' => 'Website',
            'notes' => 'Tolong sediakan pemandu yang ramah untuk anak-anak.',
            'admin_notes' => 'Sudah ditindaklanjuti via WA, DP 30% diterima via BCA.',
            'status' => 'DIKONFIRMASI',
        ]);

        Reservation::updateOrCreate(['code' => 'RES-2026-000102'], [
            'customer_name' => 'PT Surya Digital Pratama (Ibu Maya)',
            'customer_phone' => '081388776655',
            'customer_email' => 'maya.hrd@suryadigital.co.id',
            'package_id' => $pkg6->id,
            'package_name' => $pkg6->name,
            'travel_date' => now()->addDays(12)->format('Y-m-d'),
            'pax_count' => 45,
            'total_price' => 44000000,
            'source' => 'Website',
            'notes' => 'Butuh panggung kecil untuk acara internal di malam kedua.',
            'admin_notes' => 'Tahap negosiasi menu banquet dan koordinasi hotel.',
            'status' => 'DIPROSES',
        ]);

        Reservation::updateOrCreate(['code' => 'RES-2026-000103'], [
            'customer_name' => 'dr. Hendra Wijaya',
            'customer_phone' => '085712345678',
            'customer_email' => 'hendra.wijaya@yahoo.com',
            'package_id' => $pkg2->id,
            'package_name' => $pkg2->name,
            'travel_date' => now()->addDays(2)->format('Y-m-d'),
            'pax_count' => 4,
            'total_price' => 700000,
            'source' => 'WhatsApp',
            'notes' => 'Minta foto underwater banyak dengan ikan badut.',
            'admin_notes' => 'Menunggu transfer DP.',
            'status' => 'PENDING',
        ]);

        Reservation::updateOrCreate(['code' => 'RES-2026-000098'], [
            'customer_name' => 'Dian Kusuma',
            'customer_phone' => '082133445566',
            'customer_email' => 'dian.kusuma@gmail.com',
            'package_id' => $pkg3->id,
            'package_name' => $pkg3->name,
            'travel_date' => now()->subDays(3)->format('Y-m-d'),
            'pax_count' => 2,
            'total_price' => 1500000,
            'source' => 'Website',
            'notes' => 'Paket honeymoon 2D1N.',
            'admin_notes' => 'Trip sukses tuntas, customer sangat puas bintang 5.',
            'status' => 'SELESAI',
        ]);

        // 5. Galleries
        $galleries = [
            ['title' => 'Body Rafting Green Canyon', 'image_url' => '/images/greencanyon.jpg', 'category' => 'Rafting', 'caption' => 'Petualangan menyusuri ngarai stalaktit Green Canyon'],
            ['title' => 'Snorkeling Pasir Putih', 'image_url' => '/images/pasir_putih.jpg', 'category' => 'Bahari', 'caption' => 'Terumbu karang dan kejernihan air laut Pasir Putih'],
            ['title' => 'Sunset Pantai Batu Karas', 'image_url' => '/images/sunset_batu_karas.jpg', 'category' => 'Sunset', 'caption' => 'Pemandangan senja eksotis di Batu Karas'],
            ['title' => 'Cagar Alam Pananjung', 'image_url' => '/images/cagar_alam.jpg', 'category' => 'Alam', 'caption' => 'Kawanan rusa liar di bawah naungan pohon beringin'],
            ['title' => 'Panorama Bahari Pangandaran', 'image_url' => '/images/hero_pangandaran.jpg', 'category' => 'Pantai', 'caption' => 'Garis pantai dan perahu nelayan khas Pangandaran'],
        ];

        foreach ($galleries as $index => $gal) {
            Gallery::updateOrCreate(['title' => $gal['title']], [
                'image_url' => $gal['image_url'],
                'category' => $gal['category'],
                'caption' => $gal['caption'],
                'is_published' => true,
                'display_order' => $index + 1,
            ]);
        }

        // 6. Testimonials
        Testimonial::updateOrCreate(['customer_name' => 'Rian & Annisa'], [
            'customer_city' => 'Bandung',
            'avatar_url' => null,
            'package_name' => 'Paket Green Canyon Full Track',
            'rating' => 5,
            'review_text' => 'Trip Green Canyon bareng Puja Tour bener-bener luar biasa! Pemandunya Kang Asep ramah banget, sabar bimbing keluarga saya yang baru pertama kali body rafting. Makan siang prasmanan Sundanya juga mantap!',
            'is_featured' => true,
            'is_published' => true,
            'trip_date' => now()->subDays(10)->format('Y-m-d'),
        ]);

        Testimonial::updateOrCreate(['customer_name' => 'Hendro Pramono'], [
            'customer_city' => 'Jakarta',
            'avatar_url' => null,
            'package_name' => 'Corporate Gathering 3D2N',
            'rating' => 5,
            'review_text' => 'Gathering kantor kami 40 orang dihandle sangat rapi oleh tim Puja Tour & Travel. Mulai dari bus, hotel resort tepi pantai, fun outbound, sampai gala dinner seafood bakar di Batu Karas. Sangat kami rekomendasikan!',
            'is_featured' => true,
            'is_published' => true,
            'trip_date' => now()->subDays(20)->format('Y-m-d'),
        ]);

        Testimonial::updateOrCreate(['customer_name' => 'Dina Safitri'], [
            'customer_city' => 'Yogyakarta',
            'avatar_url' => null,
            'package_name' => 'Paket Wisata Bahari Pasir Putih',
            'rating' => 5,
            'review_text' => 'Snorkeling di Pasir Putih seru banget, karangnya masih alami dan banyak ikan badut. Hasil foto underwater dan video drone dari tim dokumentasi jernih banget. Pelayanan bintang lima!',
            'is_featured' => true,
            'is_published' => true,
            'trip_date' => now()->subDays(15)->format('Y-m-d'),
        ]);

        // 7. Settings
        Setting::set('company_name', 'PUJA TOUR & TRAVEL PANGANDARAN');
        Setting::set('phone_number', '+62 812-3456-7890');
        Setting::set('whatsapp_number', '6281234567890');
        Setting::set('email_address', 'info@pujatourtravel.com');
        Setting::set('office_address', 'Jl. Pantai Barat No. 88, Pangandaran, Jawa Barat 46396');
        Setting::set('operational_hours', 'Setiap Hari: 06.00 - 21.00 WIB');
        Setting::set('instagram_url', 'https://instagram.com/pujatourtravel');
        Setting::set('tiktok_url', 'https://tiktok.com/@pujatourtravel');
    }
}
