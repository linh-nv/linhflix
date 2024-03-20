// Hiển thị và ẩn hiệu ứng loading
document.addEventListener('DOMContentLoaded', function () {
    var load = document.getElementById('loading');

    // Hiển thị hiệu ứng loading khi chuyển trang
    window.addEventListener('beforeunload', function () {
        load.style.display = 'block';
    });

    // Ẩn hiệu ứng loading sau khi tải xong trang
    window.addEventListener('load', function () {
        load.style.display = 'none';
    });
});

// chỉnh các phần tử chứa ảnh, phòng trường hợp ảnh không load được
window.onload = function () {
    var movieItems = document.querySelectorAll('.movie-item');

    movieItems.forEach(function (item) {
        // Lấy chiều rộng của phần tử
        var width = item.offsetWidth;

        // Tính toán và gán chiều cao mới dựa trên 3/2 chiều rộng
        var height = (3 / 2) * width;

        // Đặt chiều cao mới cho phần tử
        item.style.height = height + 'px';
    });
};

function handleKeyPress(event) {
    // Kiểm tra xem phím nhấn có phải là Enter không (mã ASCII của Enter là 13)
    if (event.key === 'Enter') {
        // Gọi hàm submitForm() khi Enter được nhấn
        submitForm();
        // Ngăn chặn hành động mặc định của phím Enter (ngăn form tự động submit)
        event.preventDefault();
    }
}
