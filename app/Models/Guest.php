<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     */
    protected $table = 'guests';

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'identification_type',
        'identification_no',
        'country_code',
        'address',
        'city',
        'vip_status',
        'special_requests',
        'is_active',
    ];

    /**
     * Cast attributes to native types.
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Full name accessor.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Relationship: Reservations made by this guest.
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'guest_id', 'id');
    }
}
