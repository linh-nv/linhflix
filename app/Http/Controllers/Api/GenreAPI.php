<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class GenreAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genre = Genre::orderBy('id', 'desc')->paginate(20);
        return $genre;
    }

    /*
    * Search
    */
    public function store(Request $request){
        if(!empty($request)){
            $genre = Genre::where($request->all())->orderBy('id', 'desc')->get();
            if(count($genre) > 0){
                return count($genre) > 20 ? Genre::where($request->all())->orderBy('id', 'desc')->paginate(20) : $genre;
            }else{
                $data = [
                    'status: ' => 'false',
                    'message: ' => 'Không tìm thấy!!'
                ];
                return response($data, Response::HTTP_NOT_FOUND);
            }
        }else{
            $genre = Genre::orderBy('id', 'desc')->paginate(20);
            return $genre;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        // nếu có request dữ liệu
        if(!empty($request)){

            if (!$request->filled('id')) {
                            
                // Kiểm tra xem yêu cầu đã tồn tại trong bất kỳ Genre nào chưa
                $existingGenre = Genre::where('slug', $request->slug)->first();
                
                if ($existingGenre) {
                    // Trả về phản hồi báo lỗi danh mục đã tồn tại
                    $data = [
                        'status: ' => 'false',
                        'message: ' => 'Không thể thêm, dữ liệu đã tồn tại!!'
                    ];
                    return response($data, Response::HTTP_CONFLICT);
                } else {
                    // Nếu danh mục không tồn tại, thêm danh mục mới và trả về phản hồi thành công với status code 201
                    $newGenre = new Genre();
                    $newGenre->slug = $request->slug;
                    $newGenre->title = $request->title;
                    $newGenre->description = $request->description;
                    $newGenre->status = $request->status;
                    $newGenre->save();

                    return response($newGenre, Response::HTTP_CREATED);
                }
            }else{
                $data = [
                    'status: ' => 'false',
                    'message: ' => 'Không nhập id!!'
                ];
                return response($data, Response::HTTP_BAD_REQUEST);
            }
        }
        // nếu request không có dữ liệu
        else{
            $genre = Genre::orderBy('id', 'desc')->paginate(20);

            return $genre;
            // return $request;
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $genre = Genre::where('id', $id)->first();

        if(!empty($genre)){
            return $genre;
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
                'status: ' => 'false',
                'message: ' => 'Không sửa id!!'
            ];
            return response($data, Response::HTTP_BAD_REQUEST);
        }else{
            if (!empty($request->all())){
                if ($request->filled('slug')) {
                    $genre = Genre::where('slug', $request->slug)->first();
                    if(empty($genre)){
                        Genre::where('id', $id)->update($request->all());
                        return Genre::where('id', $id)->first();
                    }else{
                        $data = [
                            'status: ' => 'false',
                            'message: ' => 'Không thể thêm, dữ liệu đã tồn tại!!'
                        ];
                        return response($data, Response::HTTP_CONFLICT);
                    }
                }else{
                    Genre::where('id', $id)->update($request->all());
                    return Genre::where('id', $id)->first();
                }
            }else{
                return Genre::where('id', $id)->first();
            }
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $genre = Genre::where('id', $id)->first();

        if(!empty($genre)){
            $genre->delete();
            return Genre::orderBy('id', 'desc')->paginate(20);
        }else{
            $data = [
                'status: ' => 'false',
                'message: ' => 'Không tìm thấy dữ liệu!!'
            ];
            return response($data, Response::HTTP_NOT_FOUND);
        }
    }
}
