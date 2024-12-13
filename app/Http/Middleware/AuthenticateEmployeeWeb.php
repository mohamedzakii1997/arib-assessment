<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthenticateEmployeeWeb
{
    public function handle($request, Closure $next)
    {
        $token = Session::get('user');

        if (!$token) {
            return redirect()->route('login')->withErrors(['auth' => 'You need to log in first.']);
        }



        $user = auth('web')->user();

        if ($user->role !== 'employee'){

            return redirect()->route('unauthorized')->withErrors(['auth' => 'You do not have access to this resource.']);

        }

        return $next($request);
    }
}
