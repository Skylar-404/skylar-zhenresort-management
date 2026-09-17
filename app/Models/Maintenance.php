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
        'work_order_no',
        'reported_by',
        'assigned_to',
        'category',
        'priority',
        'status',
        'room_status_on_report',
        'description',
        'resolution_notes',
        'scheduled_date',
        'resolved_at',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_date' => 'date',
            'resolved_at'    => 'datetime',
            'created_at'     => 'datetime',
            'updated_at'     => 'datetime',
        ];
    }

    /**
     * Virtual accessor for issue_title
     */
    public function getIssueTitleAttribute(): string
    {
        return $this->category ?? 'Maintenance Request';
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
