<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class MovieAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movie = Movie::with('episode')->orderBy('id', 'desc')->paginate(20);
        return $movie;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        if(!empty($request)){
            $movie = Movie::with('episode')->where($request->all())->orderBy('id', 'desc')->get();
            if(count($movie) > 0){
                return count($movie) > 20 ? Movie::with('episode')->where($request->all())->orderBy('id', 'desc')->paginate(20) : $movie;
            }else{
                $data = [
                    'status: ' => 'false',
                    'message: ' => 'Không tìm thấy!!'
                ];
                return response($data, Response::HTTP_NOT_FOUND);
            }
        }else{
            $movie = Movie::with('episode')->orderBy('id', 'desc')->paginate(20);
            return $movie;
        }
    }
    public function create(Request $request)
    {
        // nếu có request dữ liệu
        if(!empty($request)){

            if ($request->filled(['slug', 'title', 'name_eng', 'year', 'image', 'poster']) && !$request->filled('id')) {
                            
                // Kiểm tra xem yêu cầu đã tồn tại trong bất kỳ movie nào chưa
                $existingMovie = Movie::where('slug', $request->slug)->first();
                
                if ($existingMovie) {
                    // Trả về phản hồi báo lỗi phim đã tồn tại
                    $data = [
                        'status: ' => 'false',
                        'message: ' => 'Không thể thêm, dữ liệu đã tồn tại!!'
                    ];
                    return response($data, Response::HTTP_CONFLICT);
                } else {
                    // Nếu phim không tồn tại, thêm phim mới và trả về phản hồi thành công với status code 201
                    $newMovie = new Movie();
                    $newMovie->slug = $request->slug;
                    $newMovie->title = $request->title;
                    $newMovie->name_eng = $request->name_eng;
                    $newMovie->year = $request->year;
                    $newMovie->image = $request->image;
                    $newMovie->poster = $request->poster;
                    $newMovie->save();

                    return response($newMovie, Response::HTTP_CREATED);
                }
            }else{
                $data = [
                    'status: ' => 'false',
                    'message: ' => 'Không nhập id và phải nhập đủ slug, title, name_eng, year, image, poster!!'
                ];
                return response($data, Response::HTTP_BAD_REQUEST);
            }
        }
        // nếu request không có dữ liệu
        else{
            $movie = Movie::with('episode')->orderBy('id', 'desc')->paginate(20);

            return $movie;
            // return $request;
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Movie::with('episode')->where('id', $id)->first();

        if(!empty($movie)){
            return $movie;
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
        
        try {
            $rules = [
                'year' => 'integer',
                'category_id' => 'integer',
                'genre_id' => 'integer',
                'country_id' => 'integer',
                'view' => 'integer',
            ];
            $request->validate($rules);
            if($request->filled('id')){
                $data = [
                    'status: ' => 'false',
                    'message: ' => 'Không sửa id!!'
                ];
                return response($data, Response::HTTP_BAD_REQUEST);
            }else{
                if (!empty($request->all())){
                    if ($request->filled('slug')) {
                        $movie = Movie::where('slug', $request->slug)->first();
                        if(empty($movie)){
                            Movie::where('id', $id)->update($request->all());
                            return Movie::with('episode')->where('id', $id)->first();
                        }else{
                            $data = [
                                'status: ' => 'false',
                                'message: ' => 'Không thể thêm, dữ liệu đã tồn tại!!'
                            ];
                            return response($data, Response::HTTP_CONFLICT);
                        }
                    }else{
                        Movie::where('id', $id)->update($request->all());
                        return Movie::with('episode')->where('id', $id)->first();
                    }
                }else{
                    return Movie::with('episode')->where('id', $id)->first();
                }
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Xử lý lỗi và trả về phản hồi tùy chỉnh
            return response(['message' => 'Lỗi dữ liệu', 'errors' => $e->errors()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::where('id', $id)->first();

        if(!empty($movie)){
            $movie->delete();
            return Movie::with('episode')->orderBy('id', 'desc')->paginate(20);
        }else{
            $data = [
                'status: ' => 'false',
                'message: ' => 'Không tìm thấy dữ liệu!!'
            ];
            return response($data, Response::HTTP_NOT_FOUND);
        }
    }
}
