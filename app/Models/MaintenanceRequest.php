<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceRequest extends Model
{
    protected $fillable = [
        'request_number', 'property_id', 'tenant_id', 'unit_number',
        'issue_type', 'priority', 'description', 'reported_date',
        'assigned_to', 'status', 'completed_date', 'cost'
    ];

    protected $casts = [
        'reported_date' => 'date',
        'completed_date' => 'date',
        'cost' => 'decimal:2',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    // Generate unique request number automatically
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($request) {
            if (!$request->request_number) {
                $latest = self::max('id') + 1;
                $request->request_number = 'MR-' . str_pad($latest, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    // Accessors for badges
    public function getPriorityBadgeAttribute()
    {
        $classes = [
            'urgent' => 'priority-urgent',
            'high'   => 'priority-high',
            'medium' => 'priority-medium',
            'low'    => 'priority-low'
        ];
        $class = $classes[$this->priority] ?? 'priority-medium';
        return "<span class='{$class}'>" . ucfirst($this->priority) . "</span>";
    }

    public function getStatusBadgeAttribute()
    {
        $map = [
            'open'         => 'badge-open',
            'in-progress'  => 'badge-progress',
            'review'       => 'badge-review',
            'completed'    => 'badge-completed',
            'cancelled'    => 'badge-cancelled'
        ];
        $label = [
            'open' => 'Open',
            'in-progress' => 'In Progress',
            'review' => 'Under Review',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled'
        ];
        $class = $map[$this->status] ?? 'badge-open';
        return "<span class='badge {$class}'>" . $label[$this->status] . "</span>";
    }
}