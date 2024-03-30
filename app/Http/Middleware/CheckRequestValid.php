<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class CheckRequestValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $nameTable): Response
    {
         // Lấy tên các cột trong bảng Movie
         $tableColumns = Schema::getColumnListing($nameTable);

         // Lặp qua mảng quy tắc yêu cầu
         foreach ($request->all() as $key => $reqt) {
             // Bắt lỗi các trường nhập vào không tồn tại trong bảng
             if (!in_array($key, $tableColumns)) {
                 return response()->json(['error' => 'Not Exist Fields: ' . $key . ' does not exist in table ' . $nameTable], 400);
             }
         }

        return $next($request);
    }
}
