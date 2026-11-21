<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'jabatan',
        'nama',
        'urutan',
        'parent_id',
    ];

    /** Children of this node */
    public function children()
    {
        return $this->hasMany(OrganizationMember::class, 'parent_id')->orderBy('urutan')->orderBy('id');
    }

    /** Parent of this node */
    public function parent()
    {
        return $this->belongsTo(OrganizationMember::class, 'parent_id');
    }
}
