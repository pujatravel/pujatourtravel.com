<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 50)->nullable()->unique()->after('name');
            $table->string('role', 30)->default('admin')->after('password');
            $table->boolean('is_active')->default(true)->after('role');
        });

        // 1. Package Categories
        Schema::create('package_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 120)->unique();
            $table->text('description')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Packages Master
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('package_categories')->nullOnDelete();
            $table->string('name', 150);
            $table->string('slug', 160)->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->string('currency', 10)->default('IDR');
            $table->string('price_unit', 30)->default('pax');
            $table->string('duration', 50)->nullable();
            $table->string('location', 150)->nullable();
            $table->string('image_url')->nullable();
            $table->boolean('featured')->default(false);
            $table->string('status', 30)->default('PUBLISHED'); // DRAFT, PUBLISHED, ARCHIVED
            $table->json('inclusions')->nullable();
            $table->json('exclusions')->nullable();
            $table->json('itinerary')->nullable();
            $table->string('seo_title', 150)->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // 3. Reservations
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('customer_name', 100);
            $table->string('customer_phone', 50);
            $table->string('customer_email', 100)->nullable();
            $table->foreignId('package_id')->nullable()->constrained('packages')->nullOnDelete();
            $table->string('package_name', 150);
            $table->date('travel_date')->nullable();
            $table->integer('pax_count')->default(1);
            $table->decimal('total_price', 15, 2)->default(0);
            $table->string('source', 50)->default('Website');
            $table->text('notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->string('status', 30)->default('PENDING'); // PENDING, DIPROSES, DIKONFIRMASI, SELESAI, DIBATALKAN
            $table->timestamps();
            $table->softDeletes();
        });

        // 4. Galleries
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('image_url');
            $table->string('category', 50)->default('Alam');
            $table->text('caption')->nullable();
            $table->boolean('is_published')->default(true);
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });

        // 5. Testimonials
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name', 100);
            $table->string('customer_city', 100)->nullable();
            $table->string('avatar_url')->nullable();
            $table->string('package_name', 150)->nullable();
            $table->integer('rating')->default(5);
            $table->text('review_text');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->date('trip_date')->nullable();
            $table->timestamps();
        });

        // 6. Settings
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key', 100)->unique();
            $table->text('value')->nullable();
            $table->string('group', 50)->default('general');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('packages');
        Schema::dropIfExists('package_categories');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'role', 'is_active']);
        });
    }
};
