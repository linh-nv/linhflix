<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie_Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
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
        return redirect()->back();
    }
    public function login_page(){
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();

        return view('pages.client.user.login', compact('category', 'genre', 'country'));
    }
    // post 
    public function login(){
        if(isset($_POST)){
            $user = User::where('email', $_POST['account_login'])->where('password', md5($_POST['password_login']))->first();
            if(isset($user)){
                if ($user->email_verified_at) {
                    $user->makeHidden('password');
                    Session::flush();
                    Session::put('user', $user); 
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

    // -------------- Xác minh email ------------------
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
            return redirect()->to('/');
        }else{
            Session::flash('verified', 'Tài khoản đã xác thực rồi!!'); 
            return redirect()->route('register');
        }
    }
    // ------------------------------Follow movie--------------------------
    public function follow(Request $request){
        if (isset($request)){
            $movie_follower = new Movie_Follower();
            $movie_follower->movie_id = $request->movie_id;
            $movie_follower->user_id = $request->user_id;
            $movie_follower->save();
            return true;
        }else{
            return false;
        }
    }
    public function unfollow(Request $request){
        if (isset($request)){
            $movie_follower = Movie_Follower::where('movie_id', $request->movie_id)->where('user_id', $request->user_id)->first();
            $movie_follower->delete();
            return true;
        }else{
            return false;
        }
    }
}
