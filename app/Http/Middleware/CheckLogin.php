<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $loggedin = $request -> session() -> get('loggedin');
        if ($loggedin == "true") {
            return $next($request);
        } else {
            return redirect('/admin') -> with('status', 'unknow');
        }

    }
}
