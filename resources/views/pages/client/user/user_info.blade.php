@extends('layout')
@section('content')
<main id="main-contents" class="md:flex block flex-wrap lg:p-20 sm:p-12 p-8 mb-[400px] justify-between">

    {{-- 
        Form left: Thông tin người dùng
            - Chỉ thay đổi được tên.
            - Validate: nhập sai tên, chưa thay đổi giá trị tên -> k submit.  
     --}}
    <div class="form relative md:w-[65%] w-[90%] p-16 bg-black rounded-xl shadow-2xl shadow-black grid gap-y-20">
        <header class="flex justify-center text-blue-600 sm:text-4xl text-2xl font-semibold">
                <span style="text-transform: uppercase;">thông tin người dùng</span>
        </header>
        <div class="box-update-info text-xl flex justify-center">
            {{-- -------------form-------------------- --}}
            <form id="form_update" action="{{route('update_info_user')}}" method="post" class="grid lg:w-1/2 md:w-2/3 w-full gap-y-8">
                <div class="box-group inline-grid gap-y-2">
                    <label for="">Tên</label>
                    <input type="text" name="name_info" id="name_info" class="p-[10px] rounded-lg bg-black border" placeholder="Nhập tên ...." value="{{$user_info->name}}">
                    <span class="message text-lg text-red-500 pl-2 w-full"></span>
                </div>

                {{-- input để so sánh xem đã thay đổi giá trị chưa --}}
                <input type="hidden" id="name_origin" value="{{$user_info->name}}">
                <input id="csrf_token" type="hidden" name="_token" value="{{csrf_token()}}">
                <input id="user_id" type="hidden" name="user_id" value="{{$user_info->id}}">

                <div class="box-groupp inline-grid gap-y-2">
                    <label for="">Email</label>
                    <input type="text" class="p-[10px] rounded-lg bg-black border opacity-50" disabled value="{{$user_info->email}}">
                </div>
                <div class="box-button">
                    <button type="submit" id="save" class="flex justify-center gap-3 px-8 py-4 mt-10 hover:text-white bg-blue-900 w-full font-semibold rounded-xl">
                        Lưu
                    </button>
                </div>
            </form>
            
            {{-- -------------Message------------------------ --}}
            @include('notifications.message', [
                                    'type' => Session::has('success') ? 'success' : '',
                                    'message' => Session::has('success') ? Session::get('success') : ''
                                ])
                                
            {{-- --------------------Validate------------------------------- --}}
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Validator({
                        form: '#form_update',
                        formGroupSelector: '.box-group',
                        errorSelector: '.message',
                        rules: [
                            Validator.isName('#name_info'),
                            Validator.changeValue('#name_info', function () {
                            return document.querySelector('#name_origin').value;
                            }, 'Chưa thay đổi giá trị')
                        ],
                        onSubmit: function (data) {
                            document.getElementById('form_update').submit();
                        }
                    });
                });
            </script>
        </div>
    </div> 

    {{-- 
        Form right: Thông tin ảnh, trạng thái xác thực
            - Thay đổi ảnh.    
    --}}
    <div class="right-info md:w-[33%] w-[90%] md:mt-0 mt-10 bg-black rounded-xl flex justify-center shadow-2xl shadow-black">
        <div class="container p-16">
            <div class="box-avatar w-full flex justify-center">
                <div class="avatar relative w-28 h-28">
                    <img class="rounded-[50%]" src="{{asset('uploads/images/user.jpg')}}" alt="">
                    <div class="camera absolute -bottom-2 right-0 shadow-md shadow-black rounded-xl p-1 text-black bg-red-100 w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                            <path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
                            <path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                        </svg>                   
                    </div>
                </div>
            </div>
            <div class="linked-accounts">
                <div class="unconnect-accounts">
                    <ul class="w-full mt-10 grid gap-5">
                        <li class="facebook-icon bg-zinc-900 w-full hover:bg-zinc-800 cursor-pointer rounded-lg">
                          <a href="#facebook" class="flex items-center justify-between">
                            <button
                              type="button"
                              data-te-ripple-init
                              data-te-ripple-color="light"
                              class="w-20 h-20 flex justify-center items-center rounded-lg px-6 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg"
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
                            <div class="mr-10">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                                </svg> 
                            </div>
                          </a>
                        </li>
                        <li class="github-icon bg-zinc-900 w-full hover:bg-zinc-800 cursor-pointer rounded-lg">
                            <div class="flex items-center justify-between">
                                <button
                                    type="button"
                                    data-te-ripple-init
                                    data-te-ripple-color="light"
                                    class="w-20 h-20 flex justify-center items-center rounded-lg px-6 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg"
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

                                @if ($user_info->github_id)
                                    <input type="hidden" name="github_id" id="github_id" value="{{$user_info->github_id}}">
                                    <div div class="status text-xl font-semibold">
                                        <span>Đã xác thực</span>
                                    </div>

                                    <button id="unlinked_github" class="mr-10">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm3 10.5a.75.75 0 0 0 0-1.5H9a.75.75 0 0 0 0 1.5h6Z" clip-rule="evenodd" />
                                        </svg> 
                                    </button>

                                    <script>
                                        $(document).ready(function() {
                                            $('#unlinked_github').click(function(){
                                                // Hiển thị hộp thoại xác nhận
                                                var result = confirm("Bạn có chắc muốn hủy liên kết chứ?");
                                                var github_id = $('#github_id').val();
                                                var _token = $('#csrf_token').val();
                                                var user_id = $('#user_id').val();
                                                // Nếu người dùng chọn "OK"
                                                if (result) {
                                                    // Thực hiện hàm ajax xử lý
                                                    $.ajax({
                                                        url: '{{route('update_info_user')}}',
                                                        method: 'POST',
                                                        data: { 
                                                            _token: $('#csrf_token').val(),
                                                            user_id: $('#user_id').val(),
                                                            github_id: github_id
                                                        },
                                                        success: function(response) {
                                                            location.reload();
                                                            alert('Đã hủy liên kết với github!!')
                                                        },
                                                        error: function(xhr, status, error) {
                                                            console.log(error);
                                                        }
                                                    });
                                                }
                                            }); 
                                        });
                                    </script>
                                @else
                                    <a href="{{url('/auth/github')}}" class="mr-10">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                                        </svg> 
                                    </a> 
                                @endif
                          </div>
                        </li>
                      </ul>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection