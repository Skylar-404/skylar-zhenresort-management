<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $table = 'room';

    protected $fillable = [
        'room_number',
        'room_type',
        'capacity',
        'price_per_night',
        'status',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'capacity'        => 'integer',
            'price_per_night' => 'decimal:2',
        ];
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'room_id', 'id');
    }

    public function maintenanceTickets(): HasMany
    {
        return $this->hasMany(Maintenance::class, 'room_id', 'id');
    }
}
