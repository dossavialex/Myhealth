<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class RememberMe
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Cookie::has('remember_token')) {
            $userId = Cookie::get('remember_token');
            $user = User::find($userId);

            // Si un utilisateur est trouvé avec cet ID, on l'authentifie
            if ($user) {
                Auth::login($user);
            }
        }

        return $next($request);
    }
}
