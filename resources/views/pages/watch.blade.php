@extends('layout')
@section('content')
<section id="watch-movie" class="w-full lg:px-60">
    <div class="my-20 sm:h-[40rem] h-[20rem] flex justify-center lg:pl-20 sm:pl-12 lg:pr-20 sm:pr-12">
        @if(!isset($movie_trailer))
            {{-- phim bo --}}
            @if ($movie->category_id == 6)
                <iframe width="100%" height="100%" src="{{$movie_episode->linkphim}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            {{-- phim le --}}
            @else
                <iframe width="100%" height="100%" src="{{$episode->linkphim}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            @endif
        {{-- trailer --}}
        @else
            @php
            // Link YouTube ban đầu
            $originalLink = $movie->trailer;
            // Chuyển đổi thành link nhúng
            $embedLink = str_replace("youtube.com/watch?v=", "youtube.com/embed/", $originalLink);
            @endphp
            <iframe width="100%" height="100%" src="{{$embedLink}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        @endif

    </div>
    <div class="heading">
        <span>
            @if ($movie->category_id == 6)
                <span class="h-text w-full flex justify-center text-[#FF9658] mb-4">{{$movie->title ." tập ".$episode}}</span>
            @else
                <span class="h-text w-full flex justify-center text-[#FF9658] mb-4">{{$movie->title}}</span>
            @endif
            <span class="w-full flex justify-center text-xl">( {{$movie->name_eng}} )</span>
        </span>
    </div>
    @if ($movie->category_id == 6 && !isset($movie_trailer)) 
        <div class="most-new-episode w-full lg:pl-20 sm:pl-12 pl-8">
            <div class="heading">
                <span>
                    <span class="h-text">Danh sách tập</span>
                </span>
            </div>
            <div class="flex flex-wrap gap-4">
                @if (count($total_episode) > 50)
                    @for ($i = count($total_episode); $i >= 1 ; $i--)
                        <a href="{{ route('watch.episode', ['slug' => $movie->slug, 'episode' => $i]) }}" class="flex justify-center items-center rounded-lg w-24 h-12 {{ $episode == $i ? 'bg-[#A3765D] text-[#fff]' : 'bg-[#4B5563]' }} text-lg font-semibold mr-6 transition-all duration-300 ease-linear scroll-smooth relative hover:scale-110">Tập {{$i}}</a>
                                                    
                    @endfor
                @else
                    @for ($i = 1; $i <= count($total_episode); $i++)
                        <a href="{{ route('watch.episode', ['slug' => $movie->slug, 'episode' => $i]) }}" class="flex justify-center items-center rounded-lg w-24 h-12 {{ $episode == $i ? 'bg-[#A3765D] text-[#fff]' : 'bg-[#4B5563]' }} text-lg font-semibold mr-6 transition-all duration-300 ease-linear scroll-smooth relative hover:scale-110">Tập {{$i}}</a>                               
                    @endfor
                @endif
            </div>
        </div>
    @endif
    <div class="lg:pl-20 sm:pl-12 pl-8 lg:pr-20 sm:pr-12 pr-8">
        <div class="heading">
            <span>
                <span class="h-text">Chi tiết phim</span>
            </span>
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
            <div class="main-content-director py-2 text-xl w-full break-words flex mb-5">
                <span class="font-semibold text-zinc-400 mr-4  whitespace-nowrap">Đạo diễn:</span>
                <p>{{$movie->director}}</p>
            </div>
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
            <div class="main-content-actor py-2 text-xl w-full break-words">
                <span class="font-semibold text-zinc-400 mr-4  whitespace-nowrap">Diễn viên:</span>
                <p>{{$movie->actor}}</p>
            </div>
        </div>
    </div>
    <div class="lg:pl-20 sm:pl-12 pl-8 lg:pr-20 sm:pr-12 pr-8 pb-60">
        <div class="heading">
            <span>
                <span class="h-text">Noi dung phim</span>
            </span>
        </div>
        <div class="movie-details rounded-xl lg:p-20 sm:p-12 p-8 bg-stone-700">
            <div class="main-content-des mb-5">
                <h3 class="text-2xl break-words">{!! html_entity_decode($movie->description) !!}</h3>
            </div>
        </div>
    </div>
</section>
@endsection
