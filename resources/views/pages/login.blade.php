@extends('layout')
@section('content')
<section class="lg:px-20 sm:px-12 px-8 bg-black rounded-lg lg:w-1/2 w-[90%] lg:translate-x-1/2 translate-x-[5%] shadow-lg shadow-black">
    <div class="heading w-full flex justify-center pt-10">
        <h1 class="h-text text-red-200">Đăng nhập</h1>
    </div>
    <form action="{{route('login')}}" method="POST">
        @csrf
        <div class="register_form inline-grid w-full justify-center text-xl">
            @if(Session::has('login_false'))
                <span class="text-red-400 py-4">{{ Session::get('login_false') }}</span>
            @endif
            <div class="inline-grid">
                <span>Tài khoản</span>
                <input type="text" name="account_login" placeholder="Nhập tài khoản ..." class="p-2 rounded-lg text-lg">
            </div>
            <div class="inline-grid">
                <span>Nhập mật khẩu</span>
                <input type="password" name="password_login" placeholder="Nhập mật khẩu ..." class="p-2 rounded-lg text-lg">
            </div>
            <a href="{{route('login_page')}}" class="w-full text-right text-green-300 mt-4 text-xl font-normal underline">Quên mật khẩu</a>
            <div class="w-full flex justify-center mt-10">
                <button type="submit" class="w-full bg-blue-900 text-2xl font-bold p-4 rounded-xl hover:text-white">Đăng nhập</button>
            </div>
        </div>
    </form>
    <div class="w-full flex justify-center text-xl">
        Chưa có tài khoản?&nbsp;
        <a href="{{route('register')}}" class="text-blue-500 underline">Đăng ký</a>
      </div>
    <div class="mt-20 w-full pb-10">
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
            <a href="">
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
</section>
@endsection