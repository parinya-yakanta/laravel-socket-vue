<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*') // กำหนดให้อนุญาตทุกโดเมน
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS') // กำหนด HTTP methods ที่อนุญาต
            ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Requested-With'); // กำหนด HTTP headers ที่อนุญาต
    }
}
