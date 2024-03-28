<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Handle_Get_Requests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->isMethod('get')) {
            $data = [
                'status: ' => 'false',
                'message: ' => 'Method not allowed!!'
            ];
            return response($data, Response::HTTP_METHOD_NOT_ALLOWED);
        }
        
        return $next($request);
    }
}
