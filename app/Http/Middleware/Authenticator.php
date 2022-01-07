<?php

namespace App\Http\Middleware;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class Authenticator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, \Closure $next) {

        try {
            //check if the application has authorization
            if (!$request->hasHeader('Authorization')) {
                throw new \Exception();
            }

            $authorization = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorization);

            // Library JWT
            $dataAuthentication = JWT::decode($token, env('KEY_JWT'), ['HS256']);

            // User generic (email: usertest@email.com, password: password)
            // return new GenericUser(['email' => $dataAuthentication]);

            $user = User::where('email', $dataAuthentication->email)->first();

            if(is_null($user)) {
                throw new \Exception();
            }
            return $next($request);

        } catch (\Exception $e) {
            return response()->json('Unauthor', '401');
        }
    }
}
