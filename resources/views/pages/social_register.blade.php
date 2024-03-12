@extends('layout')
@section('content')
<section class="lg:px-20 sm:px-12 px-8 bg-black rounded-lg lg:w-1/2 w-[90%] lg:translate-x-1/2 translate-x-[5%] shadow-lg shadow-black relative">
    <div class="heading w-full flex justify-center pt-10">
        <h1 class="h-text text-red-200">Đăng ký</h1>
    </div>

    <div class="register_form inline-grid w-full justify-center text-xl">
        {{------------ kiểm tra email ---------------}}
        {{-- nếu không đăng ký bằng tài khoản google --}}
        @if (empty($email))
            <div id="email_register" class="inline-grid">
                <span>Nhập tài khoản email</span>
                <div class="notification" style="margin-bottom: 0"></div>
                <input id="email_input" type="text" name="email_register" class="p-2 rounded-lg">
                <div class="w-full flex justify-center py-10 items-center">
                    <div class="create_btn_noGG w-full flex justify-center items-center text-center cursor-pointer bg-blue-900 text-2xl font-bold p-4 rounded-xl hover:text-white">
                        Tiếp theo 
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-2 w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>              
                    </div>
                </div>
            </div>
            {{------------- thêm thông tin cơ bản --------}}
            <div id="basic_information" class="hidden">    
                {{-- thêm id social media --}}
                <input id="csrf_token" type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" id="github_data_id" name="github_data_id" value="{{!empty($github_data) ? $github_data->id : ''}}">
                <input type="hidden" id="facebook_data_id" name="facebook_data_id" value="{{!empty($facebook_data) ? $facebook_data->id : ''}}">

                <div class="inline-grid">
                    <span>Nhập tên</span>
                    <input id="name_register" type="text" name="name_register" class="p-2 rounded-lg">
                </div>
                <div class="inline-grid">
                    <span>Nhập mật khẩu</span>
                    <input id="pass_register" type="password" name="pass_register" class="p-2 rounded-lg">
                </div>
                <div class="inline-grid">
                    <span>Nhập lại mật khẩu</span>
                    <input id="re-pass_register" type="password" class="p-2 rounded-lg">
                </div>
                <div class="w-full flex justify-center py-10 items-center">
                    <button id="register_btn" type="submit" class="create_btn_noGG w-full flex justify-center items-center text-center cursor-pointer bg-blue-900 text-2xl font-bold p-4 rounded-xl hover:text-white">Tạo tài khoản</button>
                </div>
            </div>
        {{-- nếu đăng ký bằng google --}}
        @else
            <form action="{{route('create_social_account')}}" method="POST" class="inline-grid w-full justify-center">
                <input id="csrf_token" type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="email_register" value="{{$email}}" class="p-2 rounded-lg">

                <div class="inline-grid">
                    <span>Nhập tên</span>
                    <input id="name_register" type="text" name="name_register" class="p-2 rounded-lg">
                </div>
                <div class="inline-grid">
                    <span>Nhập mật khẩu</span>
                    <input id="pass_register" type="password" name="pass_register" class="p-2 rounded-lg">
                </div>
                <div class="inline-grid">
                    <span>Nhập lại mật khẩu</span>
                    <input id="re-pass_register" type="password" class="p-2 rounded-lg">
                </div>
                <div class="w-full flex justify-center py-10">
                    <button type="submit" class="bg-blue-900 text-2xl font-bold p-4 rounded-xl hover:text-white">Tạo tài khoản</button>
                </div>
            </form>
        @endif
    </div> 
    <div class="verification absolute hidden w-full h-full p-10 bg-black top-0 left-0 rounded-xl text-center items-center justify-center">
        <div class="">
          <div class="heading w-full flex justify-center pt-10">
            <h1 class="text-3xl text-red-200 uppercase">Xác minh tài khoản email</h1>
          </div>
          <p class="text-2xl mt-20">Thư xác minh đã được gửi đến email của bạn. Để hoàn tất đăng ký tài khoản, xin hãy xác nhận tài khoản email</p>
          <div class="flex w-full justify-center mt-20">
            <a href="https://mail.google.com/mail/" class="flex bg-red-900 py-2 px-8 text-2xl font-bold gap-4 rounded-xl items-center hover:text-white hover:bg-red-700">
              <span>Đi đến Mail</span>
              <img class="w-10 h-10" src="{{asset('uploads/images/google-gmail.svg')}}" alt="">
            </a>
          </div>
        </div>
    </div>
    <img src="https://onlinegiftools.com/images/examples-onlinegiftools/netflix-stream-opaque.gif" alt="" class="loading_register hidden absolute w-full h-full bg-black top-0 left-0">

</section>
<script>
    $(document).ready(function() {
        // --------------------- Kiểm tra xem email đã tồn tại chưa ----------------------
        $('#email_register .create_btn_noGG').click(function() {
            $.ajax({
                url: '{{ route('check_email') }}',
                method: 'GET',
                data: {
                    email: $('#email_input').val(),
                },
                success: function(response) {
                    if (response.exists === true) {
                        // Email đã tồn tại
                        $('#email_register .notification').append('<span class="text-red-400">Email đã tồn tại!!</span>');
                        $('#email_input').attr('style', 'border-color: red;')
                    }else if (response.exists === null) {
                        // để trống email
                        $('#email_register .notification').append('<span class="text-red-400">Không được để trống email!!</span>');
                        $('#email_input').attr('style', 'border-color: red;')
                    }
                    else{
                        $('#email_register').hide();
                        $('#basic_information').show();
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
            $('#email_input').attr('style', '')
            $('#email_register .notification').empty();
        });

        //------------------------ Gửi email xác minh --------------------------
        $('#register_btn').click(function() {
            $('.verification').show();
            $('.loading_register').show();

            $.ajax({
                url: '{{ route('email_verification') }}',
                method: 'POST',
                data: {
                    _token: $('#csrf_token').val(),
                    email: $('#email_input').val(),
                    name: $('#name_register').val(),
                    password: $('#pass_register').val(),
                },
                success: function(response) {
                    $('.loading_register').hide();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
    });
</script>
@endsection