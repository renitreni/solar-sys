<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        // ProjectID INT PRIMARY KEY AUTO_INCREMENT,
       'job_name', // JobName VARCHAR(255),
        // ClientID INT,
       'project_number', // ProjectNumber VARCHAR(255),
        // PropertyTypeID INT,
        // PropertyOwnerName VARCHAR(255),
        // PropertyAddressID INT,
        // MailingAddress VARCHAR(255),
        // NumberOfWetStamps INT,
        // ShippingNumber VARCHAR(255)
    ];
}
