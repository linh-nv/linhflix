<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EpisodeAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $episode = Episode::paginate(20);
        return $episode;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        if(!empty($request)){
            $episode = Episode::where($request->all())->orderBy('id', 'desc')->get();
            if(count($episode) > 0){
                return count($episode) > 20 ? Episode::where($request->all())->orderBy('id', 'desc')->paginate(20) : $episode;
            }else{
                $data = [
                    'status: ' => 'false',
                    'message: ' => 'Không tìm thấy!!'
                ];
                return response($data, Response::HTTP_NOT_FOUND);
            }
        }else{
            $episode = Episode::orderBy('id', 'desc')->paginate(20);
            return $episode;
        }
    }
    public function create(Request $request)
    {
        // nếu có request dữ liệu
        if(!empty($request)){

            if (!$request->filled('id')) {
                            
                // Kiểm tra xem yêu cầu đã tồn tại trong bất kỳ episode nào chưa
                $existingEpisode = Episode::where('movie_id', $request->movie_id)->where('episode', $request->episode)->first();
                
                if ($existingEpisode) {
                    // Trả về phản hồi báo lỗi phim đã tồn tại
                    $data = [
                        'status: ' => 'false',
                        'message: ' => 'Không thể thêm, dữ liệu đã tồn tại!!'
                    ];
                    return response($data, Response::HTTP_CONFLICT);
                } else {
                    // Nếu phim không tồn tại, thêm phim mới và trả về phản hồi thành công với status code 201
                    $newEpisode = new Episode();
                    $newEpisode->movie_id = $request->movie_id;
                    $newEpisode->linkphim = $request->linkphim;
                    $newEpisode->episode = $request->episode;
                    $newEpisode->save();

                    return response($newEpisode, Response::HTTP_CREATED);
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
            $episode = Episode::orderBy('id', 'desc')->paginate(20);

            return $episode;
            // return $request;
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $episode = Episode::where('id', $id)->get();

        if(!empty($episode)){
            return $episode;
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
                Episode::where('id', $id)->update($request->all());
                return Episode::where('id', $id)->first();
            } else {
                return Episode::where('id', $id)->first();
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $episode = Episode::where('id', $id)->first();

        if(!empty($episode)){
            $episode->delete();
            return Episode::orderBy('id', 'desc')->paginate(20);
        }else{
            $data = [
                'status: ' => 'false',
                'message: ' => 'Không tìm thấy dữ liệu!!'
            ];
            return response($data, Response::HTTP_NOT_FOUND);
        }
    }
}
