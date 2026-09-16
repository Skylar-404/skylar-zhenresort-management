<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    /**
     * Non-standard singular table name.
     */
    protected $table = 'reservation';

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'reservation_no',
        'guest_id',
        'room_id',
        'check_in_date',
        'check_out_date',
        'actual_check_in_at',
        'actual_check_out_at',
        'nightly_rate',
        'status',
        'booking_source',
        'adults_count',
        'children_count',
        'special_instructions',
        'created_by',
    ];

    /**
     * Cast attributes to native types.
     */
    protected function casts(): array
    {
        return [
            'check_in_date'       => 'date',
            'check_out_date'      => 'date',
            'actual_check_in_at'  => 'datetime',
            'actual_check_out_at' => 'datetime',
            'nightly_rate'        => 'decimal:2',
            'adults_count'        => 'integer',
            'children_count'      => 'integer',
        ];
    }

    /**
     * Relationship: The guest who booked the stay.
     */
    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class, 'guest_id', 'id');
    }

    /**
     * Relationship: The allocated villa room.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    /**
     * Relationship: The staff user who entered the reservation.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
