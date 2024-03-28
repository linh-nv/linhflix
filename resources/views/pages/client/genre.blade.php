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
    
    @include('trending_tab')

</main>
@endsection