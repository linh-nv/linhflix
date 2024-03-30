<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class CheckRequiredFields
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$rules): Response
    {
        // Tạo một mảng để chứa các trường còn thiếu trong request
        $missingFields = [];

        foreach ($rules as $rule) {
            // Kiểm tra xem trường có tồn tại trong request hay không
            if (!$request->has(trim($rule))) {
                $missingFields[] = $rule;
            }
        }
        // // Thông báo lỗi các trường thiếu
        if (!empty($missingFields)) {
            return response()->json(['error' => 'Missing Fields: ' . implode(', ', $missingFields)], 400);
        }
        
            // return response()->json($rules);
        return $next($request);
    }
}
