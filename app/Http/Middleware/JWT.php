<?php

namespace App\Http\Middleware;
use JWTAuth;
use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if($user = JWTAuth::parseToken()->authenticate())
            return $next($request);
        else
            throw new JWTException;
    }
}
