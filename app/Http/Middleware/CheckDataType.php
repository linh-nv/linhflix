<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDataType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$rules): Response
    {
        try {
            $a = implode(",", $rules);
            $rulesArray = json_decode($a, true);
            $request->validate($rulesArray);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Xử lý lỗi và trả về phản hồi tùy chỉnh
            return response(['message' => 'Lỗi dữ liệu', 'errors' => $e->errors()], 422);
        }

        return $next($request);
    }
}
