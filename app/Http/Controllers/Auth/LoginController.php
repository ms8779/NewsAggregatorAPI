<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Login Action
    public function login(Request $request)
    {
        // Validating Request
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ],[
            'email.required' => 'Email required',
            'password.required' => 'Password required',
        ]);

        $user = User::where('email', $request->email)->first();

        // Checking credentials
        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('-AuthToken')->plainTextToken;

            // Success response on correct credentials
            return response()->json([
                "success" => true,
                'access_token' => $token,
            ], Response::HTTP_OK);

        }
        // Unauthorized response on wrong credentials
        return response()->json([
            "success" => false,
        ], Response::HTTP_UNAUTHORIZED);
    }
}
