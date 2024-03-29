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
                <input type="hidden" id="github_data_id" name="github_data_id" value="{{!empty($github_data) ? $github_data->id : null}}">
                <input type="hidden" id="facebook_data_id" name="facebook_data_id" value="{{!empty($facebook_data) ? $facebook_data->id : null}}">

                <div class="form-input-name inline-grid">
                    <span>Nhập tên</span>
                    <input id="name_register" type="text" name="name_register" class="p-2 rounded-lg">
                    <div class="form-notifi"></div>
                </div>
                <div class="form-input-pass inline-grid">
                    <span>Nhập mật khẩu</span>
                    <input id="pass_register" type="password" name="pass_register" class="p-2 rounded-lg">
                    <div class="form-notifi"></div>
                </div>
                <div class="form-input-re_pass inline-grid">
                    <span>Nhập lại mật khẩu</span>
                    <input id="re-pass_register" type="password" class="p-2 rounded-lg">
                    <div class="form-notifi"></div>
                </div>
                <div class="w-full flex justify-center py-10 items-center">
                    <button id="register_social_btn" type="submit" class="create_btn_noGG w-full flex justify-center items-center text-center cursor-pointer bg-blue-900 text-2xl font-bold p-4 rounded-xl hover:text-white">Tạo tài khoản</button>
                </div>
            </div>
        {{-- nếu đăng ký bằng google --}}
        @else
            <form id="register_form" action="{{route('create_social_account')}}" method="POST" class="inline-grid w-full justify-center">
                <input id="csrf_token" type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="email_register" value="{{$email}}" class="p-2 rounded-lg">

                <div class="form-input inline-grid">
                    <span>Nhập tên</span>
                    <input id="name_register" type="text" name="name_register" class="p-2 rounded-lg">
                    <span class="form-notifi text-lg text-red-400"></span>
                </div>
                <div class="form-input inline-grid">
                    <span>Nhập mật khẩu</span>
                    <input id="pass_register" type="password" name="pass_register" class="p-2 rounded-lg">
                    <span class="form-notifi text-lg text-red-400"></span>
                </div>
                <div class="form-input inline-grid">
                    <span>Nhập lại mật khẩu</span>
                    <input id="re-pass_register" type="password" class="p-2 rounded-lg">
                    <span class="form-notifi text-lg text-red-400"></span>
                </div>
                <div class="w-full flex justify-center py-10">
                    <button id="register_google_btn" type="submit" class="bg-blue-900 text-2xl font-bold p-4 rounded-xl hover:text-white">Tạo tài khoản</button>
                </div>
            </form>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Validator({
                    form: '#register_form',
                    formGroupSelector: '.form-input',
                    errorSelector: '.form-notifi',
                    rules: [
                        Validator.isName('#name_register'),
                        Validator.isPassword('#pass_register'),
                        Validator.isRequired('#re-pass_register'),
                        Validator.isConfirmed('#re-pass_register', function () {
                        return document.querySelector('#register_form #pass_register').value;
                        }, 'Mật khẩu nhập lại không chính xác')
                    ],
                    onSubmit: function (data) {
                        // Call API
                        document.querySelector('#register_form').submit();
                    }
                    });
                });
            </script>
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
    
    {{-- loading --}}
    <div class="loading_register absolute w-full h-full bg-black top-0 left-0 flex justify-center items-center">
        <div class="loading_register_send_email"></div>
        <style>
          .loading_register .loading_register_send_email {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 8px solid #d1914b;
            box-sizing: border-box;
            --c:no-repeat radial-gradient(farthest-side, #d64123 94%,#0000);
            --b:no-repeat radial-gradient(farthest-side, #000 94%,#0000);
            background:
              var(--c) 11px 15px,
              var(--b) 6px 15px,    
              var(--c) 35px 23px,
              var(--b) 29px 15px,    
              var(--c) 11px 46px,
              var(--b) 11px 34px,    
              var(--c) 36px 0px,
              var(--b) 50px 31px,
              var(--c) 47px 43px,
              var(--b) 31px 48px,    
              #f6d353; 
            background-size: 15px 15px,6px 6px;
            animation: l4 3s infinite;
          }
          @keyframes l4 {
            0%     {-webkit-mask:conic-gradient(#0000 0     ,#000 0)}
            16.67% {-webkit-mask:conic-gradient(#0000 60deg ,#000 0)}
            33.33% {-webkit-mask:conic-gradient(#0000 120deg,#000 0)}
            50%    {-webkit-mask:conic-gradient(#0000 180deg,#000 0)}
            66.67% {-webkit-mask:conic-gradient(#0000 240deg,#000 0)}
            83.33% {-webkit-mask:conic-gradient(#0000 300deg,#000 0)}
            100%   {-webkit-mask:conic-gradient(#0000 360deg,#000 0)}
          }
        </style>
    </div>

</section>
<script>
    $(document).ready(function() {
      $('.loading_register').hide();

        // --------------------- Kiểm tra xem email đã tồn tại chưa ----------------------
        $('#email_register .create_btn_noGG').click(function() {
            $('#email_input').attr('style', '');
            $('#email_register .notification').empty();
            const email = $('#email_input').val();
            // Kiểm tra định dạng email bằng regex
            if (!validateEmail(email)) {
                // Định dạng email không hợp lệ, hiển thị thông báo và ngăn chặn tiếp tục xử lý
                $('#email_register .notification').append('<span class="text-red-400">Email không hợp lệ!!</span>');
                $('#email_input').attr('style', 'border-color: red;');
                return;
            }else{
                $.ajax({
                    url: '{{ route('check_email') }}',
                    method: 'GET',
                    data: {
                        email: email,
                    },
                    success: function(response) {
                        if (response.exists === true) {
                            // Email đã tồn tại
                            $('#email_register .notification').append('<span class="text-red-400">Email đã tồn tại!!</span>');
                            $('#email_input').attr('style', 'border-color: red;')
                        }else{
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
            }
        });
        //------------------------ Gửi email xác minh --------------------------
        $('#register_social_btn').click(function() {
            $('#name_register').attr('style', '');
            $('#pass_register').attr('style', '');
            $('#re-pass_register').attr('style', '');
            $('.form-notifi').empty();
            // Lấy giá trị các trường
            const email = $('#email_input').val();
            const name = $('#name_register').val();
            const password = $('#pass_register').val();
            const re_password = $('#re-pass_register').val();
            const github_data = $('#github_data_id').val();
            const facebook_data = $('#facebook_data_id').val();
            if (!validateName(name) || !validatePassword(password) || re_password !== password || re_password === '') {
                if (!validateName(name)) {
                    $('.form-input-name .form-notifi').append(
                        '<span class="text-lg text-red-400">Tên không hợp lệ!!</span>',
                    );
                    $('#name_register').attr('style', 'border-color: red;');
                }
                if (!validatePassword(password)) {
                    $('.form-input-pass .form-notifi').append(
                        '<span class="text-lg text-red-400">Mật khẩu phải trên 8 ký tự, phải có một chữ cái viết thường, một chữ cái viết hoa và một số!!</span>',
                    );
                    $('#pass_register').attr('style', 'border-color: red;');
                }
                if (re_password !== password || re_password === '') {
                    $('.form-input-re_pass .form-notifi').append(
                        '<span class="text-lg text-red-400">Nhập lại mật khẩu không chính xác!!</span>',
                    );
                    $('#re-pass_register').attr('style', 'border-color: red;');
                }

                return;
            } else {

            // Nếu các trường đều hợp lệ, gửi request AJAX
            // Ẩn verification và hiện loading
            $('.verification').show();
            $('.loading_register').show();

            $.ajax({
                url: '{{ route('email_verification') }}',
                method: 'POST',
                data: {
                    _token: $('#csrf_token').val(),
                    email: email,
                    name: name,
                    password: password,
                    github_data: github_data,
                    facebook_data: facebook_data,
                },
                success: function(response) {
                    $('.loading_register').hide();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
            }
        });
    });
    // Hàm kiểm tra định dạng email
    function validateEmail(email) {
    const regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    return regex.test(email);
    }

    // Hàm kiểm tra trường tên
    function validateName(name) {
        const regex = /^[a-zA-ZÀ-ỹ ]{2,30}$/; // Chỉ chấp nhận ký tự chữ, khoảng trắng, từ 2 đến 30 ký tự
        return regex.test(name);
    }

    // Hàm kiểm tra trường mật khẩu
    function validatePassword(password) {
        const regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/; // Ít nhất 8 ký tự, ít nhất một chữ cái viết thường, ít nhất một chữ cái viết hoa và ít nhất một số
        return regex.test(password);
    }
</script>
@endsection