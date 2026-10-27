<?php

use App\Enums\ProductCategory;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Otomatisasi pemetaan produk lama ke 7 master kategori baru
        $products = Product::all();

        foreach ($products as $product) {
            $newCategory = ProductCategory::matchCategoryByName($product->nama_produk);
            $product->update([
                'kategori' => $newCategory,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No rollback needed as categories are updated in-place
    }
};
