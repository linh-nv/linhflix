<?php

namespace App\Http\Controllers\Api;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage as Storage;

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

            if (!$request->filled('id')) {
                            
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

                    $newMovie->description = isset($request->description) ? $request->description : null;
                    $newMovie->episode_total = isset($request->episode_total) ? $request->episode_total : null;
                    $newMovie->runtime = isset($request->runtime) ? $request->runtime : null;
                    $newMovie->status = isset($request->status) ? $request->status : null;
                    $newMovie->trailer = isset($request->trailer) ? $request->trailer : null;
                    $newMovie->category_id = isset($request->category_id) ? $request->category_id : null;
                    $newMovie->country_id = isset($request->country_id) ? $request->country_id : null;
                    $newMovie->quality = isset($request->quality) ? $request->quality : null;
                    $newMovie->subtitle = isset($request->subtitle) ? $request->subtitle : null;
                    $newMovie->actor = isset($request->actor) ? $request->actor : null;
                    $newMovie->director = isset($request->director) ? $request->director : null;
                    $newMovie->movie_source = "user_create";
                    $newMovie->created_day = Carbon::now('Asia/Ho_Chi_Minh');
                    $newMovie->updated_day = Carbon::now('Asia/Ho_Chi_Minh');

                    $newMovie->name_eng = $request->name_eng;
                    $newMovie->year = $request->year;
                    $newMovie->image = "https://images.ctfassets.net/y2ske730sjqp/5QQ9SVIdc1tmkqrtFnG9U1/de758bba0f65dcc1c6bc1f31f161003d/BrandAssets_Logos_02-NSymbol.jpg?w=940";
                    
                    // Lưu trữ tệp trên Google Drive
                    $newMovie->poster = $request->name_poster;
                    Storage::disk('google')->put('Images/' . $request->name_poster, base64_decode($request->fileData));

                    $newMovie->save();

                    $newMovie->movie_genre()->attach($request->genre_id);
                    
                    return response($newMovie, Response::HTTP_CREATED);
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


    private function handle_update($request, $id){

        $movie = Movie::find($id);

        !empty($request->slug) ? $movie->slug = $request->slug : '';
        !empty($request->name_eng) ? $movie->name_eng = $request->name_eng : '';
        !empty($request->year) ? $movie->year = $request->year : '';
        !empty($request->title) ? $movie->title = $request->title : '';
        !empty($request->description) ? $movie->description = $request->description : '';
        !empty($request->episode_total) ? $movie->episode_total = $request->episode_total : '';
        !empty($request->runtime) ? $movie->runtime = $request->runtime : '';
        !empty($request->category_id) ? $movie->category_id = $request->category_id : '';
        !empty($request->trailer) ? $movie->trailer = $request->trailer : '';
        !empty($request->status) ? $movie->status = $request->status : '';
        !empty($request->country_id) ? $movie->country_id = $request->country_id : '';
        !empty($request->quality) ? $movie->quality = $request->quality : '';
        !empty($request->subtitle) ? $movie->subtitle = $request->subtitle : '';
        !empty($request->actor) ? $movie->actor = $request->actor : '';
        !empty($request->director) ? $movie->director = $request->director : '';
        $movie->updated_day = Carbon::now('Asia/Ho_Chi_Minh');
        
        // Lưu trữ tệp trên Google Drive
        if (!empty($request->name_poster)){
            Storage::disk('google')->put('Images/' . $request->name_poster, base64_decode($request->fileData));
            $movie->poster = $request->name_poster;
        }
        $movie->save();
        $movie->movie_genre()->sync($request->genre_id);
        
        return Movie::with('episode')->where('id', $id)->first();
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
                $movie = Movie::find($id);

                // Kiểm tra xem có thay đổi slug không
                if($movie->slug !== $request->slug){
                    $check = Movie::where('slug', $request->slug)->first();

                    // Kiểm tra xem slug mới có bị trùng với slug nào khác không
                    if(empty($check)){
                        Storage::disk('google')->delete('Images/' . $movie->slug . '--poster.jpg');
                        $this->handle_update($request, $id);        
                    }else{
                        $data = [
                            'status: ' => 'false',
                            'message: ' => 'Không thể thêm, dữ liệu đã tồn tại!!'
                        ];
                        return response($data, Response::HTTP_CONFLICT);
                    }
                }else{
                    $this->handle_update($request, $id);
                }
            }else{
                return Movie::with('episode')->where('id', $id)->first();
            }
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::where('id', $id)->first();

        if(!empty($movie)){
            Storage::disk('google')->delete('Images/' . $movie->slug . '--poster.jpg');
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
