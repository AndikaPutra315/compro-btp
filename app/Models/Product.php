<?php

namespace App\Models;

use App\Enums\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Product extends Model
{
    protected $fillable = ['nama_produk', 'kategori', 'gambar', 'gambar_2'];

    /**
     * Get all available categories dynamically from Category model,
     * with fallback to ProductCategory enum if table is empty or unmigrated.
     *
     * @return array<string>
     */
    public static function getCategories(): array
    {
        try {
            if (Schema::hasTable('categories')) {
                $categories = Category::orderBy('urutan')->orderBy('nama')->pluck('nama')->toArray();
                if (!empty($categories)) {
                    return $categories;
                }
            }
        } catch (\Throwable $e) {
            // Fallback gracefully if any database issue
        }

        return ProductCategory::values();
    }

    /**
     * Relationship to Category model.
     */
    public function categoryRel()
    {
        return $this->belongsTo(Category::class, 'kategori', 'nama');
    }

    /**
     * Get array of all image URLs for this product.
     *
     * @return array<string>
     */
    public function getImagesList(): array
    {
        $list = [];
        if (!empty($this->gambar)) {
            $list[] = asset('storage/' . $this->gambar);
        }
        if (!empty($this->gambar_2)) {
            $list[] = asset('storage/' . $this->gambar_2);
        }
        return $list;
    }
}


