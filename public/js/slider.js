//image slider
let slider = document.querySelector('.slider .list');
let items = document.querySelectorAll('.slider .list .item');
let next = document.getElementById('next');
let prev = document.getElementById('prev');
let dots = document.querySelectorAll('.slider .dots li');

let lengthItems = items.length - 1;
let active = 0;
next.onclick = function () {
    active = active + 1 <= lengthItems ? active + 1 : 0;
    reloadSlider();
};
prev.onclick = function () {
    active = active - 1 >= 0 ? active - 1 : lengthItems;
    reloadSlider();
};
let refreshInterval = setInterval(() => {
    next.click();
}, 3000);
function reloadSlider() {
    slider.style.left = -items[active].offsetLeft + 'px';
    //
    let last_active_dot = document.querySelector('.slider .dots li.active');
    last_active_dot.classList.remove('active');
    dots[active].classList.add('active');

    clearInterval(refreshInterval);
    refreshInterval = setInterval(() => {
        next.click();
    }, 3000);
}

dots.forEach((li, key) => {
    li.addEventListener('click', () => {
        active = key;
        reloadSlider();
    });
});
window.onresize = function (event) {
    reloadSlider();
};

//hot movie slider
document.querySelector('.hot-movie-next').onclick = function () {
    const widthItem = document.querySelector('.item-movie').offsetWidth;
    document.querySelector('.hot-movie').scrollLeft += widthItem + 30;
};
document.querySelector('.hot-movie-prev').onclick = function () {
    const widthItem = document.querySelector('.item-movie').offsetWidth;
    document.querySelector('.hot-movie').scrollLeft -= widthItem + 30;
};

// document.addEventListener('DOMContentLoaded', function () {
//     const slider = document.querySelector('.list-movie');
//     const prevButton = document.getElementById('hot-movie-prev');
//     const nextButton = document.getElementById('hot-movie-next');

//     function moveToNext() {
//         const firstItem = slider.firstElementChild;
//         slider.appendChild(firstItem);
//     }

//     function moveToPrev() {
//         const lastItem = slider.lastElementChild;
//         slider.insertBefore(lastItem, slider.firstElementChild);
//     }

//     nextButton.addEventListener('click', function () {
//         moveToNext();
//     });

//     prevButton.addEventListener('click', function () {
//         moveToPrev();
//     });
// });

// let slider_movie = document.querySelector('.list-movie');
// let items_movie = document.querySelectorAll('.list-movie .item-movie');
// let next_movie = document.getElementById('hot-movie-next');
// let prev_movie = document.getElementById('hot-movie-prev');

// let lengthItems_movie = items_movie.length - 1;
// let active_movie = 0;
// next_movie.onclick = function () {
//     active_movie = active_movie + 1 <= lengthItems_movie - 4 ? active_movie + 1 : 0;
//     reloadSlider_movie();
// };
// prev_movie.onclick = function () {
//     active_movie = active_movie - 1 >= 0 ? active_movie - 1 : lengthItems_movie - 4;
//     reloadSlider_movie();
// };

// function reloadSlider_movie() {
//     slider_movie.style.left = -items_movie[active_movie].offsetLeft + 'px';
// }

// window.onresize = function (event) {
//     reloadSlider_movie();
// };
