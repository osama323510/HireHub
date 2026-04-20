<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Api_endpoint;
class watchRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $startTime = microtime(true);


        $response = $next($request);


        $duration = round((microtime(true) - $startTime) * 1000, 2);

        $user = auth('sanctum')->user();

        Api_endpoint::create([
        'user_id'=>$user?->id ,
        'type'=>($user) ? 'user':'guest',
        'endpoint'=>$request->fullUrl(),
        'method'=>$request->method(),
        'duration'=>$duration,
        ]);
        
        return $response;
    }
}
