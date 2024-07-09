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
        'job_service_order_url',
        'job_request_no',
        'job_no',
        'job_service_order_form',
        'job_status',
        'job_in_review',
        'job_estimated_completion',
        'job_estimated_completion_override',
        'job_date_received_formula',
        'job_date_due',
        'job_completed',
        'job_cancelled',
        'job_date_sent', // Sent to Client
        'job_client_name',
        'job_client_email',
        'job_client_email_override',
        'job_deliverables_email',
        'job_addtional_info', // Additional Information From Client
    ];
}
