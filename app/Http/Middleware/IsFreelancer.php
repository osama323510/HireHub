<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsFreelancer
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
            
            if ($request->user()?->freelancer && $request->user()->freelancer->is_verified) {
                return $next($request);
            }

            
            if ($request->expectsJson()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You must be a verified freelancer to access this page.',
                'code' => 'UNVERIFIED_FREELANCER' 
            ], 403);
        }
    }
}
