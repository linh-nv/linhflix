<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\View;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\Mail;
class UserController extends Controller
{
    // -------------- Register - Login with social media ------------------
    public function github_callback(){
        $github_data = Socialite::driver('github')->user();
        $user = User::where('github_id', $github_data->id)->first();
        if(isset($user)){
            $user->makeHidden('password');
            Session::put('user', $user); 
            return redirect()->to('/');
        }else{
            $category = Category::orderBy('position','ASC')->get();
            $genre = Genre::orderBy('id','DESC')->get();
            $country = Country::orderBy('id','ASC')->get();
    
            return view('pages.client.user.social_register', compact('github_data', 'category', 'genre', 'country'));
        }
    }
    public function google_callback(){
        $google_data = Socialite::driver('google')->user();
        $user = User::where('email', $google_data->email)->first();
        if(isset($user)){
            $user->makeHidden('password');
            Session::put('user', $user); 
            return redirect()->to('/');
        }else{
            $category = Category::orderBy('position','ASC')->get();
            $genre = Genre::orderBy('id','DESC')->get();
            $country = Country::orderBy('id','ASC')->get();
    
            $email = $google_data->email;
            return view('pages.client.user.social_register', compact('email', 'category', 'genre', 'country'));
        }
    }
    public function social_register(){
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();

        return view('pages.client.user.social_register', compact( 'category', 'genre', 'country'));
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
            $user->makeHidden('password');
            Session::put('user', $user); 
            Session::flash('success', 'Xác thực thành công!!'); 
            return redirect()->to('/');
            // return $_POST;
        }else{
            return redirect()->back();
        }
    }
    
    // -------------- Register - Login - Logout ------------------
    public function register(){
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();
     
        return view('pages.client.user.register', compact('category', 'genre', 'country'));
    }
    public function logout(){
        // Xóa tất cả các session
        Session::flush();
        Session::flash('success', 'Đã đăng xuất!!'); 
 
        return redirect()->back();
    }
    public function login_page(){
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();

        return view('pages.client.user.login', compact('category', 'genre', 'country'));
    }
    // post 
    public function login_client(){
        if(isset($_POST)){
            $user = User::where('email', $_POST['account_login'])->where('password', md5($_POST['password_login']))->first();
            if(isset($user)){
                if ($user->email_verified_at) {
                    $user->makeHidden('password');
                    Session::flush();
                    Session::put('user', $user); 
                    Session::flash('success', 'Đăng nhập thành công!!'); 

                    return redirect()->back();
                }else{
                    Session::flash('login_false', 'Tài khoản chưa xác thực email!!');
                    return redirect()->route('login_page');
                }  
            }else{
                Session::flash('login_false', 'Sai tên đăng nhập hoặc mật khẩu!!');
                return redirect()->route('login_page');
            }
        }else{
            return redirect()->back();
        }
    }

    // -------------- Xác minh email (ajax) ------------------
    public function email_verification() {

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
                $user->github_id = $_POST['github_data']??null;
                $user->facebook_id = $_POST['facebook_data']??null;
                $user->remember_token = $token;
                $user->save();
                // return $user;
            }
        }
    }
    public function callback_email_verification($email, $token){
        $user = User::where('email', $email)->first();
        $user->makeHidden('password');
        if($user->email_verified_at === null && $user->remember_token === $token){
            $user->email_verified_at = now();
            $user->created_at = now();
            $user->updated_at = now();
            $user->save();

            Session::put('user', $user); 
            Session::flash('success', 'Xác thực thành công, chào mừng '.$user->name.'!!'); 

            return redirect()->to('/');
        }else{
            Session::flash('verified', 'Tài khoản đã xác thực rồi!!'); 
            return redirect()->route('register');
        }
    }
    // ------------------------------Follow movie--------------------------
    public function follow_page(){
        if (Session::has('user')) {
            $category = Category::orderBy('position','ASC')->get();
            $genre = Genre::orderBy('id','DESC')->get();
            $country = Country::orderBy('id','ASC')->get();

            $user = Session::get('user');
            $user_id = $user['id'];
            $movie = Movie_Follow::with('movie')->where('user_id', $user_id)->orderBy('id','DESC')->paginate(36);

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
            // return $movie;
            return view('pages.client.user.movie_follow', compact('new_movie', 'view_day', 'view_month_total', 'view_year_total', 'view_all_total', 'movie', 'category', 'genre', 'country'));
        }else{
            return redirect()->to('/');
        }
    }
    public function user_info(){
        if (Session::has('user')) {
            $category = Category::orderBy('position','ASC')->get();
            $genre = Genre::orderBy('id','DESC')->get();
            $country = Country::orderBy('id','ASC')->get();

            $user = Session::get('user');
            $user_id = $user['id'];
            $user_info = User::where('id', $user_id)->first();

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
            // return $movie;
            return view('pages.client.user.user_info', compact('new_movie', 'view_day', 'view_month_total', 'view_year_total', 'view_all_total', 'user_info', 'category', 'genre', 'country'));
        }else{
            return redirect()->to('/');
        }
    }
    public function follow(Request $request){
        if (isset($request)){
            $movie_follow= new Movie_Follow();
            $movie_follow->movie_id = $request->movie_id;
            $movie_follow->user_id = $request->user_id;
            $movie_follow->save();
            return true;
        }else{
            return false;
        }
    }
    public function unfollow(Request $request){
        if (isset($request)){
            $movie_follow = Movie_Follow::where('movie_id', $request->movie_id)->where('user_id', $request->user_id)->first();
            $movie_follow->delete();
            return true;
        }else{
            return false;
        }
    }
    public function update(Request $request){
        if(isset($request->name_info)){
            $user = User::where('id', $request->user_id)->first();
            $user->name = $request->name_info;
            $user->save();
            Session::flash('success', 'Thay đổi thông tin thành công!!');

            return redirect()->back();
        }else if(isset($request->avatar)){
            
        }else if (isset($request->github_id)){
            $user = User::where('id', $request->user_id)->first();
            $user->github_id = null;
            $user->save();
            Session::flash('success', 'Thay đổi thông tin thành công!!');

        }else{
            Session::flash('error', 'Thay đổi thông tin thất bại!!');
            return redirect()->back();
        }
    }
}
