<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    // Sign Up
    public function signUp(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'nullable|integer',
            'image'=> 'required'
        ]);
        

        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'image' => $request->image,

        ]);


       // طريقة لرفع الصورة وتخزينها في الباك
       /* if($req-> hasFile('image'))
        {
            
            $file = $req-> file('image');
            $ext = $file-> getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file -> move('assets/uploads',$filename);
            $user->image = $filename;
        }
         */

         $token = $user->createToken('AuthToken')->plainTextToken;

         return response()->json([
             'message' => 'User registered successfully',
             'user' => $user,
             'token' => $token
         ]);
        
        }

    // Sign In
    public function signIn(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('AuthToken')->plainTextToken;
            return response()->json([
                'message' => 'Sign in successful',
                'user' => $user,
                'token' => $token
            ]);
        } 
        else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

}
