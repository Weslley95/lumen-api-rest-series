<?php

namespace App\Providers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Auth\GenericUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function (Request $request) {
            //check if the application has authorization
            if (!$request->hasHeader('Authorization')) {
                return null;
            }

            $authorization = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorization);

            // Library JWT
            $dataAuthentication = JWT::decode($token, env('KEY_JWT'), ['HS256']);

            // User generic (email: usertest@email.com, password: password)
            // return new GenericUser(['email' => $dataAuthentication]);

            return User::where('email', $dataAuthentication->email)->first();
        });
    }
}
