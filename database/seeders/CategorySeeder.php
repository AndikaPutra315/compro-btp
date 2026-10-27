<?php

namespace Database\Seeders;

use App\Enums\ProductCategory;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Mengatur master kategori dan melakukan recategorize produk lama secara otomatis.
     */
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            $newCategory = ProductCategory::matchCategoryByName($product->nama_produk);
            $product->update([
                'kategori' => $newCategory,
            ]);
        }
    }
}
