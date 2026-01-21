<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Log user in. Validate credentials and issue token.
     *
     * @param Request The HTTP request body.
     * @return string Returns the response with token in JSON format.
     */
    public function login(Request $request)
    {
        //  Validate input.
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        //  Validate user exists and passwords match.
        $user = User::where('email', $credentials['email'])->first();
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        //  Generate and return token.
        $token = $user->createToken('api')->plainTextToken;
        return response()->json([
            'token' => $token,
        ]);
    }
}
