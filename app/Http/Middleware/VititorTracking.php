<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class VititorTracking
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $visitors = Cache::get('visitors', []);
        if(count($request->all()) > 0){
            array_push($visitors, $request->all());
        }
        Cache::put('visitors', $visitors);
        return $next($request);
    }
}
