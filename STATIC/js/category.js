timTen();
laySoTrangALL(soLuongSpDB);

phanTrang("", "");
var newValue = "";
// đẩy dữ liệu theo loại
function loadProducts(category) {
  newValue = category;
  loadNumOfPage("slloai", newValue);
  // phanTrang('getDsSPtheoLoai',newValue);

  //
}

// đẩy dữ liệu theo tên
function loadProductsTheoTen(name) {
  newValue = name;
  loadNumOfPage("slten", newValue);
  // phanTrang('getDsSPtheoTen',newValue);
}

// đẩy dữ liệu theo khoảng giá
function loadProductsTheoKhoangGia(khoangGia) {
  newValue = khoangGia;
  loadNumOfPage("slgia", newValue);
  // phanTrang('getDsSPtheoKhoangGia',newValue);
}

function timTen() {
  document
    .getElementById("searchButton")
    .addEventListener("click", function () {
      // Lấy giá trị nhập vào từ ô tìm kiếm
      var searchValue = document.getElementById("searchInput").value;

      // Gọi hàm xử lý tìm kiếm với giá trị vừa lấy được
      loadProductsTheoTen(searchValue);
    });
}

// lấy số lượng sản phẩm
function laySoTrangALL(soLuongSP) {
  var tongSoSanPham = soLuongSP;
  var count = Math.ceil(tongSoSanPham / 10);
  var pageCount = count;
  var pagination = document.getElementById("pagination");
  for (var i = 1; i <= pageCount; i++) {
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
}

function phanTrang(action, value) {
  var paginationItems = document.querySelectorAll(".page-link");
  paginationItems.forEach(function (item) {
    item.addEventListener("click", function (event) {
      event.preventDefault();
      var pageNumber = this.dataset.page || 1; // Nếu không có data-page, mặc định là 1
      // alert(newValue);
      loadData(pageNumber, action, newValue);
    });
  });
  // Gọi loadData với pageNumber = 1 ở đây
  loadData(1, action, value);
}
function loadNumOfPage(action, value) {
  $.ajax({
    url: "/SaleSphere/CONTROLLER/SanPhamController.php",
    method: "GET",
    data: { action: action, value: value },
    success: function (data) {
      var numOfProduct = JSON.parse(data);
      var listHTML = "";
      var count = Math.ceil(numOfProduct / 10);
      for (let i = 1; i <= count; i++) {
        listHTML += '<li class="page-item">';
        listHTML += '<a class="page-link" href="#" data-page="' + i + '">';
        listHTML += "  " + i + "";
        listHTML += "</a>";
        listHTML += "</li>";
      }

      $("#pagination").html(listHTML);
      if (action == "slten") {
        phanTrang("getDsSPtheoTen", newValue);
      } else if (action == "slloai") {
        phanTrang("getDsSPtheoLoai", newValue);
      } else if (action == "slgia") {
        phanTrang("getDsSPtheoKhoangGia", newValue);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error("Lỗi khi gửi yêu cầu AJAX: " + errorThrown);
      // Xử lý lỗi nếu có
    },
  });
}
function loadData(pageNumber, action, value) {
  var itemsPerPage = 10; // Số lượng sản phẩm trên mỗi trang
  var startIndex = (pageNumber - 1) * itemsPerPage; // Vị trí bắt đầu của trang hiện tại

  $.ajax({
    url: "/SaleSphere/CONTROLLER/SanPhamController.php",
    method: "GET",
    data: {
      action: action,
      value: value,
      start: startIndex,
      limit: itemsPerPage,
    },
    success: function (data) {
      var productList = JSON.parse(data);
      var productListHTML = "";
      if (productList.length > 0) {
        productList.forEach(function (product) {
          productListHTML +=
            '<div class="product-gallery-content-product-item" onclick="test(' +
            product.id +
            ')">';
          productListHTML += '<div class = "split-img">';
          productListHTML +=
            '<img src="' + product.src + '" alt="" class="image-product-vip">';
          productListHTML += "</div>";
          productListHTML +=
            '<div class="product-gallery-content-product-text">';
          if (
            product.tenKhuyenMai != null &&
            (Date.parse(product.hansudung) > Date.now() ||
              product.hansudung == null)
          ) {
            productListHTML +=
              '<li style="background-color:' +
              (product.background != null ? product.background : "#fcfcfc") +
              ';">';
            productListHTML +=
              '<img src="/SaleSphere/STATIC/assets/icon-percent.webp" alt="">';
            productListHTML += "<p>" + product.tenKhuyenMai + "</p>";
            productListHTML += "</li>";
            productListHTML += "<li>" + product.tenSanPham + "</li>";
            productListHTML += "<li>Online giá rẻ</li>";
            productListHTML +=
              '<li><a href="">' + product.giaBan + " <sup>đ</sup></a><span>-";
            productListHTML +=
              (product.giaTri != null ? product.giaTri : "0") + "%</span></li>";
            productListHTML += "<li>";
            if (product.giaTri != null) {
              var value = parseFloat(product.giaBan);
              var khuyenmai = parseFloat(product.giaTri);
              var giaban = value - (value * khuyenmai) / 100;
              productListHTML += giaban;
            } else {
              productListHTML += product.giaBan;
            }
            productListHTML += " <sup>đ</sup></li>";
            productListHTML += "<li>";
            if (product.TrungBinhStar != null) {
              for (var i = 0; i < product.TrungBinhStar; i++) {
                productListHTML +=
                  '<i class="fa-solid fa-star" style="color: #FB6E2E;"></i>';
              }
            }
            productListHTML += "</li>";
            productListHTML += "<li>";
            productListHTML +=
              '<p style="color: gray;">Đã bán ' +
              (product.TongSoLuongBanDuoc != null
                ? product.TongSoLuongBanDuoc
                : "0") +
              "</p>";
            productListHTML += "</li>";
          } else if (
            product.tenKhuyenMai == null ||
            (Date.parse(product.hansudung) < Date.now() &&
              product.hansudung != null)
          ) {
            productListHTML += '<li style="background-color: #fcfcfc;">';
            productListHTML += "</li>";
            productListHTML += "<li>" + product.tenSanPham + "</li>";
            productListHTML += "<li>Online giá rẻ</li>";
            productListHTML +=
              '<li><a href="">' + product.giaBan + " <sup>đ</sup></a><span>-";
            productListHTML +=
              (product.giaTri != null ? product.giaTri : "0") + "%</span></li>";
            productListHTML += "<li>";
            if (product.giaTri != null) {
              var value = parseFloat(product.giaBan);
              var khuyenmai = parseFloat(product.giaTri);
              var giaban = value - (value * khuyenmai) / 100;
              productListHTML += giaban;
            } else {
              productListHTML += product.giaBan;
            }
            productListHTML += " <sup>đ</sup></li>";
            productListHTML += "<li>";
            if (product.TrungBinhStar != null) {
              for (var i = 0; i < product.TrungBinhStar; i++) {
                productListHTML +=
                  '<i class="fa-solid fa-star" style="color: #FB6E2E;"></i>';
              }
            }
            productListHTML += "</li>";
            productListHTML += "<li>";
            productListHTML +=
              '<p style="color: gray;">Đã bán ' +
              (product.TongSoLuongBanDuoc != null
                ? product.TongSoLuongBanDuoc
                : "0") +
              "</p>";
            productListHTML += "</li>";
          }
          productListHTML += "</div>";
          productListHTML += "</div>";
        });
      } else {
        productListHTML = "Không có sản phẩm nào";
      }
      $("#productList").html(productListHTML);
    },
  });
}
