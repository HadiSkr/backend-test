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
            'general_service' => 'required',
            'bank_name'=> 'required|string',
            'bank_number'=> 'required|integer',
            'specific_service' => 'required',
            //'image' => 'image|mimes:jpeg,png,jpg|max:2048', // Example validation for image upload
            'image' => 'string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);
                 
        // طريقة لرفع الصورة وتخزينها في الباك
        /*if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validated['image'] = $imageName;
        }
       */
        $validated['password'] = Hash::make($validated['password']);

        

        $customer = customers::create($validated);

        $token = $customer->createToken('CustomerToken')->plainTextToken; # token

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
