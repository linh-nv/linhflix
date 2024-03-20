//hiệu ứng cuộn menu
document.addEventListener('DOMContentLoaded', function () {
    const header = document.getElementById('header');
    let lastScrollTop = 0;

    window.addEventListener('scroll', function () {
        const st = window.scrollY;

        // Kiểm tra hướng cuộn
        if (st > lastScrollTop) {
            // Lướt xuống
            header.style.background = 'transparent';
        } else {
            // Lướt lên
            header.style.background = '#000';
        }
        lastScrollTop = st;
    });
});

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

// Hàm xử lý sự kiện khi form được gửi
function submitForm() {
    // Gọi hàm submit() của form để submit form
    document.getElementById('search-form').submit();
}

const sign_in = document.getElementById('sign-in');

const close = document.getElementById('close-btn');
const loggin_form = document.getElementById('loggin-form');

if (sign_in) {
    sign_in.addEventListener('click', function () {
        loggin_form.style.display = 'block';
    });
}
if (close) {
    close.addEventListener('click', function () {
        loggin_form.style.display = 'none';
    });
}

// register
const createBtn = document.querySelector('.create_btn');
const verification = document.querySelector('.verification');
if (createBtn) {
    createBtn.addEventListener('click', function () {
        verification.classList.toggle('hidden'); // Thêm hoặc loại bỏ class active
    });
}
