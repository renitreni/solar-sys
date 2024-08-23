<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    public $fillable = [
        'document_path',
        'document_type',
        'document_size',
        'document_url',
        'bucket_name',
        'object_name'
    ];

    public function documentable()
    {
        return $this->morphTo();
    }
}
