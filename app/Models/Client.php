<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_perusahaan',
        'logo',
        'urutan',
    ];

    /**
     * Scope query to order by sequence.
     */
    protected static function booted()
    {
        static::addGlobalScope('ordered', function ($builder) {
            $builder->orderBy('urutan')->orderBy('id');
        });
    }

    /**
     * Get the logo URL or fallback to the placeholder.
     */
    public function getLogoUrlAttribute(): string
    {
        if ($this->logo) {
            if (Storage::disk('public')->exists($this->logo)) {
                return asset('storage/' . $this->logo);
            }
            // In case it's an external url or already stored with full path
            if (str_starts_with($this->logo, 'http://') || str_starts_with($this->logo, 'https://')) {
                return $this->logo;
            }
        }

        return asset('images/client-placeholder.svg');
    }
}
