<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\UserProvider;

class CustomUserProvider extends UserProvider
{
    public function validateCredentials(UserContract $user, array $credentials)
    {
       $plain = $credentials['user_password'];

       return (md5($plain) == $user->getAuthPassword());
    }
}
