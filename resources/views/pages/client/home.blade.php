@extends('layout')
@section('content')
@include('slider')
<main id="main-contents" class="lg:flex block flex-wrap lg:px-20 sm:px-12 px-8 gap-x-10">
    <div class="content-left lg:w-[70%] w-full">
        <div class="new-movie-heading heading">
            <a href="{{route('category', 'phim-moi')}}" title="Phim mới">
                <span class="h-text">Mới nhất hiện nay</span>
            </a>
        </div>
        <div class="list-movie grid 2xl:grid-cols-6 lg:grid-cols-4 md:grid-cols-3 grid-cols-2 lg:gap-10 md:gap-8 gap-6">
            @foreach ($new_movie->take(12) as $mov) 
                <a href="{{route('movie', $mov->slug)}}" class="movie-item flex scale-100 transition-all duration-300 ease-linear scroll-smooth relative hover:scale-110 ">
                    <img loading="lazy" class="myImage rounded-lg w-full h-full" src="{{$mov->poster}}" alt="">
                    <div title="{{$mov->title}}" class="movie-name absolute rounded-b-lg left-0 right-0 bottom-0 py-2 text-center bg-[rgba(0,0,0,0.8)]">
                        <div class="title text-xl">{{$mov->title}}</div>
                        <div class="original-name text-lg">{{$mov->name_eng}}</div>
                    </div> 
                </a>
            @endforeach
        </div>
        
        <div class="new-movie-heading heading">
            <a href="{{route('category', 'phim-bo')}}" title="Phim bộ">
                <span class="h-text">Phim bộ</span>
            </a>
        </div>
        <div class="list-movie grid 2xl:grid-cols-6 lg:grid-cols-4 md:grid-cols-3 grid-cols-2 lg:gap-10 md:gap-8 gap-6">
            @foreach ($serie_movie->take(12) as $mov) 
                <a href="{{route('movie', $mov->slug)}}" class="movie-item flex scale-100 transition-all duration-300 ease-linear scroll-smooth relative hover:scale-110 ">
                    <img loading="lazy" class="rounded-lg w-full h-full" src="{{$mov->poster}}" alt="">
                    <div title="{{$mov->title}}" class="movie-name absolute rounded-b-lg left-0 right-0 bottom-0 py-2 text-center bg-[rgba(0,0,0,0.8)]">
                        <div class="title text-xl">{{$mov->title}}</div>
                        <div class="original-name text-lg">{{$mov->name_eng}}</div>
                    </div> 
                </a>
            @endforeach
        </div>
        <div class="new-movie-heading heading">
            <a href="{{route('category', 'phim-le')}}" title="Phim lẻ">
                <span class="h-text">Phim lẻ</span>
            </a>
        </div>
        <div class="list-movie grid 2xl:grid-cols-6 lg:grid-cols-4 md:grid-cols-3 grid-cols-2 lg:gap-10 md:gap-8 gap-6">
            @foreach ($singer_movie->take(12) as $mov) 
                <a href="{{route('movie', $mov->slug)}}" class="movie-item flex scale-100 transition-all duration-300 ease-linear scroll-smooth relative hover:scale-110 ">
                    <img loading="lazy" class="rounded-lg w-full h-full" src="{{$mov->poster}}" alt="">
                    <div title="{{$mov->title}}" class="movie-name absolute rounded-b-lg left-0 right-0 bottom-0 py-2 text-center bg-[rgba(0,0,0,0.8)]">
                        <div class="title text-xl">{{$mov->title}}</div>
                        <div class="original-name text-lg">{{$mov->name_eng}}</div>
                    </div> 
                </a>
            @endforeach
        </div>
    </div>

    @include('trending_tab')
    @include('notifications.message',[
                                        'type' => Session::has('success') ? 'success' : '',
                                        'message' => Session::has('success') ? Session::get('success') : ''
                                    ])
</main>
@endsection