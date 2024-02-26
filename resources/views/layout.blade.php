<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {{-- @vite('resources/css/app.css') --}}
  <title>Linh phim</title>
  <meta name="description" content="Linh phim" />
  <meta property="og:title" content="Linh phim" />
  <meta property="og:description" content="Linh phim - Xem phim hay nhất, phim hay trung quốc, hàn quốc, việt nam, mỹ, hong kong , chiếu rạp" />
  <link rel="icon" href="{{asset('uploads/images/netflix-logo.png')}}" type="image/png">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600&display=swap" rel="stylesheet">
</head>
<body class="text-slate-300 bg-zinc-900">
  <nav id="header" class="z-50 fixed justify-between bg-black backdrop-blur-[5px] w-full h-24 flex items-center px-2 transition duration-300 py-3" >
    <div class="menu lg:hidden mx-6">
      <i class="menu-icon text-3xl cursor-pointer">
          <svg id="icon1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
          </svg>

          <svg id="icon2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
      </i>
  </div>
  <div class="flex justify-normal">
    <div class="logo flex items-center lg:mr-20 lg:px-5 font-black text-red-600">
      <a href="{{route('home')}}">
        <span>LINHPHIM</span>
      </a>
    </div>
    <div class="nav-links 2xl:text-2xl text-xl lg:static lg:min-h-fit absolute lg:bg-transparent bg-black top-[-100vh] left-0 lg:w-auto w-full flex items-center lg:py-0 py-8">
      <ul class="flex lg:flex-row flex-col lg:items-center font-semibold pl-10">
        <li class="lg:px-8 w-[100%] whitespace-nowrap relative group" id="theloai">
          <span class="py-5 cursor-pointer hover:text-white px-3 flex lg:justify-between items-center">Thể loại   
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" data-slot="icon" class="w-4 h-4 ml-3 lg:hidden">
                  <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
              </svg>            
          </span>
          <ul class="lg:overflow-y-hidden overflow-y-scroll lg:max-h-[100vh] max-h-[30vh] lg:absolute lg:grid lg:grid-cols-4 gap-4 w-[50vw] h-[60vh] hidden top-20 lg:p-16 p-4 lg:left-[-50%] left-0 lg:text-xl text-lg bg-black lg:opacity-0 opacity-100 lg:invisible lg:group-hover:opacity-100 lg:group-hover:visible transition-all duration-300 ease-in-out">
            @foreach ($genre as $gen)
              <li class="py-2 hover:text-white p-3"><a href="{{route('genre', $gen->slug)}}">{{$gen->title}}</a></li>  
            @endforeach  
          </ul>
        </li>
        <li class="lg:px-8 w-[100%] whitespace-nowrap relative group" id="quocgia">
            <span class="py-5 cursor-pointer hover:text-white px-3 flex lg:justify-between items-center">Quốc gia   
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" data-slot="icon" class="w-4 h-4 ml-3 lg:hidden">
                    <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>            
            </span>
            <ul class="lg:overflow-y-hidden overflow-y-scroll lg:max-h-[100vh] max-h-[30vh] lg:absolute lg:grid lg:grid-cols-4 gap-4 w-[50vw] h-[60vh] hidden top-20 lg:p-16 p-4 lg:left-[-50%] left-0 lg:text-xl text-lg bg-black lg:opacity-0 opacity-100 lg:invisible lg:group-hover:opacity-100 lg:group-hover:visible transition-all duration-300 ease-in-out">
              @foreach ($country as $count)
                <li class="py-2 hover:text-white p-3"><a href="{{route('country', $count->slug)}}">{{$count->title}}</a></li>  
              @endforeach
            </ul>
        </li>   
        @foreach ($category as $cate) 
        <li class="py-5 lg:px-8 w-[100%] whitespace-nowrap"><a href="{{route('category', $cate->slug)}}" class="hover:text-white px-3">{{$cate->title}}</a></li>
        @endforeach
        <li class="py-5 lg:px-8 w-[100%] whitespace-nowrap"><a href="{{route('new_movie')}}" class="text-blue-500 hover:text-blue-300 px-3">Thêm phim</a></li>

      </ul>
    </div>
  </div>
  <form id="search-form" role="search" action="{{route('search')}}" method="GET">
    <div class="search flex items-center gap-6 2xl:pl-20 lg:justify-end">
      <input id="search-text" name="search" class="z-1 absolute top-auto right-6 pl-6 pr-10 py-1 bg-transparent text-lg ease-linear duration-300" type="text" placeholder="......"  autocomplete="off">
      <i id="search-icon" class="z-10 cursor-pointer px-5 bg-transparent py-2">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
          </svg>
      </i>
    </div>
  </form>
</nav>
<div class="pt-24"></div>

@yield('content')

<div class="bg-slate-400 w-full h-2 mt-80"></div>
<footer id="footer" class="bg-black h-96 flex items-center sm:px-24 px-12 sm:text-2xl text-lg">
    <div class="footer-content-left sm:w-[50px] w-[40px] sm:mr-10 mr-4">
      <img class="w-full h-full object-cover rounded-lg" src="{{asset('uploads/images/netflix-logo.png')}}" alt="">
    </div>
    <div class="footer-content-right grid">
      <span>Made by Linh</span>
      <div class="contacts flex pt-4">
        <span class="">Contacts me:</span>
        <div class="flex items-center px-4 text-blue-700">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
            <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 0 1 3.5 2h1.148a1.5 1.5 0 0 1 1.465 1.175l.716 3.223a1.5 1.5 0 0 1-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 0 0 6.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 0 1 1.767-1.052l3.223.716A1.5 1.5 0 0 1 18 15.352V16.5a1.5 1.5 0 0 1-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 0 1 2.43 8.326 13.019 13.019 0 0 1 2 5V3.5Z" clip-rule="evenodd" />
          </svg>          
          <span class="pl-2">0866678297</span>
        </div>
      </div>
      <div class="flex pt-4 items-center">
        <span class="pr-2">Cam on vi da den</span>
        <i class="text-red-700">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 1 0 9.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1 1 14.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
          </svg>
        </i>
      </div>
    </div>
</footer>
<script src="{{asset('js/header.js')}}"></script>
      
<script>
  const theloai = document.getElementById('theloai');
  const quocgia = document.getElementById('quocgia');

  theloai.addEventListener('click', function () {
      if (window.innerWidth < 1024) {
          toggleDropdown(theloai);
      }
  });

  quocgia.addEventListener('click', function () {
      if (window.innerWidth < 1024) {
          toggleDropdown(quocgia);
      }
  });

  function toggleDropdown(element) {
      const dropdown = element.querySelector('ul');
      dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
  }
</script>
<script>
  //hiển thị menu mobile
  document.addEventListener('DOMContentLoaded', function () {
      const iconContainer = document.querySelector('.menu');
      const navLinks = document.querySelector('.nav-links');
      const icon1 = document.getElementById('icon1');
      const icon2 = document.getElementById('icon2');
      icon2.classList.add('hidden');
      let isIcon1Visible = true;

      iconContainer.addEventListener('click', function () {
          if (isIcon1Visible) {
              icon1.classList.add('hidden');
              icon2.classList.remove('hidden');
              navLinks.style.top = '60px';
          } else {
              icon1.classList.remove('hidden');
              icon2.classList.add('hidden');
              navLinks.style.top = '-100vh';
          }

          isIcon1Visible = !isIcon1Visible;
      });
  });
  //hiệu ứng ấn vào icon tìm kiếm
  const searchText = document.getElementById('search-text');
  const searchIcon = document.getElementById('search-icon');
  searchText.classList.add('w-10');
  let isSearchVisible = true;
  searchIcon.addEventListener('click', function () {
      if (isSearchVisible) {
          searchText.classList.remove('w-10');
          searchText.classList.add('w-[10rem]');
          searchText.classList.add('md:w-[15rem]');
          searchText.classList.add('2xl:w-[22rem]');
          searchText.classList.add('border');
          searchText.classList.add('border-white');
          searchText.classList.add('rounded-md');
      } else {
          searchText.classList.add('w-10');
          searchText.classList.remove('border');
          searchText.classList.remove('border-white');
          searchText.classList.remove('rounded-md');
          searchText.classList.remove('w-[10rem]');
          searchText.classList.remove('md:w-[15rem]');
          searchText.classList.remove('2xl:w-[22rem]');
      }
      isSearchVisible = !isSearchVisible;
  });
</script>
<script>
  function handleKeyPress(event) {
    // Kiểm tra xem phím nhấn có phải là Enter không (mã ASCII của Enter là 13)
    if (event.key === "Enter") {
      // Gọi hàm submitForm() khi Enter được nhấn
      submitForm();
      // Ngăn chặn hành động mặc định của phím Enter (ngăn form tự động submit)
      event.preventDefault();
    }
  }

  // Hàm xử lý sự kiện khi form được gửi
  function submitForm() {
    // Gọi hàm submit() của form để submit form
    document.getElementById("search-form").submit();
  }
</script>
{{-- trending tab movie --}}
<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Get all tab elements
    var tabs = document.querySelectorAll('.trending-tab li');

    // Get all content divs
    var contentDivs = document.querySelectorAll('.trending-list-items > div');

    // Add click event listeners to each tab
    tabs.forEach(function (tab, index) {
      tab.addEventListener('click', function () {
        // Remove 'active' class from all tabs
        tabs.forEach(function (t) {
          t.classList.remove('active-tab');
        });

        // Add 'active' class to the clicked tab
        tab.classList.add('active-tab');

        // Hide all content divs
        contentDivs.forEach(function (contentDiv) {
          contentDiv.style.display = 'none';
        });

        // Display the content div corresponding to the clicked tab
        contentDivs[index].style.display = 'block';
      });
    });
  });
</script>
    
</body>
</html>