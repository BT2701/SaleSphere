// đẩy dữ liệu theo loại
function loadProducts(category) {
    $.ajax({
        url: '/web2/CONTROLLER/SanPhamController.php',
        method: 'GET',
        data: { action: 'getDsSPtheoLoai', category: category },
        success: function(data) {
            var productList = JSON.parse(data);
            var productListHTML = '';
            if (productList.length > 0) {
                productList.forEach(function(product) {
                    productListHTML += '<div class="product-gallery-content-product-item">';
                    productListHTML += '<img src="' + product.src + '" alt="">';
                    productListHTML += '<div class="product-gallery-content-product-text">';
                    if (product.tenKhuyenMai != null && (Date.parse(product.hansudung) > Date.now() || product.hansudung == null)) {
                        productListHTML += '<li style="background-color:' + (product.background != null ? product.background : '#fcfcfc') + ';">';
                        productListHTML += '<img src="/web2/STATIC/assets/icon-percent.webp" alt="">';
                        productListHTML += '<p>' + product.tenKhuyenMai + '</p>';
                        productListHTML += '</li>';
                        productListHTML += '<li>' + product.tenSanPham + '</li>';
                        productListHTML += '<li>Online giá rẻ</li>';
                        productListHTML += '<li><a href="">' + product.giaBan + ' <sup>đ</sup></a><span>-';
                        productListHTML += (product.giaTri != null ? product.giaTri : '0') + '%</span></li>';
                        productListHTML += '<li>';
                        if (product.giaTri != null) {
                            var value = parseFloat(product.giaBan);
                            var khuyenmai = parseFloat(product.giaTri);
                            var giaban = value - (value * khuyenmai / 100);
                            productListHTML += giaban;
                        } else {
                            productListHTML += product.giaBan;
                        }
                        productListHTML += ' <sup>đ</sup></li>';
                        productListHTML += '<li>';
                        if (product.star != null) {
                            for (var i = 0; i < product.star; i++) {
                                productListHTML += '<i class="fa-solid fa-star" style="color: #FB6E2E;"></i>';
                            }
                        }
                        productListHTML += '</li>';
                        productListHTML += '<li>';
                        productListHTML += '<p style="color: gray;">Đã bán ' + (product.TongSoLuongBanDuoc != null ? product.TongSoLuongBanDuoc : '0') + '</p>';
                        productListHTML += '</li>';
                    }
                    
                    else if (product.tenKhuyenMai == null || (Date.parse(product.hansudung) < Date.now() && product.hansudung != null)) {
                        productListHTML += '<li style="background-color: #fcfcfc;">';
                        productListHTML += '</li>';
                        productListHTML += '<li>' + product.tenSanPham + '</li>';
                        productListHTML += '<li>Online giá rẻ</li>';
                        productListHTML += '<li><a href="">' + product.giaBan + ' <sup>đ</sup></a><span>-';
                        productListHTML += (product.giaTri != null ? product.giaTri : '0') + '%</span></li>';
                        productListHTML += '<li>';
                        if (product.giaTri != null) {
                            var value = parseFloat(product.giaBan);
                            var khuyenmai = parseFloat(product.giaTri);
                            var giaban = value - (value * khuyenmai / 100);
                            productListHTML += giaban;
                        } else {
                            productListHTML += product.giaBan;
                        }
                        productListHTML += ' <sup>đ</sup></li>';
                        productListHTML += '<li>';
                        if (product.star != null) {
                            for (var i = 0; i < product.star; i++) {
                                productListHTML += '<i class="fa-solid fa-star" style="color: #FB6E2E;"></i>';
                            }
                        }
                        productListHTML += '</li>';
                        productListHTML += '<li>';
                        productListHTML += '<p style="color: gray;">Đã bán ' + (product.TongSoLuongBanDuoc != null ? product.TongSoLuongBanDuoc : '0') + '</p>';
                        productListHTML += '</li>';
                    }
                    productListHTML += '</div>';
                    productListHTML += '</div>';
                });
            } else {
                productListHTML = 'Không có sản phẩm nào';
            }
            $('#productList').html(productListHTML);
        }
    });
}

// đẩy dữ liệu theo tên
function loadProductsTheoTen(name) {
    $.ajax({
        url: '/web2/CONTROLLER/SanPhamController.php',
        method: 'GET',
        data: { action: 'getDsSPtheoTen', name: name },
        success: function(data) {
            var productList = JSON.parse(data);
            var productListHTML = '';
            if (productList.length > 0) {
                productList.forEach(function(product) {
                    productListHTML += '<div class="product-gallery-content-product-item">';
                    productListHTML += '<img src="' + product.src + '" alt="">';
                    productListHTML += '<div class="product-gallery-content-product-text">';
                    if (product.tenKhuyenMai != null && (Date.parse(product.hansudung) > Date.now() || product.hansudung == null)) {
                        productListHTML += '<li style="background-color:' + (product.background != null ? product.background : '#fcfcfc') + ';">';
                        productListHTML += '<img src="/web2/STATIC/assets/icon-percent.webp" alt="">';
                        productListHTML += '<p>' + product.tenKhuyenMai + '</p>';
                        productListHTML += '</li>';
                        productListHTML += '<li>' + product.tenSanPham + '</li>';
                        productListHTML += '<li>Online giá rẻ</li>';
                        productListHTML += '<li><a href="">' + product.giaBan + ' <sup>đ</sup></a><span>-';
                        productListHTML += (product.giaTri != null ? product.giaTri : '0') + '%</span></li>';
                        productListHTML += '<li>';
                        if (product.giaTri != null) {
                            var value = parseFloat(product.giaBan);
                            var khuyenmai = parseFloat(product.giaTri);
                            var giaban = value - (value * khuyenmai / 100);
                            productListHTML += giaban;
                        } else {
                            productListHTML += product.giaBan;
                        }
                        productListHTML += ' <sup>đ</sup></li>';
                        productListHTML += '<li>';
                        if (product.star != null) {
                            for (var i = 0; i < product.star; i++) {
                                productListHTML += '<i class="fa-solid fa-star" style="color: #FB6E2E;"></i>';
                            }
                        }
                        productListHTML += '</li>';
                        productListHTML += '<li>';
                        productListHTML += '<p style="color: gray;">Đã bán ' + (product.TongSoLuongBanDuoc != null ? product.TongSoLuongBanDuoc : '0') + '</p>';
                        productListHTML += '</li>';
                    }
                    
                    else if (product.tenKhuyenMai == null || (Date.parse(product.hansudung) < Date.now() && product.hansudung != null)) {
                        productListHTML += '<li style="background-color: #fcfcfc;">';
                        productListHTML += '</li>';
                        productListHTML += '<li>' + product.tenSanPham + '</li>';
                        productListHTML += '<li>Online giá rẻ</li>';
                        productListHTML += '<li><a href="">' + product.giaBan + ' <sup>đ</sup></a><span>-';
                        productListHTML += (product.giaTri != null ? product.giaTri : '0') + '%</span></li>';
                        productListHTML += '<li>';
                        if (product.giaTri != null) {
                            var value = parseFloat(product.giaBan);
                            var khuyenmai = parseFloat(product.giaTri);
                            var giaban = value - (value * khuyenmai / 100);
                            productListHTML += giaban;
                        } else {
                            productListHTML += product.giaBan;
                        }
                        productListHTML += ' <sup>đ</sup></li>';
                        productListHTML += '<li>';
                        if (product.star != null) {
                            for (var i = 0; i < product.star; i++) {
                                productListHTML += '<i class="fa-solid fa-star" style="color: #FB6E2E;"></i>';
                            }
                        }
                        productListHTML += '</li>';
                        productListHTML += '<li>';
                        productListHTML += '<p style="color: gray;">Đã bán ' + (product.TongSoLuongBanDuoc != null ? product.TongSoLuongBanDuoc : '0') + '</p>';
                        productListHTML += '</li>';
                    }
                    productListHTML += '</div>';
                    productListHTML += '</div>';
                });
            } else {
                productListHTML = 'Không có sản phẩm nào';
            }
            $('#productList').html(productListHTML);
        }
    });
}

// đẩy dữ liệu theo khoảng giá
function loadProductsTheoKhoangGia(khoangGia) {
    $.ajax({
        url: '/web2/CONTROLLER/SanPhamController.php',
        method: 'GET',
        data: { action: 'getDsSPtheoKhoangGia', khoangGia: khoangGia},
        success: function(data) {
            var productList = JSON.parse(data);
            var productListHTML = '';
            if (productList.length > 0) {
                productList.forEach(function(product) {
                    productListHTML += '<div class="product-gallery-content-product-item">';
                    productListHTML += '<img src="' + product.src + '" alt="">';
                    productListHTML += '<div class="product-gallery-content-product-text">';
                    if (product.tenKhuyenMai != null && (Date.parse(product.hansudung) > Date.now() || product.hansudung == null)) {
                        productListHTML += '<li style="background-color:' + (product.background != null ? product.background : '#fcfcfc') + ';">';
                        productListHTML += '<img src="/web2/STATIC/assets/icon-percent.webp" alt="">';
                        productListHTML += '<p>' + product.tenKhuyenMai + '</p>';
                        productListHTML += '</li>';
                        productListHTML += '<li>' + product.tenSanPham + '</li>';
                        productListHTML += '<li>Online giá rẻ</li>';
                        productListHTML += '<li><a href="">' + product.giaBan + ' <sup>đ</sup></a><span>-';
                        productListHTML += (product.giaTri != null ? product.giaTri : '0') + '%</span></li>';
                        productListHTML += '<li>';
                        if (product.giaTri != null) {
                            var value = parseFloat(product.giaBan);
                            var khuyenmai = parseFloat(product.giaTri);
                            var giaban = value - (value * khuyenmai / 100);
                            productListHTML += giaban;
                        } else {
                            productListHTML += product.giaBan;
                        }
                        productListHTML += ' <sup>đ</sup></li>';
                        productListHTML += '<li>';
                        if (product.star != null) {
                            for (var i = 0; i < product.star; i++) {
                                productListHTML += '<i class="fa-solid fa-star" style="color: #FB6E2E;"></i>';
                            }
                        }
                        productListHTML += '</li>';
                        productListHTML += '<li>';
                        productListHTML += '<p style="color: gray;">Đã bán ' + (product.TongSoLuongBanDuoc != null ? product.TongSoLuongBanDuoc : '0') + '</p>';
                        productListHTML += '</li>';
                    }
                    
                    else if (product.tenKhuyenMai == null || (Date.parse(product.hansudung) < Date.now() && product.hansudung != null)) {
                        productListHTML += '<li style="background-color: #fcfcfc;">';
                        productListHTML += '</li>';
                        productListHTML += '<li>' + product.tenSanPham + '</li>';
                        productListHTML += '<li>Online giá rẻ</li>';
                        productListHTML += '<li><a href="">' + product.giaBan + ' <sup>đ</sup></a><span>-';
                        productListHTML += (product.giaTri != null ? product.giaTri : '0') + '%</span></li>';
                        productListHTML += '<li>';
                        if (product.giaTri != null) {
                            var value = parseFloat(product.giaBan);
                            var khuyenmai = parseFloat(product.giaTri);
                            var giaban = value - (value * khuyenmai / 100);
                            productListHTML += giaban;
                        } else {
                            productListHTML += product.giaBan;
                        }
                        productListHTML += ' <sup>đ</sup></li>';
                        productListHTML += '<li>';
                        if (product.star != null) {
                            for (var i = 0; i < product.star; i++) {
                                productListHTML += '<i class="fa-solid fa-star" style="color: #FB6E2E;"></i>';
                            }
                        }
                        productListHTML += '</li>';
                        productListHTML += '<li>';
                        productListHTML += '<p style="color: gray;">Đã bán ' + (product.TongSoLuongBanDuoc != null ? product.TongSoLuongBanDuoc : '0') + '</p>';
                        productListHTML += '</li>';
                    }
                    productListHTML += '</div>';
                    productListHTML += '</div>';
                });
            } else {
                productListHTML = 'Không có sản phẩm nào';
            }
            $('#productList').html(productListHTML);
        }
    });
}


document.getElementById('searchButton').addEventListener('click', function() {
    // Lấy giá trị nhập vào từ ô tìm kiếm
    var searchValue = document.getElementById('searchInput').value;

    // Gọi hàm xử lý tìm kiếm với giá trị vừa lấy được
    loadProductsTheoTen(searchValue);
});



// lấy số lượng sản phẩm trên giao diện
function countChildDivs() {
    // Lấy thẻ div cha có id là "productList"
    var parentDiv = document.getElementById("productList");

    // Lấy tất cả các thẻ div con trực tiếp trong thẻ div cha
    var childDivs = parentDiv.querySelectorAll(":scope > div");

    // Đếm số lượng thẻ div con
    var numberOfChildDivs = childDivs.length;

    // In ra số lượng thẻ div con
    return numberOfChildDivs;
}


var divCount = countChildDivs();

// Hiển thị các thẻ li dựa trên số lượng thẻ div con
var pagination = document.getElementById("pagination");
for (var i = 1; i <= divCount; i++) {
    var li = document.createElement("li");
    li.className = "page-item";
    var a = document.createElement("a");
    a.className = "page-link";
    a.href = "#";
    a.setAttribute("data-page", i); // Thiết lập giá trị cho thuộc tính data-page
    a.textContent = i;
    li.appendChild(a);
    pagination.appendChild(li);
}


document.addEventListener("DOMContentLoaded", function() {
    var paginationItems = document.querySelectorAll(".page-link");
    paginationItems.forEach(function(item) {
        item.addEventListener("click", function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định khi nhấn vào liên kết
            var pageNumber = this.dataset.page; // Lấy số trang từ thuộc tính data-page
            loadData(pageNumber); // Gọi hàm để tải dữ liệu cho trang mới
        });
    });
});

function loadData(pageNumber) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "get_data.php?page=" + pageNumber, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) { //status 200 là thành công
            // Xử lý dữ liệu nhận được
            var response = xhr.responseText;
            // Hiển thị dữ liệu trên trang
            document.getElementById("productList").innerHTML = response;
        }
    };
    xhr.send();
}