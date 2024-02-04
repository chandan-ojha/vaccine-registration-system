<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Exception;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function register(Request $request)
    {
        $vaccineCenter = Center::query()
            ->firstWhere('name', 'like', "%{$request->input('vaccine_center')}%");

        if (!$vaccineCenter) {
            return response()->json(
                [
                    'error' => 'Vaccine center not found'
                ], 404);
        }

        try {
            return $vaccineCenter->vaccinations()->create($request->except('vaccine_center'));
        } catch (Exception $e) {
            return response()->json(
                [
                    'error' => 'Failed to create vaccination record: ' . $e->getMessage()
                ], 500);
        }
    }

}
