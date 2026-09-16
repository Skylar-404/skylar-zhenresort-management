<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FolioCharge extends Model
{
    use HasFactory;

    // Disabled default timestamps because this table uses custom 'posted_at'
    public $timestamps = false;

    protected $table = 'folio_charges';

    protected $fillable = [
        'charge_no',
        'folio_id',
        'service_category',
        'food_service_order_id',
        'item_description',
        'unit_price',
        'quantity',
        'tax_amount',
        'total_amount',
        'is_voided',
        'posted_by',
        'posted_at',
    ];

    protected function casts(): array
    {
        return [
            'unit_price'   => 'decimal:2',
            'quantity'     => 'integer',
            'tax_amount'   => 'decimal:2',
            'total_amount' => 'decimal:2',
            'is_voided'    => 'boolean',
            'posted_at'    => 'datetime',
        ];
    }

    public function folio(): BelongsTo
    {
        return $this->belongsTo(Folio::class, 'folio_id', 'id');
    }

    public function postedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'posted_by', 'id');
    }
}
