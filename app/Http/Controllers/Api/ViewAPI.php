<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ViewAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $view = View::paginate(20);
        return $view;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        if(!empty($request)){
            $view = View::where($request->all())->orderBy('id', 'desc')->get();
            if(count($view) > 0){
                return count($view) > 20 ? View::where($request->all())->orderBy('id', 'desc')->paginate(20) : $view;
            }else{
                $data = [
                    'status: ' => 'false',
                    'message: ' => 'Không tìm thấy!!'
                ];
                return response($data, Response::HTTP_NOT_FOUND);
            }
        }else{
            $view = View::orderBy('id', 'desc')->paginate(20);
            return $view;
        }
    }
    public function create(Request $request)
    {
        // nếu có request dữ liệu
        if(!empty($request)){

            if (!$request->filled('id')) {
                            
                // Kiểm tra xem yêu cầu đã tồn tại trong bất kỳ movie nào chưa
                $existingView = View::where('movie_id', $request->movie_id)->where('view_date', now()->toDateString())->first();
                
                if ($existingView) {
                    // Trả về phản hồi báo lỗi phim đã tồn tại
                    $data = [
                        'status: ' => 'false',
                        'message: ' => 'Không thể thêm, dữ liệu đã tồn tại!!'
                    ];
                    return response($data, Response::HTTP_CONFLICT);
                } else {
                    // Nếu phim không tồn tại, thêm phim mới và trả về phản hồi thành công với status code 201
                    $newView = new View();
                    $newView->movie_id = $request->movie_id;
                    $newView->view_number = $request->view_number;
                    $newView->view_date = now()->toDateString();
                    $newView->save();

                    return response($newView, Response::HTTP_CREATED);
                }
            }else{
                $data = [
                    'status: ' => 'false',
                    'message: ' => 'Không nhập id và phải nhập đủ dữ liệu!!'
                ];
                return response($data, Response::HTTP_BAD_REQUEST);
            }
        }
        // nếu request không có dữ liệu
        else{
            $view = View::orderBy('id', 'desc')->paginate(20);

            return $view;
            // return $request;
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $view = view::where('id', $id)->get();

        if(!empty($view)){
            return $view;
        }else{
            $data = [
                'status: ' => 'false',
                'message: ' => 'Không tìm thấy dữ liệu!!'
            ];
            return response($data, Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        if($request->filled('id')){
            $data = [
                'status' => 'false',
                'message' => 'Không sửa id!!'
            ];
            return response($data, Response::HTTP_BAD_REQUEST);
        } else {
            if (!empty($request->all())){
                View::where('id', $id)->update($request->all());
                return View::where('id', $id)->first();
            } else {
                return View::where('id', $id)->first();
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $view = View::where('id', $id)->first();

        if(!empty($view)){
            $view->delete();
            return View::orderBy('id', 'desc')->paginate(20);
        }else{
            $data = [
                'status: ' => 'false',
                'message: ' => 'Không tìm thấy dữ liệu!!'
            ];
            return response($data, Response::HTTP_NOT_FOUND);
        }
    }
}
