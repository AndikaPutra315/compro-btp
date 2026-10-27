<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'urutan',
    ];

    /**
     * Boot the model and handle slug generation if empty.
     */
    protected static function booted()
    {
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = static::generateUniqueSlug($category->nama);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('nama') && !$category->isDirty('slug')) {
                $category->slug = static::generateUniqueSlug($category->nama, $category->id);
            }
        });
    }

    /**
     * Relationship with Product model using 'kategori' column as foreign key.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'kategori', 'nama');
    }

    /**
     * Generate unique slug for category.
     */
    public static function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name) ?: 'kategori';
        $slug = $baseSlug;
        $counter = 1;

        while (static::where('slug', $slug)->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
