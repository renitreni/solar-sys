<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'service_id',
        'project_id',
        'price',
        'other_description',
        'is_new_task',
        'is_new_task_override',
        'price_override',
        'price_total',
        'expense_override',
        'expense_total',
        'design_revision_scope',
        'new_storage_design',
        'notes',
        'task_status',
        'date_completed',
        'date_cancelled',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
