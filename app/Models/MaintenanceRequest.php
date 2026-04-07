<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceRequest extends Model
{
    protected $table = 'maintenance_requests';
    protected $primaryKey = 'id';
    protected $fillable = [
        'unit_id',
        'tenant_id',
        'title',
        'description',
        'priority',
        'status',
        'submitted_at',
        'resolved_at',
        'estimated_cost',
        'actual_cost',
        'assigned_to'
    ];
    
    protected $casts = [
        'submitted_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];
    
    // Relationships
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
    
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}