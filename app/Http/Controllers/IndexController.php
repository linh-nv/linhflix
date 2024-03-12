<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\User;
use App\Models\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\Mail;
// use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home(){
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();

        $movie = Movie::orderBy('view','DESC')->get();
        $new_movie = Movie::orderBy('year', 'DESC')->orderBy('view','DESC')->get();
        $serie_movie = Movie::where('category_id',6)->orderBy('year','DESC')->orderBy('view','DESC')->get();
        $singer_movie = Movie::where('category_id',7)->orderBy('year','DESC')->orderBy('view','DESC')->get();

        $view_day = View::with('movie')->whereDate('view_date', now()->toDateString())->orderBy('view_number', 'DESC')->get();
        $view_month_total = View::with('movie')->where('view_date', '>=', now()->startOfMonth()->toDateString())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        $view_year_total = View::with('movie')->where('view_date', '>=', now()->startOfYear())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();
        $view_all_total = View::with('movie')->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        // return response()->json($movie);
        return view('pages.home', compact('movie', 'new_movie', 'serie_movie', 'singer_movie', 'category', 'genre', 'country', 'view_day', 'view_month_total', 'view_year_total', 'view_all_total'));
    }
    public function category($slug){
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();

        $cate_slug = Category::where('slug', $slug)->first();
        $movie = Movie::where('category_id', $cate_slug->id)->orderBy('year', 'DESC')-> orderBy('view','DESC')->paginate(36);
        $new_movie = Movie::orderBy('year', 'DESC')-> orderBy('view','DESC')->paginate(36);
        $view_day = View::with('movie')->whereDate('view_date', now()->toDateString())->orderBy('view_number', 'DESC')->get();
        $view_month_total = View::with('movie')->where('view_date', '>=', now()->startOfMonth()->toDateString())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        $view_year_total = View::with('movie')->where('view_date', '>=', now()->startOfYear())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();
        $view_all_total = View::with('movie')->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        return view('pages.category', compact('new_movie', 'cate_slug', 'view_day', 'view_month_total', 'view_year_total', 'view_all_total', 'movie', 'category', 'genre', 'country'));
        // return response()->json($movie);
    }
    public function genre($slug){
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();

        $gen_slug = Genre::where('slug', $slug)->first();
        $movie_genre = Movie_Genre::where('genre_id',$gen_slug->id)->get();
        $many_genre = [];
        foreach($movie_genre as $key => $mov){
            $many_genre[] = $mov->movie_id;
        }
        $movie = Movie::whereIn('id',$many_genre)->orderBy('year', 'DESC')->orderBy('view','DESC')->paginate(36);
        $new_movie = Movie::orderBy('year', 'DESC')-> orderBy('view','DESC')->paginate(36);
        $view_day = View::with('movie')->whereDate('view_date', now()->toDateString())->orderBy('view_number', 'DESC')->get();
        $view_month_total = View::with('movie')->where('view_date', '>=', now()->startOfMonth()->toDateString())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        $view_year_total = View::with('movie')->where('view_date', '>=', now()->startOfYear())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();
        $view_all_total = View::with('movie')->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        return view('pages.genre', compact('new_movie', 'gen_slug', 'view_day', 'view_month_total', 'view_year_total', 'view_all_total', 'movie', 'category', 'genre', 'country'));
        // return response()->json($movie);
    }
    public function country($slug){
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();

        $count_slug = Country::where('slug', $slug)->first();
        $movie = Movie::where('country_id', $count_slug->id)->orderBy('year', 'DESC')-> orderBy('view','DESC')->paginate(36);
        $new_movie = Movie::orderBy('year', 'DESC')-> orderBy('view','DESC')->paginate(36);
        $view_day = View::with('movie')->whereDate('view_date', now()->toDateString())->orderBy('view_number', 'DESC')->get();
        $view_month_total = View::with('movie')->where('view_date', '>=', now()->startOfMonth()->toDateString())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        $view_year_total = View::with('movie')->where('view_date', '>=', now()->startOfYear())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();
        $view_all_total = View::with('movie')->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        return view('pages.country', compact('new_movie', 'count_slug', 'view_day', 'view_month_total', 'view_year_total', 'view_all_total', 'movie', 'category', 'genre', 'country'));
        // return response()->json($view_day);
    }
    public function movie($slug){
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();
        
        $movie = Movie::with('category','genre','country','movie_genre')->where('slug',$slug)->first();
        $genre_movie = Movie_Genre::with('genre')->where('movie_id',$movie->id)->get();
        $new_movie = Movie::orderBy('created_day','DESC')->orderBy('view','DESC')->get();

        $episode = Episode::where('movie_id', $movie->id)->get();
        
        $episodeArray = json_decode($episode, true);
        // Lấy số lượng phần tử của mảng
        $arrayLength = count($episodeArray);
        // Lấy phần tử đầu tiên của mảng
        $startEpisode = $episodeArray[0];
        // Lấy phần tử cuối cùng của mảng
        $lastEpisode = end($episodeArray);
        // Lấy phần tử gần cuối trong mảng
        $arrayLength > 2 ? $penultimateEpisode = $episodeArray[$arrayLength - 2] : $penultimateEpisode = '';
        
        $total_episode = $lastEpisode['episode'];
        $recent_episodes  = $total_episode - 1;

        $view_day = View::with('movie')->whereDate('view_date', now()->toDateString())->orderBy('view_number', 'DESC')->get();
        $view_month_total = View::with('movie')->where('view_date', '>=', now()->startOfMonth()->toDateString())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        $view_year_total = View::with('movie')->where('view_date', '>=', now()->startOfYear())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();
        $view_all_total = View::with('movie')->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        // return response()->json($penultimateEpisode);
        return view('pages.movie', compact('startEpisode', 'penultimateEpisode', 'lastEpisode', 'recent_episodes', 'total_episode', 'new_movie', 'view_day', 'view_month_total', 'view_year_total', 'view_all_total', 'movie', 'category', 'genre', 'genre_movie', 'country'));
    }
    public function watch($slug){
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();

        $movie = Movie::with('category','genre','country','movie_genre')->where('slug',$slug)->first();
        $genre_movie = Movie_Genre::with('genre')->where('movie_id',$movie->id)->get();

        $episode = Episode::where('movie_id', $movie->id)->first();

        $ipAddress = Request::ip();
        $userAgent = Request::header('User-Agent');
        if (!Session::has('watched_movie_' . $movie->id .$ipAddress .$userAgent)) {
            $movie->view = $movie->view + 1;
            $movie->save();
            // Tăng giá trị cột 'view' lên 1
            $view = View::where('movie_id', $movie->id)->where('view_date', now()->toDateString())->first();

            if (!$view) {
                // Nếu bản ghi không tồn tại, tạo mới một bản ghi
                $view = new View();
                $view->movie_id = $movie->id;
                $view->view_date = now()->toDateString();
            }

            $view->view_number = $view->view_number + 1;
            // Lưu bản ghi
            $view->save();
            // Đặt session để ghi nhớ rằng người dùng đã xem phim
            Session::put('watched_movie_' . $movie->id .$ipAddress .$userAgent, true);
        }
        return view('pages.watch', compact('episode', 'movie', 'category', 'genre', 'genre_movie', 'country'));
        // return response()->json($userAgent);
    }
    public function watchEpisode($slug, $episode)
    {

        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();
        $movie_suggest = Movie::orderBy('year','DESC')->orderBy('view','DESC')->get();

        $movie = Movie::where('slug',$slug)->first();
        $genre_movie = Movie_Genre::with('genre')->where('movie_id',$movie->id)->get();

        $total_episode = Episode::where('movie_id', $movie->id)->get();
        $movie_episode = Episode::where('movie_id',$movie->id)->where('episode',$episode)->first();

        $ipAddress = Request::ip();
        $userAgent = Request::header('User-Agent');
        if (!Session::has('watched_movie_' . $movie->id .$ipAddress .$userAgent)) {
            $movie->view = $movie->view + 1;
            $movie->save();
            // Tăng giá trị cột 'view' lên 1
            $view = View::where('movie_id', $movie->id)->where('view_date', now()->toDateString())->first();

            if (!$view) {
                // Nếu bản ghi không tồn tại, tạo mới một bản ghi
                $view = new View();
                $view->movie_id = $movie->id;
                $view->view_date = now()->toDateString();
            }

            $view->view_number = $view->view_number + 1;
            // Lưu bản ghi
            $view->save();
            // Đặt session để ghi nhớ rằng người dùng đã xem phim
            Session::put('watched_movie_' . $movie->id .$ipAddress .$userAgent, true);
        }
        return view('pages.watch', compact('episode', 'total_episode','movie_suggest','category','genre','country', 'genre_movie', 'movie','movie_episode'));
        // return response()->json($total_episode);
    }
    public function search(){
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $category = Category::orderBy('position','ASC')->get();
            $genre = Genre::orderBy('id','DESC')->get();
            $country = Country::orderBy('id','ASC')->get();

            $movie = Movie::where('title', 'LIKE', '%'.$search.'%')
            ->orWhere('actor', 'LIKE', '%'.$search.'%')
            ->orWhere('slug', 'LIKE', '%'.$search.'%')
            ->orWhere('director', 'LIKE', '%'.$search.'%')
            ->orWhere('name_eng', 'LIKE', '%'.$search.'%')
            ->orWhere('year', 'LIKE', '%'.$search.'%')
            ->orderBy('view','DESC')
            ->get();
            
            $view_day = View::with('movie')->whereDate('view_date', now()->toDateString())->orderBy('view_number', 'DESC')->get();
            $view_month_total = View::with('movie')->where('view_date', '>=', now()->startOfMonth()->toDateString())
            ->groupBy('movie_id') // Nhóm theo movie_id
            ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
            ->orderBy('total_views', 'DESC')
            ->get();

            $view_year_total = View::with('movie')->where('view_date', '>=', now()->startOfYear())
            ->groupBy('movie_id') // Nhóm theo movie_id
            ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
            ->orderBy('total_views', 'DESC')
            ->get();
            $view_all_total = View::with('movie')->groupBy('movie_id') // Nhóm theo movie_id
            ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
            ->orderBy('total_views', 'DESC')
            ->get();
            return view('pages.search', compact('view_day', 'view_month_total', 'view_year_total', 'view_all_total', 'search','movie', 'category','genre','country'));
        }else{
            return redirect()->to('/');
        }
    }
    public function director(){
        $director = request('director');
        if(isset($director)){
            $category = Category::orderBy('position','ASC')->get();
            $genre = Genre::orderBy('id','DESC')->get();
            $country = Country::orderBy('id','ASC')->get();

            $movie = Movie::where('director', 'LIKE', '%'.$director.'%')->orderBy('year', 'DESC')->orderBy('view','DESC')->get();
            $view_day = View::with('movie')->whereDate('view_date', now()->toDateString())->orderBy('view_number', 'DESC')->get();
            $view_month_total = View::with('movie')->where('view_date', '>=', now()->startOfMonth()->toDateString())
            ->groupBy('movie_id') // Nhóm theo movie_id
            ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
            ->orderBy('total_views', 'DESC')
            ->get();

            $view_year_total = View::with('movie')->where('view_date', '>=', now()->startOfYear())
            ->groupBy('movie_id') // Nhóm theo movie_id
            ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
            ->orderBy('total_views', 'DESC')
            ->get();
            $view_all_total = View::with('movie')->groupBy('movie_id') // Nhóm theo movie_id
            ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
            ->orderBy('total_views', 'DESC')
            ->get();

            return view('pages.director', compact('director', 'view_day', 'view_month_total', 'view_year_total', 'view_all_total','movie', 'category','genre','country'));
        }else{
            return redirect()->to('/');
        }
    }
    public function actor(){
        $actor = request('actor');
        if(isset($actor)){
            $category = Category::orderBy('position','ASC')->get();
            $genre = Genre::orderBy('id','DESC')->get();
            $country = Country::orderBy('id','ASC')->get();

            $movie = Movie::where('actor', 'LIKE', '%'.$actor.'%')->orderBy('year', 'DESC')->orderBy('view','DESC')->get();
            $view_day = View::with('movie')->whereDate('view_date', now()->toDateString())->orderBy('view_number', 'DESC')->get();
            $view_month_total = View::with('movie')->where('view_date', '>=', now()->startOfMonth()->toDateString())
            ->groupBy('movie_id') // Nhóm theo movie_id
            ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
            ->orderBy('total_views', 'DESC')
            ->get();

            $view_year_total = View::with('movie')->where('view_date', '>=', now()->startOfYear())
            ->groupBy('movie_id') // Nhóm theo movie_id
            ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
            ->orderBy('total_views', 'DESC')
            ->get();
            $view_all_total = View::with('movie')->groupBy('movie_id') // Nhóm theo movie_id
            ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
            ->orderBy('total_views', 'DESC')
            ->get();

            return view('pages.actor', compact('actor', 'view_day', 'view_month_total', 'view_year_total', 'view_all_total','movie', 'category','genre','country'));
        }else{
            return redirect()->to('/');
        }
    }
    public function updateMovie($slug){
        $movie = Movie::where('slug',$slug)->first();
        
        $api = Http::get("https://phimapi.com/phim/$movie->slug")->json();
        $movie_episode = Episode::where('movie_id',$movie->id)->get();
        if(isset($api['movie']['episode_current'])){
            if($movie->episode_current == $api['movie']['episode_current']){
                Session::flash('no-action', 'Chưa có tập phim mới'); 
            }else{
                foreach($movie_episode as $episode) {
                    $episode->delete();
                }
                $index = 1;
                foreach($api['episodes'][0]['server_data'] as $epiAPI){
                    $episode = new Episode();
                    $episode->movie_id = $movie->id;
                    $episode->linkphim = $epiAPI['link_embed'];
                    $episode->episode = $index;
                    
                    $episode->save();
                    $index++;
                }
                Session::flash('success', 'Cập nhật thành công'); 
                
                $movie->status = $api['movie']['status'];
                $movie->episode_current = $api['movie']['episode_current'];
                $movie->save();
            }
            // return response()->json($movie);
        }else{
            Session::flash('false', 'Cập nhật thất bại'); 
        }
        return redirect()->back();
    }
    public function new_movie(){
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();

        $view_day = View::with('movie')->whereDate('view_date', now()->toDateString())->orderBy('view_number', 'DESC')->get();
        $view_month_total = View::with('movie')->where('view_date', '>=', now()->startOfMonth()->toDateString())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        $view_year_total = View::with('movie')->where('view_date', '>=', now()->startOfYear())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();
        $view_all_total = View::with('movie')->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        // return response()->json($movies_search);
        
        return view('pages.new_movie', compact('category', 'genre', 'country', 'view_day', 'view_month_total', 'view_year_total', 'view_all_total'));
    }
    public function movie_suggest(){

        $movies_search = []; // Định nghĩa biến $movies trước khi sử dụng

        $url = 'https://phimmoiiii.net/xem-phim/ba-chu-bau-troi-masters-of-the-air-tap-1';// . $_GET['search'];
        $crawler = Http::get($url);

        // // Tạo một HTTP client
        // $client = HttpClient::create();
    
        // // Khởi tạo một BrowserKit client với HTTP client
        // $browser = new HttpBrowser($client);
    
        // // Thực hiện yêu cầu GET đến URL cụ thể
        // $crawler = $browser->request('GET', $url);
    
        // Trích xuất thông tin từ trang web
        $crawler->filter('div.result-item')->each(
            function (Crawler $item) use (&$movies_search) {
                $name = $item->filter('div.details div.title a')->text();
                $year = $item->filter('div.details div.meta span')->text();
                $description = $item->filter('div.details div.contenido p')->text();
                $poster = $item->filter('div.image div.thumbnail a img')->attr('src');
                $link = $item->filter('div.details div.title a')->attr('href');
                
                $parts = explode("/", $link);
                $slug = end($parts);
                $movies_search[] = [
                    'name' => $name,
                    'slug' => $slug,
                    'year' => $year,
                    'description' => $description,
                    'poster' => $poster,
                    'link' => $link,
                    'isset' => 0
                ];
            }
        );
        foreach($movies_search as &$mov) {
            $movie = Movie::where('slug', $mov['slug'])->first();
            if(isset($movie)) {
                $mov['isset'] = 1;
            }
        }
        unset($mov); // Giải phóng biến $mov để tránh ảnh hưởng đến các lần lặp sau
        
        return $movies_search;
        // return response()->json($movies_search);
        
    }
    public function add_movie(){
        if(isset($_GET['link'])){
            $url = $_GET['link'];
            // Tạo một HTTP client
            $client = HttpClient::create();
            // Khởi tạo một BrowserKit client với HTTP client
            $browser = new HttpBrowser($client);
            // Thực hiện yêu cầu GET đến URL cụ thể
            $crawler = $browser->request('GET', $url);
    
            $parts = explode("/", $url);
            $category = $parts[3];
            if($category == 'phim-le'){
                return redirect()->away($url);    
            }else{
                // Trích xuất thông tin từ trang web
                $content = $crawler->filter('div.content');
                // ------------------------------------------------------------------------
                // Lưu phim
                $name = $content->filter('div.sheader div.data h1')->text();
                $name_eng = $content->filter('div.sheader div.data div.extra span.valor')->text();
                $status = $content->filter('div.sheader div.data div.movie_label span.item-label')->text();
                $description = $content->filter('div#info div.wp-content p')->text();
                $poster = $content->filter('div.sheader div.poster img')->attr('src');   
                $parts = explode("/", $url);
                $slug = end($parts);
    
                // Lấy ngày, năm phim
                $dateString = $content->filter('div.sheader div.data div.extra span.date')->text();
                // Chuyển đổi chuỗi thành Unix timestamp
                $timestamp = strtotime($dateString);
                // Định dạng lại Unix timestamp thành chuỗi theo định dạng mong muốn
                $created_day = date("Y-m-d\TH:i:s\.000\Z", $timestamp);
                $year = substr($created_day, 0, 4);
    
                //Lấy số tập, link để lấy phim
                $episodeLinks = $crawler->filter('div.episodiotitle a');
                $data_episode = [];
                $episode_number = 0;
                $episodeLinks->each(
                    function (Crawler $item) use (&$data_episode, &$episode_number) {
                        $episode_number++;
                        $link = $item->attr('href');
                        $style = $item->attr('class');
                        if(!$style == "nonex"){
                            $data_episode[] = [
                                'episode_number' => $episode_number,
                                'link' => $link
                            ];
                        }
                    }
                );

                //Lưu phim
                $movie = new Movie();
                $movie->title = $name;
                $movie->slug = $slug;
                $movie->description = $description;
                $movie->category_id = 6;
                $movie->episode_total = $episode_number;
                $movie->episode_current = $status;
                $movie->year = $year;
                $movie->poster = $poster;
                $movie->image = "https://images.thedirect.com/media/article_full/netflix-cancelled-shows.jpg";
                $movie->name_eng = $name_eng;
                $movie->created_day = $created_day;
                $movie->updated_day = $created_day;
                $movie->movie_source = "phimmoi";
                $movie->save();

                // Lưu thông tin các tập phim
                $movie_id = Movie::count() + 1;

                foreach ($data_episode as $episode) {
                    $movie_episode = new Episode();
                    $movie_episode->movie_id = $movie_id;
                    $movie_episode->linkphim = $episode['link'];
                    $movie_episode->episode = $episode['episode_number'];
                    $movie_episode->save();
                }

                return redirect()->to('/phim'. $slug);    
            }
        }else{
            return redirect()->back();
        }
    }    
    function add_episode($data_episode){
        $data = [];
        foreach ($data_episode as $episode) {
            $url = $episode['link'];
            // Tạo một HTTP client
            $client = HttpClient::create();
            // Khởi tạo một BrowserKit client với HTTP client
            $browser = new HttpBrowser($client);
            // Thực hiện yêu cầu GET đến URL cụ thể
            $crawler = $browser->request('GET', $url);

            $link_embed = $crawler->filter('div.metaframe iframe')->attr('src');

            $data[] = [
                'episode_number' => $episode['episode_number'],
                'link_embed' => $link_embed
            ];
        }

        return $data;
    }

    // -------------- Register - Login with social media ------------------
    public function github_callback(){
        $github_data = Socialite::driver('github')->user();
        $user = User::where('github_id', $github_data->id)->first();
        if(isset($user)){
            Session::put('user', $user); 
            return redirect()->to('/');
        }else{
            $category = Category::orderBy('position','ASC')->get();
            $genre = Genre::orderBy('id','DESC')->get();
            $country = Country::orderBy('id','ASC')->get();
    
            return view('pages.social_register', compact('github_data', 'category', 'genre', 'country'));
        }
    }
    public function google_callback(){
        $google_data = Socialite::driver('google')->user();
        $user = User::where('email', $google_data->email)->first();
        if(isset($user)){
            Session::put('user', $user); 
            return redirect()->to('/');
        }else{
            $category = Category::orderBy('position','ASC')->get();
            $genre = Genre::orderBy('id','DESC')->get();
            $country = Country::orderBy('id','ASC')->get();
    
            $email = $google_data->email;
            return view('pages.social_register', compact('email', 'category', 'genre', 'country'));
        }
    }
    public function social_register(){
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();

        return view('pages.social_register', compact( 'category', 'genre', 'country'));
    }
    public function check_email(){
        if(!empty($_GET['email'])){
            $user = User::where('email', $_GET['email'])->first();
            if(isset($user)){
                return response()->json(['exists' => true]);
            } else {
                return response()->json(['exists' => false]);
            }
        }else{
            return response()->json(['exists' => null]);
        }
    }
    // post
    public function create_social_account(){
        if(isset($_POST)){
            $user = new User();
            $user->name = $_POST['name_register'];
            $user->email = $_POST['email_register'];
            $user->email_verified_at = empty($_POST['github_data_id']) ? now() : null; //nếu đăng ký bằng email thì chưa có những id github, facebook ...
            $user->password = md5($_POST['pass_register']);
            $user->github_id = empty($_POST['github_data_id']) ? null : $_POST['github_data_id'];
            $user->facebook_id = empty($_POST['facebook_data_id']) ? null : $_POST['facebook_data_id'];
            $user->remember_token = $_POST['_token'];
            $user->created_at = now();
            $user->updated_at = now();
            $user->save();

            Session::put('user', $user); 
            return redirect()->to('/');
            // return $user;
        }else{
            return redirect()->back();
        }
    }
    
    // -------------- Register - Login - Logout ------------------
    public function register(){
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();
     
        return view('pages.register', compact('category', 'genre', 'country'));
    }
    public function logout(){
        // Xóa tất cả các session
        Session::flush();
        return redirect()->back();
    }
    public function login_page(){
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();

        return view('pages.login', compact('category', 'genre', 'country'));
    }
    // post 
    public function login(){
        if(isset($_POST)){
            $user = User::where('email', $_POST['account_login'])->where('password', md5($_POST['password_login']))->first();
            if(isset($user)){
                Session::flush();
                Session::put('user', $user); 
                return redirect()->to('/');
            }else{
                Session::flash('login_false', 'Sai tên đăng nhập hoặc mật khẩu!!');
                return redirect()->route('login_page');
            }
        }else{
            return redirect()->back();
        }
    }

    // -------------- Xác minh email ------------------
    public function email_verification() {
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();

        if(isset($_POST)){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $token = $_POST['_token'];
            $user = User::where('email', $email)->first();
            if(!isset($user)){     
                //gửi mail xác minh     
                Mail::send('mail.email_verification', compact('name', 'token', 'email'), function($email_response) use($name, $email){
                    $email_response->subject('Linh Phim - Confirm your email address');
                    $email_response->to($email, $name);
                });

                $user = new User();
                $user->name = $name;
                $user->email = $email;
                $user->password = md5($_POST['password']);
                $user->github_id = empty($_POST['github_data_id']) ? null : $_POST['github_data_id'];
                $user->facebook_id = empty($_POST['facebook_data_id']) ? null : $_POST['facebook_data_id'];
                $user->remember_token = $token;
                $user->save();
            }
        }
    }
    public function callback_email_verification($email, $token){
        $user = User::where('email', $email)->first();

        if($user->email_verified_at === null && $user->remember_token === $token){
            $user->email_verified_at = now();
            $user->created_at = now();
            $user->updated_at = now();
            $user->save();

            Session::put('user', $user); 
            return redirect()->to('/');
        }else{
            Session::flash('verified', 'Tài khoản đã xác thực rồi!!'); 
            return redirect()->route('register');
        }

    }
}
