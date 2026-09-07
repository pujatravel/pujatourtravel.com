<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['errors.*', 'errors::*'], function ($view): void {
            try {
                $settings = Setting::all()->pluck('value', 'key');
            } catch (\Throwable) {
                $settings = collect();
            }

            $view->with([
                'settings' => $settings,
                'waNum' => $settings['whatsapp_number'] ?? '6281234567890',
                'phoneNum' => $settings['phone_number'] ?? '+62 812-3456-7890',
                'emailAddr' => $settings['email_address'] ?? 'info@pujatourtravel.com',
                'officeAddr' => $settings['office_address'] ?? 'Jl. Pantai Barat No. 88, Pangandaran, Jawa Barat 46396',
            ]);
        });
    }
}
