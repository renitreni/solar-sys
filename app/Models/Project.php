<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Laravel\Scout\Searchable;

class Project extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    public $searchVersion;

    protected $fillable = [
        // ProjectID INT PRIMARY KEY AUTO_INCREMENT,
        // PROJECT SECTION
        'client_id',
        'project_number', // unique
        'property_type',
        'property_owner_name',
        'property_address',
        'property_state',
        'property_city',
        'property_area_code',
        'wet_stamp_mailing_address',
        'wet_stamp_count',
        'shipping_number',
        'priority_level',
        // TASK SECTION
        'task_price_total',
        'commercial_job_price',
        'task_total',
        // RFI
        'rfi_messages',
    ];

    public function toSearchableArray(): array
    {
        return ['property_address' => $this->property_address];
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function projectJob()
    {
        return $this->hasOne(ProjectJob::class);
    }
}
