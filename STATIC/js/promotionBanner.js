document.addEventListener("DOMContentLoaded", function() {
    const listImages = document.querySelector('.list-images');
    const btnLeft = document.querySelector('.btn-left');
    const btnRight = document.querySelector('.btn-right');
    const indexItems = document.querySelectorAll('.index-item');
    let currentIndex = 0;

    const updateSlide = () => {
        // Ẩn tất cả các hình ảnh
        document.querySelectorAll('.list-images img').forEach(img => {
            img.style.display = 'none';
        });
        // Hiển thị hình ảnh hiện tại
        document.querySelectorAll('.list-images img')[currentIndex].style.display = 'block';
        // Loại bỏ lớp active từ tất cả các chỉ mục
        indexItems.forEach(item => {
            item.classList.remove('active');
        });
        // Thêm lớp active cho chỉ mục hiện tại
        indexItems[currentIndex].classList.add('active');
    };

    const nextSlide = () => {
        currentIndex = (currentIndex + 1) % indexItems.length;
        updateSlide();
    };

    const prevSlide = () => {
        currentIndex = (currentIndex - 1 + indexItems.length) % indexItems.length;
        updateSlide();
    };

    // Xử lý sự kiện khi nhấp vào nút trái
    btnLeft.addEventListener('click', () => {
        prevSlide();
    });

    // Xử lý sự kiện khi nhấp vào nút phải
    btnRight.addEventListener('click', () => {
        nextSlide();
    });

    // Xử lý sự kiện khi nhấp vào chỉ mục
    indexItems.forEach((item, index) => {
        item.addEventListener('click', () => {
            currentIndex = index;
            updateSlide();
        });
    });

    // Bắt đầu trình chiếu tự động sau mỗi 4 giây
    setInterval(nextSlide, 2000);
});
