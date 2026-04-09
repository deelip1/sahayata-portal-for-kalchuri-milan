<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SahayataMember extends Model
{
    use HasFactory;

    protected $table = 'sahayata_members';

    protected $fillable = [
        'name',
        'mobile',
        'email',
        'district',
        'occupation',
        'status',
        'joined_at',
        'metadata',
    ];

    protected $casts = [
        'joined_at' => 'date',
        'metadata' => 'array',
    ];

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
                ->orWhere('district', 'like', "%{$term}%")
                ->orWhere('mobile', 'like', "%{$term}%");
        });
    }
}
