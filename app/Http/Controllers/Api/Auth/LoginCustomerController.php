<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; // Add this line

class LoginCustomerController extends Controller
{
    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $customer = Customer::where('email', $request->email)->first();

        if (! $customer || ! Hash::check($request->password, $customer->password)) {
            return response()->json(['message' => 'Invalid login details'], 401);
        }

        // Revoke all old tokens for this customer to ensure only one active session if desired
        // $customer->tokens()->delete();

        $token = $customer->createToken('api-token')->plainTextToken; // Removed 'role:customer' ability

        return response()->json([
            'message' => 'Customer logged in successfully2.',
            'customer' => $customer->only(['id', 'name', 'email']),
            'token' => $token,
        ]);
    }
}
