<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'town_city',
        'region_county',
        'country_code',
        'post_code',
    ];

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return HasMany
     */
    public function notes(): HasMany
    {
        return $this->hasMany(ContactNote::Class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['name'] ?? null, function ($query, $searchName) {
            $query->where('first_name', 'like', '%'.$searchName.'%')
                  ->orWhere('last_name', 'like', '%'.$searchName.'%');
        })->when($filters['company'] ?? null, function ($query, $searchCompany) {
            $query->whereHas('company', function($q) use ($searchCompany) {
                $q->where('name', 'like', '%'.$searchCompany.'%');
            });
        });
    }
}
