<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyOwner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'property_owner_name'
    ];
}
