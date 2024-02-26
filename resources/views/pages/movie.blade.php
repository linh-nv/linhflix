@extends('layout')
@section('content')
<section id="movie-content" class="">
    <div class="main-movie relative w-full lg:h-full md:h-2/3 sm:h-1/2 h-1/3">
        <div class="backgound-poster-movie w-full h-full flex justify-end relative">
            <img class="sm:w-[70%] w-full" src="{{$movie->image}}" alt="">
        </div>
        <div class="main-movie-content absolute text-white top-1/4 left-[5%] w-[50%]">
            <div class="main-content-title pb-6">
                <h1 class="font-black xl:text-6xl lg:text-5xl sm:text-4xl text-2xl" style="text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.8)">{{$movie->title}}</h1>
            </div>
            <div class="main-content-original_name sm:mb-10">
                <h3 class="font-bold xl:text-3xl lg:text-2xl sm:text-xl text-lg" style="text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.8)">{{$movie->name_eng}}</h3>
            </div>
            @if ($movie->status != 'trailer')
                @if ($movie->category_id === 6)
                    @if ($movie->movie_source == "phimmoi")
                        <a href="{{$startEpisode['linkphim']}}" class="watch-movie flex sm:w-32 w-16 sm:h-16 h-16 sm:rounded-lg rounded-[50%] sm:justify-between justify-center text-center items-center sm:px-4 bg-zinc-200 text-black font-semibold mt-6 transition-all duration-300 ease-linear scroll-smooth relative hover:scale-110">
                            <svg class="w-8 text-red-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" data-slot="icon" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" />
                            </svg>  
                            <span class="sm:flex hidden">Play</span>
                        </a>
                    @else
                        <a href="{{route('watch.episode', ['slug' => $movie->slug, 'episode' => 1])}}" class="watch-movie flex sm:w-32 w-16 sm:h-16 h-16 sm:rounded-lg rounded-[50%] sm:justify-between justify-center text-center items-center sm:px-4 bg-zinc-200 text-black font-semibold mt-6 transition-all duration-300 ease-linear scroll-smooth relative hover:scale-110">
                            <svg class="w-8 text-red-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" data-slot="icon" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" />
                            </svg>  
                            <span class="sm:flex hidden">Play</span>
                        </a>
                    @endif
                @else
                    <a href="{{route('watch', $movie->slug)}}" class="watch-movie flex sm:w-32 w-16 sm:h-16 h-16 sm:rounded-lg rounded-[50%] sm:justify-between justify-center text-center items-center sm:px-4 bg-zinc-200 text-black font-semibold mt-6 transition-all duration-300 ease-linear scroll-smooth relative hover:scale-110">
                        <svg class="w-8 text-red-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" data-slot="icon" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" />
                        </svg>  
                        <span class="sm:flex hidden">Play</span>
                    </a>
                @endif
            @else
                <span class="watch-movie flex sm:w-60 w-44 sm:h-16 h-16 sm:rounded-lg rounded-xl sm:justify-between justify-center text-center items-center sm:px-4 bg-zinc-200 text-black font-semibold mt-6 transition-all duration-300 ease-linear scroll-smooth relative hover:scale-110">
                    <svg class="w-8 text-slate-700 sm:flex hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" data-slot="icon" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" />
                    </svg>  
                    <span class="flex sm:text-xl text-lg">Comming soon</span>
                </span>
            @endif 
        </div>
        
    </div>
    <div class="movie-container flex flex-wrap">
        <div class="movie-container-left lg:w-[70%] w-full">
            @if ($movie->category_id == 6 && $movie->status !== 'trailer') 
                <div class="most-new-episode w-full lg:pl-20 sm:pl-12 pl-8">
                    <div class="heading">
                        <a href="">
                            <span class="h-text">Tập mới nhất</span>
                        </a>
                    </div>
                    <div class="flex">
                        @if ($movie->movie_source == "phimmoi")
                            <a href="{{$lastEpisode['linkphim']}}" class="flex justify-center items-center rounded-lg w-24 h-12 bg-[#4B5563] text-lg font-semibold mr-6 transition-all duration-300 ease-linear scroll-smooth relative hover:scale-110">Tập {{$total_episode}}</a>
                            @if ($recent_episodes > 0)
                                <a href="{{$penultimateEpisode['linkphim']}}" class="flex justify-center items-center rounded-lg w-24 h-12 bg-[#4B5563] text-lg font-semibold mr-6 transition-all duration-300 ease-linear scroll-smooth relative hover:scale-110">Tập {{$recent_episodes}}</a>
                            @endif
                        @else        
                            <a href="{{route('watch.episode', ['slug' => $movie->slug, 'episode'=> $total_episode])}}" class="flex justify-center items-center rounded-lg w-24 h-12 bg-[#4B5563] text-lg font-semibold mr-6 transition-all duration-300 ease-linear scroll-smooth relative hover:scale-110">Tập {{$total_episode}}</a>
                            @if ($recent_episodes > 0)
                                <a href="{{route('watch.episode', ['slug' => $movie->slug, 'episode'=> $recent_episodes])}}" class="flex justify-center items-center rounded-lg w-24 h-12 bg-[#4B5563] text-lg font-semibold mr-6 transition-all duration-300 ease-linear scroll-smooth relative hover:scale-110">Tập {{$recent_episodes}}</a>
                            @endif  
                        @endif
                    </div>
                </div>
            @endif

            {{-- tự cập nhật phim --}}
            @if ($movie->status === 'trailer' || $movie->category_id === 6)
                    <div class="most-new-episode w-full lg:pl-20 sm:pl-12 pl-8">
                        <div class="heading">
                            <a href="">
                                <span class="h-text">Tự cập nhật</span>
                            </a>
                        </div>

                    @if(Session::has('success'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-10 lg:mr-20 sm:mr-12 mr-8" role="alert">
                        <div class="flex">
                            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                            <div>
                                <p class="text-xl">{{ Session::get('success') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(Session::has('no-action'))
                    <div class="bg-orange-100 border-t-4 border-orange-500 rounded-b text-orange-700 px-4 py-3 shadow-md my-10 lg:mr-20 sm:mr-12 mr-8" role="alert">
                        <div class="flex">
                            <div class="py-1"><svg class="fill-current h-6 w-6 text-orange-700 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                            <div>
                                <p class="text-xl">{{ Session::get('no-action') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(Session::has('false'))
                    <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md my-10 lg:mr-20 sm:mr-12 mr-8" role="alert">
                        <div class="flex">
                            <div class="py-1"><svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                            <div>
                                <p class="text-xl">{{ Session::get('false') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="flex">
                        <a href="{{route('updateMovie', $movie->slug)}}" class="flex justify-center items-center rounded-lg w-40 h-12 bg-[#9F5B1B] text-lg font-semibold mr-6 transition-all duration-300 ease-linear scroll-smooth relative hover:scale-110">Cập nhật phim</a>
                    </div>
                </div>
            @endif
            <div class="lg:pl-20 sm:pl-12 pl-8 lg:pr-20 sm:pr-12 pr-8">
                <div class="heading">
                    <a href="">
                        <span class="h-text">Chi tiết phim</span>
                    </a>
                </div>
                <div class="movie-details rounded-xl lg:p-20 sm:p-12 p-8 bg-stone-700">
                    <div class="main-content-title pb-6 flex justify-center">
                        <h1 class="font-black text-3xl text-[#FF9658]">{{$movie->title}}</h1>
                    </div>
                    <div class="main-content-original_name mb-5 flex justify-center">
                        <h3 class="font-bold text-2xl text-[#FF9658]">{{$movie->name_eng}}</h3>
                    </div>
                    <div class="main-content-episode_current py-2 text-xl w-full break-words flex mb-5">
                        <span class="font-semibold text-zinc-400 mr-4  whitespace-nowrap">Trạng thái:</span>
                        <p>{{$movie->episode_current}}</p>
                    </div>
                    <form action="{{route('director')}}" method="GET">
                        <div class="main-content-director py-2 text-xl w-full break-words">
                            <span class="font-semibold text-zinc-400 mr-4  whitespace-nowrap">Đạo diễn:</span>
                            @php
                                $arrDirector = explode(", ", $movie->director);
                            @endphp
                            @foreach ($arrDirector as $director)
                                <a href="{{route('director', ['director' => $director])}}" type="submit" class="hover:text-cyan-600 hover:underline">{{$director}}</a>
                                @if (!$loop->last)
                                    , <!-- Thêm dấu phẩy nếu không phải là actor cuối cùng -->
                                @endif
                            @endforeach
                        </div>
                    </form>
                    <div class="main-content-runtime py-2 text-xl w-full break-words flex mb-5">
                        <span class="font-semibold text-zinc-400 mr-4  whitespace-nowrap">Thời lượng:</span>
                        <p>{{$movie->runtime}}</p>
                    </div>
                    @if ($movie->category_id == 6)
                        <div class="main-content-episode_total py-2 text-xl w-full break-words flex mb-5">
                            <span class="font-semibold text-zinc-400 mr-4  whitespace-nowrap">Số tập:</span>
                            <p>{{$movie->episode_total}}</p>
                        </div>
                    @endif
                    <div class="main-content-subtitle py-2 text-xl w-full break-words flex mb-5">
                        <span class="font-semibold text-zinc-400 mr-4  whitespace-nowrap">Ngôn ngữ:</span>
                        <p>{{$movie->subtitle}}</p>
                    </div>
                    <div class="main-content-year py-2 text-xl w-full break-words flex mb-5">
                        <span class="font-semibold text-zinc-400 mr-4  whitespace-nowrap">Năm sản xuất:</span>
                        <p>{{$movie->year}}</p>
                    </div>
                    <div class="main-content-country py-2 text-xl w-full break-words flex mb-5">
                        <span class="font-semibold text-zinc-400 mr-4  whitespace-nowrap">Quốc gia:</span>
                        <p>{{isset($movie->country->title) ? $movie->country->title : ''}}</p>
                    </div>
                    <div class="main-content-genre py-2 text-xl w-full break-words flex mb-5">
                        <span class="font-semibold text-zinc-400 mr-4  whitespace-nowrap">Thể loại:</span>
                        @foreach ($genre_movie as $gen)
                            <p> {{$gen->genre->title}}</p>
                            @if (!$loop->last)
                                , <!-- Thêm dấu phẩy nếu không phải là actor cuối cùng -->
                            @endif
                        @endforeach

                    </div>
                    <form action="{{route('actor')}}" method="GET">
                        <div class="main-content-actor py-2 text-xl w-full break-words">
                            <span class="font-semibold text-zinc-400 mr-4  whitespace-nowrap">Diễn viên:</span>
                            @php
                                $arrActor = explode(", ", $movie->actor);
                            @endphp
                            @foreach ($arrActor as $actor)
                                <a href="{{route('actor', ['actor' => $actor])}}" type="submit" class="hover:text-cyan-600 hover:underline">{{$actor}}</a>
                                @if (!$loop->last)
                                    , <!-- Thêm dấu phẩy nếu không phải là actor cuối cùng -->
                                @endif
                            @endforeach
                        </div>
                    </form>
                </div>
            </div>
            <div class="lg:pl-20 sm:pl-12 pl-8 lg:pr-20 sm:pr-12 pr-8">
                <div class="heading">
                    <a href="">
                        <span class="h-text">Nội dung phim</span>
                    </a>
                </div>
                <div class="movie-details rounded-xl lg:p-20 sm:p-12 p-8 bg-stone-700">
                    <div class="main-content-des mb-5">
                        <h3 class="text-2xl break-words">{!! html_entity_decode($movie->description) !!}</h3>
                    </div>
                </div>
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
    </div>
    
</section>
<div class="heading lg:pl-20 sm:pl-12 pl-8 lg:pr-16 sm:pr-8 pr-4">
    <a href="" title="Phim mới">
        <span class="h-text">Đề xuất cho bạn</span>
    </a>
</div>
<div class="card-slider relative sm:mx-[20px] mx-[10px]">
    <div class="hot-movie relative w-full overflow-auto select-none lg:h-[450px] sm:h-[350px] h-[300px]" >
        <div class="list-movie absolute flex w-max lg:top-[20px] sm:top-[15px] top-[10px] left-0 sm:gap-[20px] gap-[10px]">
            @foreach ($new_movie->take(15) as $mov) 
            <a href="{{route('movie', $mov->slug)}}" class="item-movie scale-100 {{--lg:w-[300px] sm:w-[200px] w-[150px]--}} lg:h-[400px] sm:h-[300px] h-[250px] transition-all duration-300 ease-linear scroll-smooth relative hover:scale-110 ">
                <img class="rounded-lg w-full h-full" src="{{$mov->poster}}" alt="">
                <div class="movie-name absolute rounded-b-lg left-0 right-0 bottom-0 text-center bg-[rgba(0,0,0,0.7)] py-2">
                    <div class="title text-2xl py-1">{{$mov->title}}</div>
                    <div class="original-name text-xl">{{$mov->name_eng}}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    <div class="hot-movie-button">
        <button class="hot-movie-prev absolute z-10 top-[30%] lg:left-10 sm:left-2 left-1 origin-center bg-[rgba(0,0,0,0.7)] text-7xl sm:h-[100px] h-[80px] sm:w-[50px] w-[40px] rounded-lg transition-all duration-100 ease-linear opacity-50 hover:opacity-100 hover:scale-110">&#10092;</button>
        <button class="hot-movie-next absolute z-10 top-[30%] lg:right-10 sm:right-2 right-1 origin-center bg-[rgba(0,0,0,0.7)] text-7xl sm:h-[100px] h-[80px] sm:w-[50px] w-[40px] rounded-lg transition-all duration-100 ease-linear opacity-50 hover:opacity-100 hover:scale-110">&#10093;</button>
    </div>
</div>
<script>
    //hot movie slider
    document.querySelector('.hot-movie-next').onclick = function () {
    const widthItem = document.querySelector('.item-movie').offsetWidth;
    document.querySelector('.hot-movie').scrollLeft += widthItem + 30;
    };
    document.querySelector('.hot-movie-prev').onclick = function () {
        const widthItem = document.querySelector('.item-movie').offsetWidth;
        document.querySelector('.hot-movie').scrollLeft -= widthItem + 30;
    };
</script>
@endsection