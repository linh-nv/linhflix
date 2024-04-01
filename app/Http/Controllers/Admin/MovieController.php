<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Episode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Movie::with('category','movie_genre','country')->orderBy('id','DESC')->get();

        return view('admin.movie.index',compact('list'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::pluck('title','id');
        $genre = Genre::pluck('title','id');
        $country = Country::pluck('title','id');

        $genre_list = Genre::all();
        $quality_list = ['HD', 'Full HD', '4K', 'Cam', 'HDCam'];
        return view('admin.movie.form',compact('category','genre','country', 'quality_list', 'genre_list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->name_eng = $data['name_eng'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        
        $movie->episode_number = $data['episode_number'];
        $movie->year = $data['year'];
        
        $movie->runtime = $data['runtime'];
        $movie->status = $data['status'];
        $movie->image = $data['image'];
        $movie->trailer = $data['trailer'];
        $movie->category_id = $data['category_id'];
        $movie->country_id = $data['country_id'];
        $movie->actor = $data['actor'];
        $movie->director = $data['director'];
        $movie->qualiti = $data['qualiti'];
        $movie->subtitle = $data['subtitle'];
        $movie->created_day = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->updated_day = Carbon::now('Asia/Ho_Chi_Minh');

        foreach($data['genre'] as $key => $gen){
            $movie->genre_id = $gen[0];
        }

        $get_image = $request->file('image');

        $path = 'uploads/movie';

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $movie->image = $new_image;
        }
        $movie->save();

        //them nhieu the loai cho phim
        $movie->movie_genre()->attach($data['genre']);

        return redirect()->back();
    }

    public function createFormAPI(){
        $get_totalPage = Http::get("https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=1")->json();
        
        $totalPages = $get_totalPage['pagination']['totalPages']; // Số lượng trang bạn muốn lấy dữ liệu
        
        for ($page = 12; $page <= $totalPages; $page++) {
            $data = Http::get("https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=$page")->json();
            
            foreach ($data['items'] as $api) {
                $movie = new Movie();
                
                $movie->title = $api['name'];
                $movie->name_eng = $api['origin_name'];
                $movie->slug = $api['slug'];
                $movie->year = $api['year'];
                $movie->image = $api['thumb_url'];
                $movie->created_day = Carbon::now('Asia/Ho_Chi_Minh');
                $movie->updated_day = Carbon::now('Asia/Ho_Chi_Minh');
                
                $movie->save();
            }
        }
        
        return redirect()->back();
    }
    // public function createDetailsAPI(){ 
    //     $movie = Movie::all();
        
    //     foreach($movie as $mov){
    //         $data = Http::get("https://ophim1.com/phim/$movie->slug")->json();

    //                         // cập nhật category_id và country_id cho Movie
    //                         if ($data['movie']['type'] == 'series'){
    //                             $mov->category_id = 6;
    //                         }else{
    //                             if($data['movie']['chieurap'] == false){
    //                                 $mov->category_id = 4;
    //                             }else{
    //                                 $mov->category_id = 7;
    //                             }
    //                         }
                            
    //                         $country = Country::where('slug',$data['movie']['country'][0]['slug'])->first();
    //                         if($country == ''){
    //                             $mov->country_id = 38;
    //                         }else{
    //                             $mov->country_id = $country['id'];
    //                         }
    //         // Lấy danh sách genres từ dữ liệu API
    //         $apiGenres = collect($data['movie']['category']);
    //         // Lấy danh sách genre_ids từ bảng genre trong Laravel dựa trên slug
    //         $genreIds = Genre::whereIn('slug', $apiGenres->pluck('slug'))->pluck('id');

    //         $mov->save();  
    //         $mov->movie_genre()->sync($genreIds);

            

            
    //         $all_api_episodes = collect($data['episodes'][0]['server_data']);
    //         // Đếm số tập phim
    //         $num_episodes = count($all_api_episodes);
            
    //         // Sử dụng vòng lặp for để lưu các tập phim
    //         for ($i = 0; $i < $num_episodes; $i++) {
    //             $api_episode = $all_api_episodes[$i];
            
    //             $episode = new Episode();
    //             $episode->movie_id = $mov->id;
    //             $episode->episode = $i + 1;
    //             $episode->linkphim = $api_episode['link_embed']; 
    //             $episode->save();
    //         }
    //         $mov->created_day = $data[$mov->id]['created']['time'];
    //         $mov->description = $data[$mov->id]['content'];
    //         if($data[$mov->id]['type'] == 'singer' && $data[$mov->id]['chieurap'] = false){
    //             $mov->category_id = 7;
    //         }
    //         if($data[$mov->id]['type'] == 'singer' && $data[$mov->id]['chieurap'] = true){
    //             $mov->category_id = 4;
    //         }
    //         if($data[$mov->id]['type'] == 'series'){
    //             $mov->category_id = 6;
    //         }

    //         $mov->status = $data[$mov->id]['status'];
    //         $mov->trailer = $data[$mov->id]['trailer_url'];
    //         $mov->runtime = $data[$mov->id]['time'];
    //         $mov->episode_current = $data[$mov->id]['episode_current'];
    //         $mov->quality = $data[$mov->id]['quality'];
    //         $mov->subtitle = $data[$mov->id]['lang'];
    //         $mov->view = $data[$mov->id]['view'];
    //         $mov->actor = implode(', ', $data[$mov->id]['actor']);
    //         $mov->director = implode(', ', $data[$mov->id]['director']);

    //         $mov->save();
    //     }
    //     return redirect()->back();
    //     // return response()->json($movie_slug);
    // }
    
    
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $list = Movie::all();
        $episode = Episode::all();
        $episodesCollection = collect($episode);

        // Group by 'movie_id' và chọn 'episode' lớn nhất cho mỗi nhóm
        $result = $episodesCollection->groupBy('movie_id')->map(function ($group) {
            return $group->max('episode');
        });

        return view('admin.movie.status',compact('list', 'episode'));
        // return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::pluck('title','id');
        $genre = Genre::pluck('title','id');
        $country = Country::pluck('title','id');
        $movie = Movie::find($id);

        $genre_list = Genre::all();
        $quality_list = ['HD', 'Full HD', '4K', 'Cam', 'HDCam'];
        $movie_genre = $movie->movie_genre;
        return view('admin.movie.form',compact('category','genre','country','movie','quality_list', 'genre_list', 'movie_genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return redirect()->back()->with('error', 'Movie not found.');
        }

        $data = $request->all();

        $movie->title = $data['title'];
        $movie->name_eng = $data['name_eng'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        
        $movie->episode_number = $data['episode_number'];
        $movie->year = $data['year'];
        
        $movie->runtime = $data['runtime'];
        $movie->status = $data['status'];

        // Kiểm tra xem có tệp ảnh mới được chọn hay không
        if ($request->hasFile('image')) {
            $get_image = $request->file('image');
            $path = 'uploads/movie/';

            // Xóa ảnh cũ nếu tồn tại
            if (!empty($movie->image)) {
                $file_path = $path . $movie->image;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $movie->image = $new_image;
        }

        $movie->trailer = $data['trailer'];
        $movie->category_id = $data['category_id'];
        $movie->country_id = $data['country_id'];
        $movie->actor = $data['actor'];
        $movie->director = $data['director'];
        $movie->qualiti = $data['qualiti'];
        $movie->updated_day = Carbon::now('Asia/Ho_Chi_Minh');

        foreach($data['genre'] as $key => $gen){
            $movie->genre_id = $gen[0];
        }

        $movie->save();

        $movie->movie_genre()->sync($data['genre']);
        return redirect()->route('movie.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::find($id);
        // if(!empty($movie->image)){
        //     unlink('uploads/movie/'.$movie->image);
        // }
        $movie->delete();
        return redirect()->back();
    }
}
