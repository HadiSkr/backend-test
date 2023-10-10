<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomersController extends Controller
{
    public function customer_signup(Request $request)
{
    $validated = $request->validate([
        'name' => 'required',
        'city' => 'required',
        'phone' => 'required|unique:customers',
        'email' => 'required|email|unique:customers',
        'password' => 'required|min:6',
        'service_id' => 'required|exists:services,id',
        'specific_service_id' => 'required|exists:specific_services,id',
        'bank_name'=> 'required|string',
        'bank_number'=> 'required|integer',
        'image' => 'string',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
    ]);

    $validated['password'] = Hash::make($validated['password']);

    $customer = customers::create($validated);

    $token = $customer->createToken('CustomerToken')->plainTextToken;

    return response()->json([
        'message' => 'Customer registered successfully',
        'customer' => $customer,
        'token' => $token,
    ], 201);
}

    public function customer_signin(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the customer
        if (Auth::guard('customers')->attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
            $customer = Auth::guard('customers')->user();

            if ($customer->status !== 'approved') {
                Auth::guard('customers')->logout();
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            
            $token = $customer->createToken('CustomerToken')->plainTextToken;

            return response()->json([
                'message' => 'Customer authenticated successfully',
                'customer' => $customer,
                'token' => $token,
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }


}
