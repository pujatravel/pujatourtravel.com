<?php

namespace App\Helpers;

use App\Models\Package;
use App\Models\Setting;

class WhatsAppHelper
{
    /**
     * Clean and normalize a phone number to international format (628xxx).
     */
    public static function normalizeNumber(?string $phone = null): string
    {
        if (empty($phone)) {
            $phone = Setting::get('whatsapp_number', '6281234567890');
        }

        // Remove non-digit characters
        $digits = preg_replace('/\D+/', '', (string) $phone);

        // Convert 08xxx to 628xxx
        if (str_starts_with($digits, '0')) {
            $digits = '62'.substr($digits, 1);
        }

        return $digits ?: '6281234567890';
    }

    /**
     * Build a standardized WhatsApp click-to-chat deep link URL.
     */
    public static function buildUrl(?string $phone = null, ?string $message = null): string
    {
        $normalizedPhone = static::normalizeNumber($phone);

        if (empty($message)) {
            return "https://wa.me/{$normalizedPhone}";
        }

        $encodedMessage = rawurlencode($message);

        return "https://wa.me/{$normalizedPhone}?text={$encodedMessage}";
    }

    /**
     * Generate general inquiry URL for floating action button or navbar.
     */
    public static function generalInquiryUrl(?string $phone = null): string
    {
        $message = 'Halo Puja Tour Travel, saya ingin bertanya mengenai layanan paket wisata di Pangandaran.';

        return static::buildUrl($phone, $message);
    }

    /**
     * Generate package-specific booking/consultation URL.
     */
    public static function packageInquiryUrl(Package $package, ?string $phone = null): string
    {
        $packageUrl = route('packages.show', $package->slug);
        $message = "Halo Puja Tour Travel, saya tertarik dengan paket wisata \"{$package->name}\" ({$packageUrl}). Mohon info ketersediaan tanggal dan rincian perjalanannya.";

        return static::buildUrl($phone, $message);
    }

    /**
     * Generate quick chat URL for admin to contact customer directly.
     */
    public static function adminChatUrl(string $customerPhone, string $customerName): string
    {
        $message = "Halo {$customerName}, kami dari Puja Tour & Travel Pangandaran. Ada yang bisa kami bantu?";

        return static::buildUrl($customerPhone, $message);
    }
}
