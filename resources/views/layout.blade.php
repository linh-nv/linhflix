<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {{-- @vite('resources/css/app.css') --}}
  <title>Linh phim</title>
  <meta name="description" content="Linh phim" />
  <meta property="og:title" content="Linh phim" />
  <meta property="og:description" content="Linh phim - Xem phim hay nhất, phim hay trung quốc, hàn quốc, việt nam, mỹ, hong kong , chiếu rạp" />
  <link rel="icon" href="{{asset('uploads/images/netflix-logo.png')}}" type="image/png">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body class="text-slate-300 bg-zinc-900 relative">

  {{-- ----------------load mỗi khi chuyển trang---------------------- --}}
  <style>
    /* loading */
    #loading .loader {
      width: 35px;
      height: 80px;
      position: relative;
    }
    .loader:after {
      content: "";
      position: absolute;
      inset: 0 0 20px;
      border-radius: 50px 50px 10px 10px;
      padding: 1px;
      background: linear-gradient(#ff4d80 33%,#ffa104 0 66%, #01ddc7 0) content-box;
      --c:radial-gradient(farthest-side,#000 94%,#0000);
      -webkit-mask:
        linear-gradient(#0000 0 0),
        var(--c) -10px -10px,
        var(--c)  15px -14px,
        var(--c)   9px -6px,
        var(--c) -12px  9px,
        var(--c)  14px  9px,
        var(--c)  23px 27px,
        var(--c)  -8px 35px,
        var(--c)   50% 50%,
        linear-gradient(#000 0 0);
      mask:
        linear-gradient(#000 0 0),
        var(--c) -10px -10px,
        var(--c)  15px -14px,
        var(--c)   9px -6px,
        var(--c) -12px  9px,
        var(--c)  14px  9px,
        var(--c)  23px 27px,
        var(--c)  -8px 35px,
        var(--c)   50% 50%,
        linear-gradient(#0000 0 0);
      -webkit-mask-composite: destination-out;
      mask-composite: exclude,add,add,add,add,add,add,add,add;
      -webkit-mask-repeat: no-repeat;
      animation: l3 3s infinite ;
    }
    .loader:before {
      content: "";
      position: absolute;
      inset: 50% calc(50% - 4px) 0;
      background: #e0a267;
      border-radius: 50px;
    }
    @keyframes l3 {
    0%   {-webkit-mask-size: auto,0 0,0 0,0 0,0 0,0 0,0 0,0 0,0 0}
    10%  {-webkit-mask-size: auto,25px 25px,0 0,0 0,0 0,0 0,0 0,0 0,0 0}
    20%  {-webkit-mask-size: auto,25px 25px,25px 25px,0 0,0 0,0 0,0 0,0 0,0 0}
    30%  {-webkit-mask-size: auto,25px 25px,25px 25px,30px 30px,0 0,0 0,0 0,0 0,0 0}
    40%  {-webkit-mask-size: auto,25px 25px,25px 25px,30px 30px,30px 30px,0 0,0 0,0 0,0 0}
    50%  {-webkit-mask-size: auto,25px 25px,25px 25px,30px 30px,30px 30px,25px 25px,0 0,0 0,0 0}
    60%  {-webkit-mask-size: auto,25px 25px,25px 25px,30px 30px,30px 30px,25px 25px,25px 25px,0 0,0 0}
    70%  {-webkit-mask-size: auto,25px 25px,25px 25px,30px 30px,30px 30px,25px 25px,25px 25px,25px 25px,0 0}
    80%,
    100% {-webkit-mask-size: auto,25px 25px,25px 25px,30px 30px,30px 30px,25px 25px,25px 25px,25px 25px,200% 200%}
    }
  </style>
  <loading id="loading" class="fixed top-0 left-0 overflow-hidden w-full h-full z-[9999] transition duration-300">
    <div class="w-full h-full flex justify-center items-center bg-black opacity-70">
      <div class="loader"></div>
    </div>
  </loading>


  {{-- --------------------form đăng nhập------------------------------ --}}
  <div id="loggin-form" class="hidden fixed top-0 left-0 overflow-hidden w-full h-full z-50 transition duration-300 py-3 shadow-black shadow-xl">
    <div class="form relative md:w-1/2 w-[90%] md:translate-x-1/2 translate-x-[5%] translate-y-[20%] p-10 bg-black rounded-xl flex justify-center shadow-2xl shadow-black">
      <div class="loggin w-full"> 
        <div class="flex justify-center">
          <h3 class="text-4xl font-bold text-blue-300">Đăng nhập</h3>
        </div>
        <form id="form-login" action="{{route('login')}}" method="post" class="flex justify-center">
          @csrf
          <div class="form-group mt-20 text-xl font-semibold xl:max-w-[400px] sm:max-w-[300px] w-full">
            <div class="form-input mb-5">
              <input id="email" type="text" name="account_login" class="text-lg p-4 rounded-xl bg-transparent border mt-2 w-full" required>
              <label class="label">Email</label>
              <span class="message text-lg text-red-500 pl-2 w-full">&nbsp;</span>
            </div>
            <div class="form-input">
              <input id="password" type="password" name="password_login" class="text-lg p-4 rounded-xl bg-transparent border mt-2 w-full" required>
              <label class="label">Mật khẩu</label>
              <span class="message text-lg text-red-500 pl-2 w-full">&nbsp;</span>
            </div>
            <div class="w-full text-right text-green-300 mt-4 text-lg font-normal underline">
              <a href="{{route('login_page')}}" class="">Quên mật khẩu</a>
            </div>
            <div class="w-full flex justify-center">
              <button type="submit"class="w-full bg-blue-900 mt-10 p-4 rounded-2xl hover:text-white transition duration-200">Đăng nhập</button>
            </div>
          </div>
        </form>
        <script>
          document.addEventListener('DOMContentLoaded', function () {
              Validator({
              form: '#form-login',
              formGroupSelector: '.form-input',
              errorSelector: '.message',
              rules: [
                Validator.isEmail('#email'),
                Validator.isPassword('#password',"Mật khẩu không hợp lệ!!"),
              ],
              onSubmit: function (data) {
                document.getElementById('form-login').submit();
              }
            });
          });
        </script>
        <div class="w-full flex justify-center text-xl mt-5">
          Chưa có tài khoản?&nbsp;
          <a href="{{route('register')}}" class="text-blue-500 underline">Đăng ký</a>
        </div>
        <div class="mt-20 w-full">
          <div class="flex justify-center">
            <h5 class="text-2xl font-semibold">Hoặc đăng nhập bằng ....</h5>
          </div>
          <ul class="w-full flex justify-center mt-10">
            <li class="facebook-icon">
              <a href="">
                <button
                  type="button"
                  data-te-ripple-init
                  data-te-ripple-color="light"
                  class="w-20 h-20 mb-2 flex justify-center items-center rounded px-6 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg"
                  style="background-color: #1877f2">
                  <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-8 w-8"
                  fill="currentColor"
                  viewBox="0 0 24 24">
                  <path
                  d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                  </svg>
                </button>
              </a>
            </li>
            <li class="google-icon sm:mx-20 mx-10">
              <a href="{{url('/auth/google')}}">
                <button
                  type="button"
                  data-te-ripple-init
                  data-te-ripple-color="light"
                  class="w-20 h-20 mb-2 flex justify-center items-center rounded px-6 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg"
                  style="background-color: #ea4335">
                  <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-8 w-8"
                  fill="currentColor"
                  viewBox="0 0 24 24">
                  <path
                  d="M7 11v2.4h3.97c-.16 1.029-1.2 3.02-3.97 3.02-2.39 0-4.34-1.979-4.34-4.42 0-2.44 1.95-4.42 4.34-4.42 1.36 0 2.27.58 2.79 1.08l1.9-1.83c-1.22-1.14-2.8-1.83-4.69-1.83-3.87 0-7 3.13-7 7s3.13 7 7 7c4.04 0 6.721-2.84 6.721-6.84 0-.46-.051-.81-.111-1.16h-6.61zm0 0 17 2h-3v3h-2v-3h-3v-2h3v-3h2v3h3v2z"
                  fill-rule="evenodd"
                  clip-rule="evenodd" />
                  </svg>
                </button>
              </a>
            </li>
            <li class="github-icon">
              <a href="{{url('/auth/github')}}">
                <button
                  type="button"
                  data-te-ripple-init
                  data-te-ripple-color="light"
                  class="w-20 h-20 mb-2 flex justify-center items-center rounded px-6 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg"
                  style="background-color: #333">
                  <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-8 w-8"
                  fill="currentColor"
                  viewBox="0 0 24 24">
                  <path
                  d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                  </svg>
                </button>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div id="close-btn" class="absolute top-10 right-10 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-red-200 hover:text-red-600">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>        
      </div>
    </div>
  </div>


  {{-- --------------------navbar-------------------------------------- --}}
  <nav id="header" class="z-[999999] fixed justify-between bg-black backdrop-blur-[5px] w-full h-24 flex items-center px-2 transition duration-300 py-3" >
    {{-- ---------------menu btn androi-----------------------}}
    <div class="menu lg:hidden mx-6">
      <i class="menu-icon text-3xl cursor-pointer">
          <svg id="icon1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
          </svg>

          <svg id="icon2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
      </i>
    </div>

    {{-- -----------------navbar content left--------------------------- --}}
    <div class="flex justify-normal">
      <div class="logo flex items-center lg:mr-20 lg:px-5 font-black text-red-600">
        <a href="{{route('home')}}">
          <span>LINHPHIM</span>
        </a>
      </div>
      <div class="nav-links 2xl:text-2xl text-xl lg:static lg:min-h-fit absolute lg:bg-transparent bg-black top-[-100vh] left-0 lg:w-auto w-full flex items-center lg:py-0 py-8">
        <ul class="flex lg:flex-row flex-col lg:items-center font-semibold pl-10">
          <li class="lg:px-8 w-[100%] whitespace-nowrap relative group" id="theloai">
            <span class="py-5 cursor-pointer hover:text-white px-3 flex lg:justify-between items-center">Thể loại   
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" data-slot="icon" class="w-4 h-4 ml-3 lg:hidden">
                    <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>            
            </span>
            <ul class="lg:overflow-y-hidden overflow-y-scroll rounded-xl lg:max-h-[100vh] max-h-[30vh] lg:absolute lg:grid lg:grid-cols-4 gap-4 w-[50vw] h-[60vh] hidden top-20 lg:p-16 p-4 lg:left-[-50%] left-0 lg:text-xl text-lg bg-black lg:opacity-0 opacity-100 lg:invisible lg:group-hover:opacity-100 lg:group-hover:visible transition-all duration-300 ease-in-out">
              @foreach ($genre as $gen)
                <li class="py-2 hover:text-white p-3"><a href="{{route('genre', $gen->slug)}}">{{$gen->title}}</a></li>  
              @endforeach  
            </ul>
          </li>
          <li class="lg:px-8 w-[100%] whitespace-nowrap relative group" id="quocgia">
              <span class="py-5 cursor-pointer hover:text-white px-3 flex lg:justify-between items-center">Quốc gia   
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" data-slot="icon" class="w-4 h-4 ml-3 lg:hidden">
                      <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                  </svg>            
              </span>
              <ul class="lg:overflow-y-hidden overflow-y-scroll rounded-xl lg:max-h-[100vh] max-h-[30vh] lg:absolute lg:grid lg:grid-cols-4 gap-4 w-[50vw] h-[60vh] hidden top-20 lg:p-16 p-4 lg:left-[-50%] left-0 lg:text-xl text-lg bg-black lg:opacity-0 opacity-100 lg:invisible lg:group-hover:opacity-100 lg:group-hover:visible transition-all duration-300 ease-in-out">
                @foreach ($country as $count)
                  <li class="py-2 hover:text-white p-3"><a href="{{route('country', $count->slug)}}">{{$count->title}}</a></li>  
                @endforeach
              </ul>
          </li>   
          @foreach ($category as $cate) 
          <li class="py-5 lg:px-8 w-[100%] whitespace-nowrap"><a href="{{route('category', $cate->slug)}}" class="hover:text-white px-3">{{$cate->title}}</a></li>
          @endforeach
          <li class="py-5 lg:px-8 w-[100%] whitespace-nowrap"><a href="{{route('new_movie')}}" class="text-blue-500 hover:text-blue-300 px-3">Thêm phim</a></li>
        </ul>
      </div>
    </div>

    {{-- -----------------navbar content right--------------------- --}}
    <div class="flex items-center gap-6 2xl:pl-20 lg:justify-end h-full">

      {{-- -------------------------search form------------------------- --}}
      <form id="search-form" role="search" action="{{route('search')}}" method="GET">
        <div class="search">
          <div class="relative flex items-center">
            <input id="search-text" name="search" class="absolute w-10 top-[-5px] right-0 pl-6 pr-6 py-2 bg-transparent text-lg ease-linear duration-300" type="text" placeholder="......"  autocomplete="off">
            <i id="search-icon" class="z-10 cursor-pointer pr-2 relative">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
              </svg>
            </i>
            </div>
        </div>
      </form>

      {{-- -------------------------user form------------------------- --}}
      <div class="user relative group">
        <div class="icon lg:p-5 lg:mx-5 h-full flex items-center cursor-pointer hover:text-white">
            @if(Session::has('user'))
              <img src="{{asset('uploads/images/user.jpg')}}" alt="" class="h-8 rounded-[50%]">
            @else
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                  <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
              </svg>   
            @endif              
        </div>
        <ul class="w-96 bg-black absolute lg:top-20 top-14 -right-2 p-5 rounded-xl font-medium invisible group-hover:visible transition-all duration-300 ease-in-out">
          @if(!Session::has('user'))
            <div class="unlogged">
                <li id="sign-in" class="cursor-pointer flex items-center gap-4 bg-slate-600 p-4 mt-4 rounded-xl hover:text-white">
                    <i class="icon-user">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                      </svg>                                             
                    </i>
                    <span class="text-xl">Đăng nhập</span>
                </li>
                <a href="{{route('register')}}">
                  <li id="sign-up" class="cursor-pointer flex items-center gap-4 bg-slate-600 p-4 mt-4 rounded-xl hover:text-white">
                      <i class="icon-user">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>                                              
                      </i>
                      <span class="text-xl">Đăng ký</span>
                  </li>
                </a>
            </div>
          @else
            @php
                $user = Session::get('user');
            @endphp
            <div class="logged">    
              <li class="flex items-center gap-4 p-4">
                  <img src="{{asset('uploads/images/user.jpg')}}" alt="" class="h-16 rounded-[50%]">
                  <span class="text-2xl font-semibold truncate">{{$user->name}}</span>
              </li>
              <a href="{{route('user_info')}}">
                  <li class="flex items-center gap-4 bg-slate-600 p-4 mt-4 rounded-xl hover:text-white">
                      <i class="icon-user">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                              <path fill-rule="evenodd" d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 0 0-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 0 0-2.282.819l-.922 1.597a1.875 1.875 0 0 0 .432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 0 0 0 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 0 0-.432 2.385l.922 1.597a1.875 1.875 0 0 0 2.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 0 0 2.28-.819l.923-1.597a1.875 1.875 0 0 0-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 0 0 0-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 0 0-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 0 0-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 0 0-1.85-1.567h-1.843ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z" clip-rule="evenodd" />
                          </svg>                           
                      </i>
                      <span class="text-xl">Cài đặt thông tin cá nhân</span>
                  </li>
              </a>
              <a href="{{route('follow_page')}}">
                  <li class="flex items-center gap-4 bg-slate-600 p-4 mt-4 rounded-xl hover:text-red-200 text-red-300">
                      <i class="icon-user">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                              <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                          </svg>              
                      </i>
                      <span class="text-xl">Phim đã thích</span>
                  </li>
              </a>
              <a href="">
                  <li class="flex items-center gap-4 bg-slate-600 p-4 mt-4 rounded-xl hover:text-white">
                      <i class="icon-user">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                              <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                          </svg>              
                      </i>
                      <span class="text-xl">Đổi mật khẩu</span>
                  </li>
              </a>
              <a href="{{route('logout')}}">
                  <li class="flex items-center gap-4 bg-slate-600 p-4 mt-4 rounded-xl hover:text-white">
                      <i class="icon-user">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                              <path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 0 0 6 5.25v13.5a1.5 1.5 0 0 0 1.5 1.5h6a1.5 1.5 0 0 0 1.5-1.5V15a.75.75 0 0 1 1.5 0v3.75a3 3 0 0 1-3 3h-6a3 3 0 0 1-3-3V5.25a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3V9A.75.75 0 0 1 15 9V5.25a1.5 1.5 0 0 0-1.5-1.5h-6Zm10.72 4.72a.75.75 0 0 1 1.06 0l3 3a.75.75 0 0 1 0 1.06l-3 3a.75.75 0 1 1-1.06-1.06l1.72-1.72H9a.75.75 0 0 1 0-1.5h10.94l-1.72-1.72a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                          </svg>              
                      </i>
                      <span class="text-xl">Đăng xuất</span>
                  </li>
              </a>
            </div>
          @endif
        </ul>
     </div>
    </div>
  </nav>

  <div class="pt-24"></div>
  
  @yield('content')

  <div class="bg-slate-400 w-full h-2 mt-80"></div>
  <footer id="footer" class="bg-black h-96 flex items-center sm:px-24 px-12 sm:text-2xl text-lg">
      <div class="footer-content-left sm:w-[50px] w-[40px] sm:mr-10 mr-4">
        <img class="w-full h-full object-cover rounded-lg" src="{{asset('uploads/images/netflix-logo.png')}}" alt="">
      </div>
      <div class="footer-content-right grid">
        <span>Made by Linh</span>
        <div class="contacts flex pt-4">
          <span class="">Contacts me:</span>
          <div class="flex items-center px-4 text-blue-700">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
              <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 0 1 3.5 2h1.148a1.5 1.5 0 0 1 1.465 1.175l.716 3.223a1.5 1.5 0 0 1-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 0 0 6.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 0 1 1.767-1.052l3.223.716A1.5 1.5 0 0 1 18 15.352V16.5a1.5 1.5 0 0 1-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 0 1 2.43 8.326 13.019 13.019 0 0 1 2 5V3.5Z" clip-rule="evenodd" />
            </svg>          
            <span class="pl-2">0866678297</span>
          </div>
        </div>
        <div class="flex pt-4 items-center">
          <span class="pr-2">Cam on vi da den</span>
          <i class="text-red-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 1 0 9.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1 1 14.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
            </svg>
          </i>
        </div>
      </div>
  </footer> 
</body>

<script src="{{asset('js/index.js')}}"></script>
<script src="{{asset('js/header.js')}}"></script>
<script src="{{asset('js/trending_tab.js')}}"></script>
<script src="{{asset('js/validator.js')}}"></script>

{{-- hiệu ứng ấn vào icon tìm kiếm --}}
<script>
  const searchText = document.getElementById('search-text');
  const searchIcon = document.getElementById('search-icon');
  searchText.classList.add('w-10');
  let isSearchVisible = true;

  document.addEventListener('DOMContentLoaded', function () {
      searchIcon.addEventListener('click', function () {
          if (isSearchVisible) {
              searchText.classList.remove('w-10');
              searchText.classList.add('w-[10rem]');
              searchText.classList.add('md:w-[15rem]');
              searchText.classList.add('2xl:w-[22rem]');
              searchText.classList.add('border');
              searchText.classList.add('border-white');
              searchText.classList.add('rounded-md');
          } else {
              searchText.classList.add('w-10');
              searchText.classList.remove('border');
              searchText.classList.remove('border-white');
              searchText.classList.remove('rounded-md');
              searchText.classList.remove('w-[10rem]');
              searchText.classList.remove('md:w-[15rem]');
              searchText.classList.remove('2xl:w-[22rem]');
          }
          isSearchVisible = !isSearchVisible;
      });
  });
</script>
</html>