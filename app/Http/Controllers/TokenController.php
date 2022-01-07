<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{

    public function generateToken(Request $request) {

        // Validation email and password user
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        // Case $user null and password user false, return error
        if(is_null($user) || !Hash::check($request->password, $user->password)) {

            // Status not authorized
            return response()->json('User or password invalid', '401');
        }

        $token = JWT::encode(['email' => $request->email], env('KEY_JWT'));

        return ['access_token' => $token];
    }
}
