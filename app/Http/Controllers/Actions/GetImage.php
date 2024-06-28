<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GetImage extends Controller
{
    public function __invoke(Request $request)
    {
        return Storage::get($request->path) ?? Storage::disk('public')->get($request->path);
    }
}
