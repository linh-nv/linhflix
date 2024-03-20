@extends('layout')
@section('content')
<main id="main-contents" class="lg:flex block flex-wrap lg:px-20 sm:px-12 px-8 gap-x-10">
    <div class="content-left lg:w-[70%] w-full">
        <div class="new-movie-heading heading">
            <a href="" title="Phim mới">
                <span class="h-text">Thể loại:</span><span style="text-transform: uppercase;color: #F89357"> {{$gen_slug->title}}</span>
            </a>
        </div>
        <div class="list-movie grid 2xl:grid-cols-6 lg:grid-cols-4 md:grid-cols-3 grid-cols-2 lg:gap-10 md:gap-8 gap-6">
        @foreach ($movie as $mov) 
            <a href="{{route('movie', $mov->slug)}}" class="movie-item flex scale-100 transition-all duration-300 ease-linear scroll-smooth relative hover:scale-110 ">
                <img class="rounded-lg w-full h-full object-cover" src="{{$mov->poster}}" alt="">
                <div class="movie-name absolute rounded-b-lg left-0 right-0 bottom-0 py-2 text-center bg-[rgba(0,0,0,0.8)]">
                    <div class="title text-xl">{{$mov->title}}</div>
                    <div class="original-name text-lg">{{$mov->name_eng}}</div>
                </div> 
            </a>
        @endforeach
        </div> 

        {{ $movie->links('vendor.pagination.pagination') }}     

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
</main>
@endsection