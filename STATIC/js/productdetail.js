function show_product_detail(element, imagePath) {
  // Remove border from all image-items
  var imageItems = document.querySelectorAll(".image-item");
  imageItems.forEach((item) => {
    item.classList.remove("image-item-hovered");
  });

  // Set border for the currently hovered image-item
  let imageItem = document.querySelector(`.${element}`);

  imageItem.classList.add("image-item-hovered");
  // Change the main product image
  let imgElement = document.querySelector(".product-detail_image");
  imgElement.src = imagePath;
}

function decreaseQuantity() {
  let quantity_input = document.querySelector(".quantity-input").value;
  quantityValue = parseInt(quantity_input) || 0;
  //case value is none, set value comeback to 1
  if (quantityValue === 0) {
    document.querySelector(".quantity-input").value = 1;
  }
  //case value more than 1
  else if (parseInt(quantityValue) > 1) {
    document.querySelector(".quantity-input").value = quantityValue - 1;
  }
}

function increaseQuantity(maxProduct) {
  let quantity_input = document.querySelector(".quantity-input").value;
  quantityValue = parseInt(quantity_input) || 0;
  if (quantityValue < maxProduct) {
    document.querySelector(".quantity-input").value = quantityValue + 1;
  } else {
    //not do something
  }
}

function hienThiNutPhanTrangDanhGia(soLuongDanhGia, soDanhGiaTrenMotTrang) {
  let totalPages = Math.ceil(soLuongDanhGia / soDanhGiaTrenMotTrang);
  let html = ``;
  for (i = 1; i <= totalPages; i++) {
    html += ` <li class="page-item"><button class="page-link">${i}</button></li>`;
  }
  document.querySelector(".pagination.justify-content-center").innerHTML = html;
  // alert(soLuongDanhGia);
}

function hienthisaotrungbinh(numberStar) {
  let i = 1;
  let dem = 0;
  let htmlAvarageStar = ``;
  while (5 >= i) {
    if (numberStar >= i) {
      htmlAvarageStar += `<span class="rating"><i class="fas fa-star"></i></span>`;
    } else if (numberStar < i) {
      if (dem === 0 && numberStar % 1 >= 0.1 && numberStar % 1 <= 0.8) {
        htmlAvarageStar += `<span class="rating"><i class="fa-regular fa-star-half-stroke"></i></span>`;
        dem++;
      } else if (dem === 0 && numberStar % 1 > 0.8 && numberStar % 1 <= 0.9) {
        htmlAvarageStar += `<span class="rating"><i class="fas fa-star"></i></span>`;
        dem++;
      } else {
        htmlAvarageStar += `<span class="rating"><i class="fa-regular fa-star"></i></span>`;
      }
    }
    i++;
  }
  avarageStarContainers = document.querySelectorAll(".avarage-star-container");
  avarageStarContainers.forEach((item) => {
    item.innerHTML = htmlAvarageStar;
  });
}

// function loadDanhGiaLanDau(idSanPham, loaiDanhGia) {
//   let soLuongDanhGiaChoMotTrang = 5;
//   let pageNumber = 1;
//   let danhGiaBatDau = (pageNumber - 1) * soLuongDanhGiaChoMotTrang;
//   var xhr = new XMLHttpRequest();
//   xhr.open("POST", "CONTROLLER/DanhGiaController.php", true);
//   xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//   xhr.onreadystatechange = function () {
//     if (xhr.readyState == 4 && xhr.status == 200) {
//       // alert(this.responseText);
//       const danhSachDanhGia = JSON.parse(this.responseText);
//       console.log(danhSachDanhGia);
//       let html = ``;
//       danhSachDanhGia.forEach((danhgia) => {
//         let i = 0;
//         htmlStar = ``;
//         while (5 > i) {
//           if (danhgia.star > i) {
//             htmlStar += `<span class="rating"><i class="fas fa-star"></i></span>`;
//           } else {
//             htmlStar += `<span class="rating"><i class="fa-regular fa-star"></i></span>`;
//           }
//           i++;
//         }
//         html +=
//           `<div class="card mb-4 border-0">
//               <div class="card-body">
//                   <div class="user-info">
//                       <div class="user-avatar">
//                           <img src="${danhgia.src}" alt="Avatar 1">
//                       </div>
//                       <div>
//                           <h3 class="card-title">${danhgia.ten}</h3>
//                       </div>
//                   </div>
//                   <p class="card-text">
//                   ` +
//           htmlStar +
//           `
//                   </p>
//                   <p class="card-text"><strong>Nội dung đánh giá: </strong>${danhgia.noidung}</p>
//               </div>
//           </div>`;
//       });
//       document.getElementById("demo").innerHTML = html; // Corrected assignment\
//       // alert(this.responseText);
//     }
//   };
//   xhr.send(
//     `action=LoadDanhGia&danhGiaBatDau=${danhGiaBatDau}&soLuongDanhGiaChoMotTrang=${soLuongDanhGiaChoMotTrang}&idSanPham=${idSanPham}&loaiDanhGia=${loaiDanhGia}`
//   );
// }

// function xuLyPhanTrang(idSanPham, loaiDanhGia) {
//   let buttons = document.querySelectorAll(".page-item");
//   // let idSanPham = <?php echo $idSanPham ?>;
//   buttons.forEach((button) => {
//     button.addEventListener("click", () => {
//       let soLuongDanhGiaChoMotTrang = 5;
//       let pageNumber = button.textContent;
//       let danhGiaBatDau = (pageNumber - 1) * soLuongDanhGiaChoMotTrang;
//       var xhr = new XMLHttpRequest();
//       xhr.open("POST", "CONTROLLER/DanhGiaController.php", true);
//       xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//       xhr.onreadystatechange = function () {
//         if (xhr.readyState == 4 && xhr.status == 200) {
//           const danhSachDanhGia = JSON.parse(this.responseText);
//           // console.log(danhSachDanhGia);
//           let html = ``;
//           danhSachDanhGia.forEach((danhgia) => {
//             let i = 0;
//             htmlStar = ``;
//             while (5 > i) {
//               if (danhgia.star > i) {
//                 htmlStar += `<span class="rating"><i class="fas fa-star"></i></span>`;
//               } else {
//                 htmlStar += `<span class="rating"><i class="fa-regular fa-star"></i></span>`;
//               }
//               i++;
//             }
//             html +=
//               `<div class="card mb-4">
//               <div class="card-body">
//                   <div class="user-info">
//                       <div class="user-avatar">
//                           <img src="${danhgia.src}" alt="Avatar 1">
//                       </div>
//                       <div>
//                           <h3 class="card-title">${danhgia.ten}</h3>
//                       </div>
//                   </div>
//                   <p class="card-text">` +
//               htmlStar +
//               `</p>
//                   <p class="card-text"><strong>Nội dung đánh giá: </strong>${danhgia.noidung}</p>
//               </div>
//           </div>`;
//           });
//           document.getElementById("demo").innerHTML = html; //
//         }
//       };
//       xhr.send(
//         `action=LoadDanhGia&danhGiaBatDau=${danhGiaBatDau}&soLuongDanhGiaChoMotTrang=${soLuongDanhGiaChoMotTrang}&idSanPham=${idSanPham}&loaiDanhGia=${loaiDanhGia}`
//       );
//     });
//   });
// }

function loadDanhGia(idSanPham, loaiDanhGia, pageNumber) {
  let soLuongDanhGiaChoMotTrang = 5;
  let danhGiaBatDau = (pageNumber - 1) * soLuongDanhGiaChoMotTrang;
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/web2/CONTROLLER/DanhGiaController.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      const danhSachDanhGia = JSON.parse(this.responseText);
      let html = ``;
      danhSachDanhGia.forEach((danhgia) => {
        if (danhgia.src == "") {
          danhgia.src = "STATIC/assets/default-image-user.png";
        }
        let i = 0;
        htmlStar = ``;
        while (5 > i) {
          if (danhgia.star > i) {
            htmlStar += `<span class="rating"><i class="fas fa-star"></i></span>`;
          } else {
            htmlStar += `<span class="rating"><i class="fa-regular fa-star"></i></span>`;
          }
          i++;
        }
        html +=
          `<div class="card mb-4 border-0">
              <div class="card-body px-0">
                  <div class="user-info d-flex align-items-center">
                      <div class="user-avatar">
                          <img src="${danhgia.src}" alt="Avatar 1">
                      </div>
                      <div>
                          <h3 class="card-title">${danhgia.ten}</h3>
                      </div>
                  </div>
                  <p class="card-text">
                  ` +
          htmlStar +
          `
                  </p>
                  <p class="card-text"><strong>Nội dung đánh giá: </strong>${danhgia.noidung}</p>
              </div>
          </div>`;
      });

      if (html === "") {
        document.querySelector(".case-has-evaluate").innerHTML = "";
        document.querySelector(
          ".case-none-evaluate"
        ).innerHTML = `Sản phẩm chưa có đánh giá ${
          loaiDanhGia === "_" ? "!" : loaiDanhGia + " sao !"
        }`;
      } else {
        document.querySelector(".case-has-evaluate").innerHTML = html;
        document.querySelector(".case-none-evaluate").innerHTML = "";
      }
    }
  };
  xhr.send(
    `action=LoadDanhGia&danhGiaBatDau=${danhGiaBatDau}&soLuongDanhGiaChoMotTrang=${soLuongDanhGiaChoMotTrang}&idSanPham=${idSanPham}&loaiDanhGia=${loaiDanhGia}`
  );
}

function xuLyPhanTrang(
  idSanPham,
  loaiDanhGia,
  soLuongDanhGia,
  soDanhGiaTrenMotTrang
) {
  hienThiNutPhanTrangDanhGia(soLuongDanhGia, soDanhGiaTrenMotTrang);
  loadDanhGia(idSanPham, loaiDanhGia, 1);
  let buttons = document.querySelectorAll(".page-item");
  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      let pageNumber = button.textContent;
      loadDanhGia(idSanPham, loaiDanhGia, pageNumber);
    });
  });
}

function AddProductToCart(idSanPham, idUser, soLuongConLai) {
  let soLuongThem = document.getElementById("quantityInput").value;
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/web2/CONTROLLER/GioHangController.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      response = JSON.parse(this.responseText);
      if (response["statusAddProduct"]) {
        alert("Thêm sản phẩm thành công");
      } else {
        alert("Thêm sản phẩm thất bại");
      }
      if (this.response["quantityProductInCart"]) {
        document.querySelector(".quantity-product").classList =
          "quantity-product d-none";
      } else {
        document.querySelector(".quantity-product").classList =
          "quantity-product d-block";
        document.querySelector(".quantity-product").innerHTML =
          response["quantityProductInCart"];
      }
    }
  };
  xhr.send(
    `action=AddProductToCart&idSanPham=${idSanPham}&idUser=${idUser}&soLuongThem=${soLuongThem}`
  );
}

function checkQuantity(soLuongSanPham) {
  if (soLuongSanPham == 0) {
    document.querySelector(".case-none-quantity").classList =
      "case-none-quantity d-block";
    document.querySelector(".case-has-quantity").classList =
      "case-has-quantity d-none";
  } else {
    document.querySelector(".case-none-quantity").classList =
      "case-none-quantity d-none";
    document.querySelector(".case-has-quantity").classList =
      "case-has-quantity d-block";
  }
}
