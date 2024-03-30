<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Handle_Method_Requests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $typeMethod): Response
    {
        if (!$request->isMethod(trim($typeMethod))) {
            $data = [
                'status: ' => 'false',
                'message: ' => 'Method not allowed!!'
            ];
            return response($data, Response::HTTP_METHOD_NOT_ALLOWED);
        }
        // return response($request->isMethod(trim($typeMethod)));
        
        return $next($request);
    }
}
