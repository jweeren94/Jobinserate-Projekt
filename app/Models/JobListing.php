<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    /** @use HasFactory<\Database\Factories\JobListingFactory> */
    use HasFactory;

    public function company() {
        return $this->belongsTo(Company::class);
    }

    protected $fillable = [
    'title',
    'description',
    'location',
    'employment_type',
    'expires_at',
    'is_published',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'date',
        ];
    }
}
