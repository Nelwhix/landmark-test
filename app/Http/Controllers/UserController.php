<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function store(Request $request) {
      $request->validate([
          'name' => 'required|string',
          'email' => 'required|email|unique:users',
          'password' => 'required|confirmed'
      ]);

      $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

      return response([
          'message' => "signup success",
          'user' => $user
      ]);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'User not Found'
            ], 404);
        }

        $token = $user->createToken('access_token')->plainTextToken;

        return response([
            'message' => 'successful',
            'token' => $token
        ]);


    }
}