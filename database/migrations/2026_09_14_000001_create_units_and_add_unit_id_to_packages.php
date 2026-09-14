<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Create units table
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 120)->unique();
            $table->text('description')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Add unit_id to packages table
        Schema::table('packages', function (Blueprint $table) {
            $table->foreignId('unit_id')->nullable()->after('price_unit')->constrained('units')->nullOnDelete();
        });

        // 3. Seed default units
        $defaultUnits = [
            ['name' => 'Pax', 'slug' => 'pax', 'description' => 'Satuan per orang (pax standard tur wisata)', 'display_order' => 1, 'is_active' => true],
            ['name' => 'Orang', 'slug' => 'orang', 'description' => 'Satuan per individu peserta', 'display_order' => 2, 'is_active' => true],
            ['name' => 'Rombongan', 'slug' => 'rombongan', 'description' => 'Satuan per kelompok / rombongan rombongan besar', 'display_order' => 3, 'is_active' => true],
            ['name' => 'Grup', 'slug' => 'grup', 'description' => 'Satuan per grup keluarga atau korporat', 'display_order' => 4, 'is_active' => true],
            ['name' => 'Paket', 'slug' => 'paket', 'description' => 'Satuan per satu paket all-in', 'display_order' => 5, 'is_active' => true],
        ];

        $now = now();
        foreach ($defaultUnits as $unit) {
            $id = DB::table('units')->insertGetId([
                'name' => $unit['name'],
                'slug' => $unit['slug'],
                'description' => $unit['description'],
                'display_order' => $unit['display_order'],
                'is_active' => $unit['is_active'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            // Link existing packages with matching price_unit or default to first unit
            DB::table('packages')
                ->where('price_unit', 'like', $unit['slug'])
                ->orWhere('price_unit', 'like', $unit['name'])
                ->update(['unit_id' => $id]);
        }

        // Set any remaining packages without unit_id to the 'Pax' unit
        $defaultUnitId = DB::table('units')->where('slug', 'pax')->value('id');
        if ($defaultUnitId) {
            DB::table('packages')->whereNull('unit_id')->update(['unit_id' => $defaultUnitId]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropForeign(['unit_id']);
            $table->dropColumn('unit_id');
        });

        Schema::dropIfExists('units');
    }
};
