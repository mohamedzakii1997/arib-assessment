<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthenticateManagerWeb
{
public function handle($request, Closure $next)
{
    $token = Session::get('user');

    if (!$token) {
        return redirect()->route('login')->withErrors(['auth' => 'You need to log in first.']);
    }

    $user = auth()->user();

    if ($user->role !== 'manager'){

        return redirect()->route('unauthorized')->withErrors(['auth' => 'You do not have access to this resource.']);

    }

return $next($request);
}
}
