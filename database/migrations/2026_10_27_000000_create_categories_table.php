<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Enums\ProductCategory;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // Seed initial categories from existing enums and products table
        $existingCategories = [];
        if (Schema::hasTable('products')) {
            $existingCategories = DB::table('products')
                ->whereNotNull('kategori')
                ->where('kategori', '!=', '')
                ->distinct()
                ->pluck('kategori')
                ->toArray();
        }

        $allCategories = array_unique(array_merge(ProductCategory::values(), $existingCategories));

        $order = 1;
        foreach ($allCategories as $categoryName) {
            $categoryName = trim($categoryName);
            if (empty($categoryName)) {
                continue;
            }

            $baseSlug = Str::slug($categoryName);
            $slug = $baseSlug ?: 'kategori-' . $order;

            DB::table('categories')->insertOrIgnore([
                'nama'       => $categoryName,
                'slug'       => $slug,
                'deskripsi'  => null,
                'urutan'     => $order++,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
