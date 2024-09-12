<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectJob extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        // JOB SECTION
        'project_id',
        'job_name', // JobName VARCHAR(255),
        'service_order_url',
        'request_no',
        'job_no',
        'service_order_form',
        'job_status',
        'in_review',
        'estimated_completion',
        'estimated_completion_override',
        'date_received_formula',
        'date_due',
        'date_completed',
        'date_sent', // Sent to Client
        'client_name',
        'client_email',
        'client_email_override',
        'deliverables_email',
        'additional_info', // Additional Information From Client
    ];
}
