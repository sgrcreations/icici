<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IciciController extends Controller
{
    public function callback(Request $request)
    {
        $providedKey = $request->header('X-ICICI-Key') ?? $request->input('private_key') ?? $request->input('public_key') ?? $request->input('key');
        $expectedKey = config('services.icici.public_key');

        if (!$providedKey || $providedKey !== $expectedKey) {
            Log::warning('Unauthorized ICICI Callback attempt:', [
                'provided_key' => $providedKey,
                'ip' => $request->ip()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 401);
        }

        Log::info('ICICI Callback Received:', $request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Callback received successfully'
        ]);
    }
}
