<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutCustomerController extends Controller
{
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if ($request->user()) { // Check if a user is authenticated by Sanctum
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Successfully logged out']);
        }

        // If no user is authenticated (e.g., token already deleted or invalid),
        // still return a success-like response to avoid leaking information.
        return response()->json(['message' => 'Logout action completed.'], 200);
    }
}

