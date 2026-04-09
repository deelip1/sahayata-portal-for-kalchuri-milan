<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SahayataTeam extends Model
{
    use HasFactory;

    protected $table = 'sahayata_team';

    protected $fillable = [
        'name',
        'designation',
        'photo',
        'mobile',
        'email',
        'district',
        'bio',
        'joining_date',
        'status',
        'contact_visible',
        'metadata',
    ];

    protected $casts = [
        'joining_date' => 'date',
        'contact_visible' => 'boolean',
        'metadata' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
                ->orWhere('district', 'like', "%{$term}%")
                ->orWhere('designation', 'like', "%{$term}%");
        });
    }
}
