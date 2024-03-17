<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is logged in before they access the page
        // If not redirect back to the login page
        if(!Session()->has('loggedInUserID'))
        {
            return redirect('/')->with('fail', 'You have to login first!');
        }

        return $next($request);
    }
}
