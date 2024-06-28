<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GlobalParameter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['param_name', 'param_value'];

    public function getCompanyLogo()
    {
        return $this->where('param_name', 'company-logo')
            ->first('param_value')
            ->param_value ?? config('app.company-logo');
    }
}
