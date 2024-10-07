<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class AccountController
{
    // Action to register user
    public function register(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:30|alpha_dash',
                'email' => 'required|string|email|max:50|unique:users',
                'password' => ['required', 'confirmed', Password::min(8)],
            ],
            [
                'password.c_alpha'=> "The password must contain at least one capital letter.",
                'password.s_alpha'=> "The password must contain at least one lowercase letter.",
                'password.must_int'=> "The password must contain at least one number.",
                'password.must_symbol'=> "The password must contain at least one special character.",
            ]
        );

        if($validator->fails()){
            return $validator->errors();
        }

        if(!$request->privacy_and_gtc_accepted){
            return response()->json(['message' => 'Privacy Policy and GTCs must be accepted.'], 400);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['success' => true], 200);
    }

}
