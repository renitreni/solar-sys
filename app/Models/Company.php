<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Company extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    protected $fillable = [
        'company_name',
    ];

    public function toSearchableArray(): array
    {
        return ['company_name' => $this->company_name];
    }
}
