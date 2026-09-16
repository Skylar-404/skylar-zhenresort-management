<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Maintenance extends Model
{
    use HasFactory;

    /**
     * Non-standard singular table name.
     */
    protected $table = 'maintenance';

    protected $fillable = [
        'room_id',
        'reported_by',
        'assigned_to',
        'issue_title',
        'description',
        'priority',
        'status',
        'cost',
        'started_at',
        'resolved_at',
    ];

    protected function casts(): array
    {
        return [
            'cost'        => 'decimal:2',
            'started_at'  => 'datetime',
            'resolved_at' => 'datetime',
        ];
    }

    /**
     * Relationship: The room undergoing maintenance.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    /**
     * Relationship: The staff user who reported the issue.
     */
    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reported_by', 'id');
    }

    /**
     * Relationship: The technician user assigned to repair.
     */
    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }
}
