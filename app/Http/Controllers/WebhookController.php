<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function register(Request $request)
    {
        $vaccineCenter = Center::query()->firstWhere('name', 'like', "%{$request->input('vaccine_center')}%");

        return $vaccineCenter->vaccinations()->create($request->except('vaccine_center'));
    }

}
