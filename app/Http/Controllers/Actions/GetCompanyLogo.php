<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Models\GlobalParameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GetCompanyLogo extends Controller
{
    public function __invoke()
    {
        $path = app(GlobalParameter::class)->getCompanyLogo();

        return Storage::get($path) ?? Storage::disk('public')->get(config('app.company-logo'));
    }
}
