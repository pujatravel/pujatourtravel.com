<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Package;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        $pkg = Package::first();

        // Sample 1: Partial DP
        $inv1 = Invoice::updateOrCreate(
            ['invoice_number' => 'INV-'.date('Ymd').'-0001'],
            [
                'invoice_date' => now(),
                'due_date' => now()->addDays(3),
                'travel_date' => now()->addDays(7),
                'customer_name' => 'Bpk. Hendra Gunawan',
                'customer_phone' => '081234567890',
                'customer_email' => 'hendra.gunawan@example.com',
                'customer_address' => 'Bandung, Jawa Barat',
                'package_id' => $pkg ? $pkg->id : null,
                'package_name' => $pkg ? $pkg->name : 'Body Rafting Green Canyon Full Track',
                'pax_count' => 10,
                'status' => 'PARTIAL',
                'payment_method' => 'Transfer Bank BCA',
                'bank_details' => "BCA: 123-456-7890 (a/n Puja Tour & Travel)\nMandiri: 177-00-1234567-8 (a/n Puja Tour & Travel)\nBRI: 0123-01-001234-50-1 (a/n Puja Tour & Travel)\nQRIS: Tersedia",
                'subtotal' => 2250000,
                'discount' => 100000,
                'tax_percent' => 0,
                'tax_amount' => 0,
                'total_amount' => 2150000,
                'paid_amount' => 700000,
                'remaining_amount' => 1450000,
                'notes' => "1. Pembayaran DP sebesar Rp 700.000 telah kami terima.\n2. Pelunasan sisa tagihan Rp 1.450.000 dilakukan saat tiba di meeting point Green Canyon.\n3. Harap membawa pakaian ganti & alas kaki basah.",
                'admin_notes' => 'Guide Kang Asep sudah dikonfirmasi standby di dermaga.',
            ]
        );

        $inv1->items()->delete();
        $inv1->items()->create([
            'item_name' => 'Paket Body Rafting Green Canyon Full Track',
            'description' => 'Termasuk pemandu berlisensi HPI, helm, lifejacket pelampung, makan siang nasi liwet Sunda, perahu jemputan, tiket & asuransi jiwa.',
            'quantity' => 10,
            'unit' => 'pax',
            'price' => 225000,
            'subtotal' => 2250000,
            'display_order' => 1,
        ]);

        // Sample 2: Paid in Full
        $inv2 = Invoice::updateOrCreate(
            ['invoice_number' => 'INV-'.date('Ymd').'-0002'],
            [
                'invoice_date' => now()->subDays(2),
                'due_date' => now()->subDay(),
                'travel_date' => now()->addDays(12),
                'customer_name' => 'Ibu Dina Safitri & Rombongan (PT Mitra Sejahtera)',
                'customer_phone' => '087812345678',
                'customer_email' => 'dina.safitri@mitrasejahtera.co.id',
                'customer_address' => 'Jakarta Selatan',
                'package_id' => $pkg ? $pkg->id : null,
                'package_name' => 'Corporate Gathering 3D2N Pangandaran All Inclusive',
                'pax_count' => 30,
                'status' => 'PAID',
                'payment_method' => 'Transfer Bank Mandiri',
                'bank_details' => "Mandiri: 177-00-1234567-8 (a/n Puja Tour & Travel)",
                'subtotal' => 34500000,
                'discount' => 1500000,
                'tax_percent' => 0,
                'tax_amount' => 0,
                'total_amount' => 33000000,
                'paid_amount' => 33000000,
                'remaining_amount' => 0,
                'notes' => "Tagihan LUNAS 100%. Fasilitas Hotel Resort Pantai 2 Malam, Bus AC, Fun Outbound, Gala Dinner Seafood Live Music, dan Dokumentasi Drone.",
                'admin_notes' => 'Invoice lunas. Sudah masuk kas utama Mandiri.',
            ]
        );

        $inv2->items()->delete();
        $inv2->items()->createMany([
            [
                'item_name' => 'Paket Gathering 3D2N Exclusive',
                'description' => 'Hotel resort 2 malam, makan prasmanan 6x, gala dinner live music seafood, rafting Green Canyon.',
                'quantity' => 30,
                'unit' => 'pax',
                'price' => 1000000,
                'subtotal' => 30000000,
                'display_order' => 1,
            ],
            [
                'item_name' => 'Sewa Armada Bus Pariwisata Jetbus 35 Seats',
                'description' => 'Antar-jemput Jakarta - Pangandaran PP + BBM + Driver + Tol.',
                'quantity' => 1,
                'unit' => 'unit',
                'price' => 4500000,
                'subtotal' => 4500000,
                'display_order' => 2,
            ]
        ]);
    }
}
