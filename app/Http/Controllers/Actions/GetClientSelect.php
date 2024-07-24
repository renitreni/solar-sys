<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class GetClientSelect extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate(['_type' => 'required', 'q' => 'nullable']);
        $clients = Client::query()
            ->when(isset($validated['q']), function ($q) use ($validated) {
                $q->where('name', 'LIKE', "{$validated['q']}%");
            })->get()->map(function ($value) {
                return [
                    'id' => $value->id,
                    'text' => $value->name
                ];
            });

        return response()->json(['results' => $clients]);
    }
}
