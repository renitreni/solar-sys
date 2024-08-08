<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Client extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'address',
        'contact_no',
    ];

    public function toSearchableArray(): array
    {
        return ['name' => $this->name];
    }
}
