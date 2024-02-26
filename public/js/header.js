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
