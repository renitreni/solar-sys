<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAsignee extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'assignee_name',
        'assigned_to',
    ];
}
