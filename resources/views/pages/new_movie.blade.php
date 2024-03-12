@extends('layout')
@section('content')
<main class="container">
    <article class="w-[97%] lg:flex block flex-wrap lg:px-20 sm:px-12 px-8 gap-x-10">
        <div class="content-left lg:w-[70%] w-full mb-60">
            <header class="heading">
                <h2>Thêm phim</h2>
            </header>
            {{-- <form action="{{route('movie_suggest')}}" method="get"> --}}
                <div class="add-movies-request w-full md:w-2/3 2xl:w-1/2 relative">
                    <input id="name_movie" class="bg-[#2D2D2D] w-full pl-6 pr-16 py-2 border border-slate-300 rounded-xl" type="text" name="movie-name" placeholder="Nhập tên phim ...">
                    <button type="submit" id="searchSuggestionsBtn" class="absolute top-0 right-0 h-full px-5 z-10">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>                          
                    </button>
                </div>
            {{-- </form> --}}
            <div class="list-heading hidden my-10 text-2xl font-bold transition-all duration-1000 ease-linear">
                <h3>Danh sách phim (cre: Phimmoi)</h3>
            </div>
            <div class="list-movie-suggest relative">
                <div class="loading hidden transition-all duration-1000 ease-linear">
                    <img src="{{asset('uploads/gif/loading.gif')}}" alt="">
                </div>
                {{-- <a href="" class="item-suggest w-full border border-red-700 pr-8 py-4 flex scale-100 scroll-smooth hover:scale-105 rounded-2xl transition-all duration-300 ease-linear hover:bg-[#151414]">
                    <img class="p-3 w-20" src="https://phimmoiiii.net/wp-content/uploads/2020/12/Sweet-Home-2.jpg" alt="">
                    <div class="item-suggest-content pl-2 w-full relative">
                        <div class="item-title">
                            <p>aaaa</p>
                        </div>
                        <div class="item-year opacity-70 text-xl pb-2">
                            <p>2222</p>
                        </div>
                        <div class="item-des flex flex-wrap w-full opacity-70">
                            <p class="text-lg lg:text-xl truncate flex-wrap w-[90%]">aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                        </div>
                        <div class="isset absolute top-2 right-0 text-red-500 italic text-lg">
                            Chưa có
                        </div>
                    </div>
                </a> --}}
            </div>
        </div>
        <div class="content-right lg:w-[25%] w-full lg:py-0 py-16">
            <div class="trending-heading heading">
                <span class="h-text">TRENDING</span>
            </div>
            <div class="trending-filter lg:w-full sm:w-1/2 w-full border-t border-dashed border-zinc-500 pt-4 pb-10">
                <ul class="trending-tab flex justify-between" role="tablist">
                    <li role="presentation" class="cursor-pointer active-tab flex justify-center text-center w-1/4 show-view-day  mr-2">
                        <a class="py-2 w-full text-2xl font-medium" role="tab" data-toggle="tab" data-showpost="10" data-type="today">Day</a>
                    </li>
                    <li role="presentation" class="cursor-pointer flex justify-center text-center w-1/4 show-view-month mr-2" >
                        <a class="py-2 w-full text-2xl font-medium" role="tab" data-toggle="tab" data-showpost="10" data-type="month">Month</a>
                    </li>
                    <li role="presentation" class="cursor-pointer flex justify-center text-center w-1/4 show-view-year mr-2" >
                        <a class="py-2 w-full text-2xl font-medium" role="tab" data-toggle="tab" data-showpost="10" data-type="week">Year</a>
                    </li>
                    <li role="presentation" class="cursor-pointer flex justify-center text-center w-1/4 show-view-all mr-2" >
                        <a class="py-2 w-full text-2xl font-medium" role="tab" data-toggle="tab" data-showpost="10" data-type="all">All</a>
                    </li>
                </ul>
                </div>
            <div class="trending-list-items">
                <div id="view-by-day" style="display: block">
                    @php
                        $index = 0;
                    @endphp
                    @foreach ($view_day->take(10) as $mov) 
                    @php
                        $index ++;
                    @endphp
                    <a href="{{route('movie', $mov->movie->slug)}}" class="trending-item flex gap-10 mb-10 transition-all duration-300 ease-linear scroll-smooth">
                        <div class="rank flex justify-center text-center items-center font-semibold min-w-[30px] h-[30px] rounded-[50%] bg-[#9E6C50]">
                            <span>{{$index}}</span>
                        </div>
                        <div class="trending-item-content">
                            <div class="trending-item-title">
                                <span>{{$mov->movie->title}}</span>
                            </div>
                            <div class="trending-item-view text-lg pt-2">
                                <span>{{$mov->movie->view}} lượt xem</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <div id="view-by-month" style="display: none">
                    @php
                        $index = 0;
                    @endphp
                    @foreach ($view_month_total->take(10) as $mov) 
                    @php
                        $index ++;
                    @endphp
                    <a href="{{route('movie', $mov->movie->slug)}}" class="trending-item flex gap-10 mb-10 transition-all duration-300 ease-linear scroll-smooth">
                        <div class="rank flex justify-center text-center items-center font-semibold min-w-[30px] h-[30px] rounded-[50%] bg-[#9E6C50]">
                            <span>{{$index}}</span>
                        </div>
                        <div class="trending-item-content">
                            <div class="trending-item-title">
                                <span>{{$mov->movie->title}}</span>
                            </div>
                            <div class="trending-item-view text-lg pt-2">
                                <span>{{$mov->movie->view}} lượt xem</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <div id="view-by-year" style="display: none">
                    @php
                        $index = 0;
                    @endphp
                    @foreach ($view_year_total->take(10) as $mov) 
                    @php
                        $index ++;
                    @endphp
                    <a href="{{route('movie', $mov->movie->slug)}}" class="trending-item flex gap-10 mb-10 transition-all duration-300 ease-linear scroll-smooth">
                        <div class="rank flex justify-center text-center items-center font-semibold min-w-[30px] h-[30px] rounded-[50%] bg-[#9E6C50]">
                            <span>{{$index}}</span>
                        </div>
                        <div class="trending-item-content">
                            <div class="trending-item-title">
                                <span>{{$mov->movie->title}}</span>
                            </div>
                            <div class="trending-item-view text-lg pt-2">
                                <span>{{$mov->movie->view}} lượt xem</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <div id="view-all" style="display: none">
                    @php
                        $index = 0;
                    @endphp
                    @foreach ($view_all_total->take(10) as $mov) 
                    @php
                        $index ++;
                    @endphp
                    <a href="{{route('movie', $mov->movie->slug)}}" class="trending-item flex gap-10 mb-10 transition-all duration-300 ease-linear scroll-smooth">
                        <div class="rank flex justify-center text-center items-center font-semibold min-w-[30px] h-[30px] rounded-[50%] bg-[#9E6C50]">
                            <span>{{$index}}</span>
                        </div>
                        <div class="trending-item-content">
                            <div class="trending-item-title">
                                <span>{{$mov->movie->title}}</span>
                            </div>
                            <div class="trending-item-view text-lg pt-2">
                                <span>{{$mov->movie->view}} lượt xem</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div> 
        </div>
    </article>
</main>
<script>
    document.getElementById("name_movie").addEventListener("keypress", function(event) {
        // Kiểm tra xem phím Enter đã được nhấn
        if (event.key === "Enter") {
            // Ngăn chặn hành vi mặc định của phím Enter (gửi biểu mẫu)
            event.preventDefault();
            // Kích hoạt sự kiện click trên nút tìm kiếm
            document.getElementById("searchSuggestionsBtn").click();
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('button').click(function() {
            $('.list-heading').show();
            $('.loading').show();
            var searchValue = $('#name_movie').val();

            $.ajax({
                url: '{{ route('movie_suggest') }}',
                method: 'GET',
                data: {
                    search: searchValue
                },
                success: function(response) {
                    // Xử lý dữ liệu trả về ở đây
                    displayMovies(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });

        function displayMovies(movies) {
            $('.list-movie-suggest').empty(); // Xóa nội dung cũ
            var $loading = $('<div>').addClass('loading hidden transition-all duration-1000 ease-linear justify-center');
            var $gif = $('<img>').attr('src','{{asset('uploads/gif/loading.gif')}}');
            $loading.append($gif);
            $('.list-movie-suggest').append($loading);
            movies.forEach(function(movie) {
                var str1 = "http://127.0.0.1:8000/phim/";
                var slug = str1 + movie.slug;

                if(movie.isset === 1){
                    var $item = $('<a>').addClass('item-suggest w-full pr-8 py-4 mb-4 flex scale-100 scroll-smooth hover:scale-105 rounded-2xl border-slate-300 transition-all duration-300 ease-linear hover:bg-[#151414]').attr('href', slug);
                    var $status = $('<div>').addClass('status absolute top-2 right-4 text-green-500 italic text-lg').text('Đã có');
                }else{
                    var $item = $('<button>').addClass('item-suggest w-full text-left pr-8 py-4 mb-4 flex scale-100 scroll-smooth hover:scale-105 rounded-2xl border-slate-300 transition-all duration-300 ease-linear hover:bg-[#151414]').attr('type', 'submit');
                    var $status = $('<div>').addClass('status absolute top-2 right-4 text-red-500 italic text-lg').text('Chưa có');

                    var $form = $('<form>').attr('method', 'get').attr('action', '{{route('add_movie')}}');
                    var $link = $('<input>').attr('name', 'link').attr('type', 'hidden').attr('value', movie.link);
                }
                var $img = $('<img>').addClass('p-3 w-20').attr('src', movie.poster).attr('alt', '');
                var $content = $('<div>').addClass('item-suggest-content pl-2 w-full');
                var $title = $('<div>').addClass('item-title w-[60%] lg:w-[90%] truncate flex-wrap').text(movie.name);
                var $year = $('<div>').addClass('item-year opacity-70 text-xl pb-2 w-[90%]').text(movie.year);
                var $description = $('<div>').addClass('item-des flex flex-wrap w-full opacity-70');
                var $descriptionText = $('<p>').addClass('text-lg lg:text-xl truncate flex-wrap w-[90%]').text(movie.description);
                // console.log(movie);

                $content.append($title, $year, $description.append($descriptionText), $status);
                $item.append($img, $content);
                $form ? $form.append($item, $link) : '';
                $('.loading').hide();
                
                $('.list-movie-suggest').append($form ? $form : $item);
            });
        }
    });
    // $('.loading').hide();
</script>
@endsection
