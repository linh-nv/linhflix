<section id="slider-hotmovie" class="lg:h-screen md:h-[66.666vh] sm:h-[50vh] h-[33.333vh] overflow-hidden">
    <div class="slider">
        <div class="list">

            <a class="item" href="{{route('movie','hanh-tinh-khi-vuong-quoc-moi')}}">
                <img  class="w-full h-full" src="https://img.phimapi.com/upload/vod/20240507-1/569ff6ca8838fb86e397a82f167e6e3b.jpg" alt="">
                <div class="content">
                    <div class="title lg:text-7xl md:text-5xl sm:text-3xl text-2xl">
                        <h1 class="break-words">
                            Hành Tinh Khỉ: Vương Quốc Mới
                        </h1>
                    </div>
                    <div class="des lg:text-4xl md:text-2xl sm:text-xl text-lg">
                        <p>
                            Kingdom Of The Planet Of The Apes
                        </p>
                    </div>
                </div>
            </a>
            <a class="item" href="{{route('movie','hanh-tinh-khi-vuong-quoc-moi')}}">
                <img  class="w-full h-full" src="https://img.phimapi.com/upload/vod/20240507-1/569ff6ca8838fb86e397a82f167e6e3b.jpg" alt="">
                <div class="content">
                    <div class="title lg:text-7xl md:text-5xl sm:text-3xl text-2xl">
                        <h1 class="break-words">
                            Hành Tinh Khỉ: Vương Quốc Mới
                        </h1>
                    </div>
                    <div class="des lg:text-4xl md:text-2xl sm:text-xl text-lg">
                        <p>
                            Kingdom Of The Planet Of The Apes
                        </p>
                    </div>
                </div>
            </a>            <a class="item" href="{{route('movie','hanh-tinh-khi-vuong-quoc-moi')}}">
                <img  class="w-full h-full" src="https://img.phimapi.com/upload/vod/20240507-1/569ff6ca8838fb86e397a82f167e6e3b.jpg" alt="">
                <div class="content">
                    <div class="title lg:text-7xl md:text-5xl sm:text-3xl text-2xl">
                        <h1 class="break-words">
                            Hành Tinh Khỉ: Vương Quốc Mới
                        </h1>
                    </div>
                    <div class="des lg:text-4xl md:text-2xl sm:text-xl text-lg">
                        <p>
                            Kingdom Of The Planet Of The Apes
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="buttons">
            <button id="prev"><</button>
            <button id="next">></button>
        </div>
        <ul class="dots">
            <li class="active"></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul> 
    </div>
</section>
<div class="heading lg:pl-20 sm:pl-12 pl-8 lg:pr-16 sm:pr-8 pr-4">
    <a href="" title="Phim mới">
        <span class="h-text">Đề xuất cho bạn</span>
    </a>
</div>
<div class="card-slider relative sm:mx-[20px] mx-[10px]">
    <div class="hot-movie relative w-full overflow-auto select-none lg:h-[450px] sm:h-[380px] h-[350px]" >
        <div class="list-movie absolute flex w-max lg:top-[20px] sm:top-[15px] top-[10px] left-0 sm:gap-[20px] gap-[10px]">

            <a href="{{route('movie', 'hanh-tinh-khi-vuong-quoc-moi')}}" class="item-movie scale-100 lg:w-[250px] sm:w-[220px] w-[200px] lg:h-[375px] sm:h-[330px] h-[300px] transition-all duration-300 ease-linear scroll-smooth relative hover:scale-110 ">
                <img class="rounded-lg w-full h-full" src="https://img.phimapi.com/upload/vod/20240507-1/569ff6ca8838fb86e397a82f167e6e3b.jpg" alt="">
                <div class="movie-name absolute rounded-b-lg left-0 right-0 bottom-0 text-center bg-[rgba(0,0,0,0.7)] py-2">
                    <div class="title text-2xl py-1">Hành Tinh Khỉ: Vương Quốc Mới</div>
                    <div class="original-name text-xl">Kingdom Of The Planet Of The Apes</div>
                </div>
            </a>

        </div>
    </div>
    <div class="hot-movie-button">
        <button class="hot-movie-prev absolute z-10 top-[30%] lg:left-10 sm:left-2 left-1 origin-center bg-[rgba(0,0,0,0.7)] text-7xl sm:h-[100px] h-[80px] sm:w-[50px] w-[40px] rounded-lg transition-all duration-100 ease-linear opacity-50 hover:opacity-100 hover:scale-110">&#10092;</button>
        <button class="hot-movie-next absolute z-10 top-[30%] lg:right-10 sm:right-2 right-1 origin-center bg-[rgba(0,0,0,0.7)] text-7xl sm:h-[100px] h-[80px] sm:w-[50px] w-[40px] rounded-lg transition-all duration-100 ease-linear opacity-50 hover:opacity-100 hover:scale-110">&#10093;</button>
    </div>
</div>
<script src="{{asset('js/slider.js')}}"></script>
