<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Folio extends Model
{
    use HasFactory;

    protected $table = 'folios';

    // 'balance' is omitted because it is a STORED GENERATED column in MySQL
    protected $fillable = [
        'folio_no',
        'reservation_id',
        'guest_id',
        'folio_type',
        'status',
        'total_charges',
        'total_payments',
        'opened_at',
        'closed_at',
    ];

    protected function casts(): array
    {
        return [
            'total_charges'  => 'decimal:2',
            'total_payments' => 'decimal:2',
            'balance'        => 'decimal:2',
            'opened_at'      => 'datetime',
            'closed_at'      => 'datetime',
        ];
    }

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class, 'guest_id', 'id');
    }

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class, 'reservation_id', 'id');
    }

    public function charges(): HasMany
    {
        return $this->hasMany(FolioCharge::class, 'folio_id', 'id');
    }
}
