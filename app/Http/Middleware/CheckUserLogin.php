<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $loggedin = $request -> session() -> get('loggedin');
        $isadmin = $request -> session() -> get('isadmin');
        if ($loggedin == "true" && $isadmin == 0) {
            return $next($request);
        } else {
            return redirect('/') -> with('status', 'unknow');
        }
    }
}
