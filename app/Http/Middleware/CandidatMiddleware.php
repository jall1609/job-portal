<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CandidatMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if( empty(auth()->user()) && auth()->user()->hasRole('candidat') == false) {
            return sendResponse(403, null, 'You do not have permission to access this resource.' );
        }
        return $next($request);
    }
}
