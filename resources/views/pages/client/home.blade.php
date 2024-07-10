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
            {{-- @foreach ($new_movie->take(12) as $mov)  --}}
            
                <a href="{{route('movie', 'hanh-tinh-khi-vuong-quoc-moi')}}" class="movie-item flex scale-100 transition-all duration-300 ease-linear scroll-smooth relative hover:scale-110 ">
                    <img loading="lazy" class="myImage rounded-lg w-full h-full" src="https://img.phimapi.com/upload/vod/20240507-1/569ff6ca8838fb86e397a82f167e6e3b.jpg" alt="">
                    <div title="Hành Tinh Khỉ: Vương Quốc Mới" class="movie-name absolute rounded-b-lg left-0 right-0 bottom-0 py-2 text-center bg-[rgba(0,0,0,0.8)]">
                        <div class="title text-xl">Hành Tinh Khỉ: Vương Quốc Mới</div>
                        <div class="original-name text-lg">Kingdom Of The Planet Of The Apes</div>
                    </div> 
                </a>
            {{-- @endforeach --}}
        </div>
        
    </div>
</main>
@endsection