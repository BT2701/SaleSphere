//THÔNG BÁO CHO USER CÓ XÁC NHẬN XÓA MÃ KHUYẾN MÃI HAY KHÔNG?
function confirmDeleteCoupond(idKhuyenMai, tenKhuyenMai) {
  signal = confirm(`Xác nhận xóa khuyến mãi "${tenKhuyenMai}"`);
  if (signal) return deleteCoupond(idKhuyenMai);
  return;
}

function deleteCoupond(idKhuyeMai) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ROUTES/KhuyenMaiRoutes.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      dataResponse = JSON.parse(this.responseText);
      if (dataResponse.success) {
        alert("Xóa khuyến mãi thành công");
      } else {
        alert("Xóa khuyến mãi thất bại");
      }
      autoLoadView(dataResponse.couponsList.length);
      // alert(this.responseText);
      document.getElementById("coupond" + idKhuyeMai).remove();
    }
  };
  xhr.send(`action=XoaKhuyenMai&idKhuyenMai=${idKhuyeMai}`);
}

function PrepareDataApplyModal(idKhuyenMai, tenKhuyenMai) {
  // Set name of coupond
  couponNameApplyElement = document.getElementById("test");
  couponNameApplyElement.textContent = tenKhuyenMai;

  // Set event onclick for button save detail apply coupon
  document.getElementById("applyCoupondBtn").onclick = function () {
    SaveDetailApplyCoupond(idKhuyenMai);
  };
  //set default modal apply not
  document.getElementById("applyFor").value = "all";
  document.getElementById("productTypeCheckbox").style.display = "none";

  // Make request to fetch products
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ROUTES/KhuyenMaiRoutes.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let Products = JSON.parse(xhr.responseText);
      let html = ``;
      Products.forEach((product) => {
        let isChecked = product.idkhuyenmai == idKhuyenMai ? "checked" : ""; // Corrected variable name
        html += `<label class="checkbox-label"><input type="checkbox" onchange="isApply(this, ${product.idkhuyenmai}, '${tenKhuyenMai}')" value="${product.id}" ${isChecked}> ${product.id} - ${product.tenSanPham}</label>`;
      });
      // Append the checkboxes to the container with id 'productTypeCheckbox'
      document.getElementById("productTypeCheckbox").innerHTML = html;
    }
  };
  xhr.send(`action=PrepareApplyData&couponid=${idKhuyenMai}`);
}

function isApply(checkbox, idkhuyenmai, tenkhuyenmai) {
  // If the checkbox is unchecked and a coupon is already applied to this product
  if (checkbox.checked && idkhuyenmai != null) {
    wannaChange = confirm(
      `Product already has coupon applied. Do you want to change it?`
    );
    if (wannaChange) {
      checkbox.checked = true;
    } else {
      checkbox.checked = false;
    }
  }
}

// function loadProductForCheckLists() {
//   checkboxContainer = document.getElementById("productTypeCheckbox");
// }

function SaveDetailApplyCoupond(idKhuyenMai) {
  let typeApply = document.getElementById("applyFor").value;
  let listproductidwannaapply = GetListProductIDWannaApply();
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ROUTES/KhuyenMaiRoutes.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      alert(this.responseText);
    }
  };
  xhr.send(
    `action=SaveDetailApplyCoupond&couponid=${idKhuyenMai}&listproductidwannaapply=${listproductidwannaapply}&typeapply=${typeApply}`
  );
}

function GetListProductIDWannaApply() {
  let checkedProductIds = [];
  let typeApply = document.getElementById("applyFor").value;
  let checkboxes = document.querySelectorAll('input[type="checkbox"]');
  if (typeApply === "all") {
    checkboxes.forEach((checkbox) => {
      checkedProductIds.push(checkbox.value);
    });
    return checkedProductIds;
  }
  checkboxes.forEach((checkbox) => {
    if (checkbox.checked) {
      checkedProductIds.push(checkbox.value);
    }
  });
  return checkedProductIds;
}

function ViewDetailCoupond(idKhuyenMai) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ROUTES/KhuyenMaiRoutes.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      coupondDetail = JSON.parse(this.responseText);
      let coupondInfo = coupondDetail["coupond_info"];

      document.getElementById("coupond-name").innerHTML =
        coupondInfo.tenKhuyenMai;
      document.getElementById("coupond-value").innerHTML =
        coupondInfo.giaTri + "% Sale Of";
      document.getElementById("expiration-date").innerHTML =
        coupondInfo.hanSuDung;
      document.getElementById("background-color").innerHTML =
        coupondInfo.background;

      let ProductsApplied = coupondDetail["products_applied"];
      let html = ``;
      if (ProductsApplied.length) {
        ProductsApplied.forEach((product) => {
          html += `<p class="form-check-label" for="product1">${product.id} - ${product.tenSanPham}</p>`;
        });
      } else {
        html += "Khuyến mãi chưa được áp dụng";
      }
      // Append the checkboxes to the container with id 'productTypeCheckbox'
      document.querySelector(".product-applied-container").innerHTML = html;
    }
  };
  xhr.send(`action=ViewDetailCoupond&coupondid=${idKhuyenMai}`);
}

function PrepareInfoCoupondEditModal(idKhuyenMai) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ROUTES/KhuyenMaiRoutes.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      coupondInfo = JSON.parse(this.responseText);
      document.getElementById("createCouponModalLabel").innerHTML =
        "Cập Nhật Thông Tin Khuyến Mãi";
      document.getElementById("couponName").value = coupondInfo.tenKhuyenMai;
      document.getElementById("couponValue").value = coupondInfo.giaTri;
      document.getElementById("expirationDate").value = coupondInfo.hanSuDung;
      document.getElementById("couponBackground").value =
        coupondInfo.background;
      document.getElementById("action").value = "PrepareEditData";

      document.getElementById("submitCouponBtn").onclick = () => {
        UpdateCoupondInfo(`${idKhuyenMai}`);
      };
    }
  };
  xhr.send(`action=PrepareEditData&coupondid=${idKhuyenMai}`);
}

function UpdateCoupondInfo(idKhuyenMai) {
  let UserInputInfoCoupond = GetUserInputForm();
  if (!validInfoCoupond(UserInputInfoCoupond)) return;
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ROUTES/KhuyenMaiRoutes.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      dataResponse = JSON.parse(this.responseText);
      if (dataResponse.success) {
        alert("Cập nhật thông tin khuyến mãi thàng công");
      } else {
        alert("Cập nhật thông tin khuyến mãi không thành công");
      }
      let html = ``;
      dataResponse.couponsList.forEach(function (coupon) {
        html += `<div class="row coupond pt-1 pb-1 border-bottom  d-flex justify-content-center align-items-center"
        id="coupond${coupon.id}">
        <div class="col-2">
          <p class="mb-0">${coupon.tenKhuyenMai}</p>
        </div>
        <div class="col-2">
          <p class="mb-0 text-center">${coupon.giaTri}</p>
        </div>
        <div class="col-2">
          <p class="mb-0 text-center">${coupon.hanSuDung}</p>
        </div>
        <div class="col-2">
          <p class="mb-0 text-center">${coupon.background}</p>
        </div>
        <div class="col-4 d-flex align-items-center justify-content-center d-none d-xl-block">
          <button class="btn btn-primary btn-sm ms-1" data-bs-toggle="modal" data-bs-target="#createCouponModal"
            onclick="PrepareInfoCoupondEditModal(${coupon.id})"><i class="fas fa-edit"></i>
            Sửa</button>
          <button class="btn btn-danger btn-sm ms-1 me-1"
            onclick="confirmDeleteCoupond(${coupon.id},'${coupon.tenKhuyenMai}')"><i
              class="fas fa-trash-alt"></i> Xóa</button>
          <button class="btn btn-secondary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#viewDetailCoupondModal"
            onclick="ViewDetailCoupond(${coupon.id})"><i class="fas fa-eye"></i>Chi tiết</button>
          <button class="btn btn-success btn-sm btn-apply-coupond  me-1" data-bs-toggle="modal"
            data-bs-target="#applyCouponModal" coupond-id="${coupon.id}"
            coupon-name="${coupon.tenKhuyenMai}"
            onclick="PrepareDataApplyModal(${coupon.id},'${coupon.tenKhuyenMai}')"><i
              class="fas fa-arrow-right"></i> Áp dụng</button>
        </div>
      </div>`;
      });
      document.getElementById("coupond-container-body").innerHTML = html;
    }
  };
  xhr.send(
    `action=UpdateCoupondInfo&coupondid=${idKhuyenMai}&coupondInfo=${UserInputInfoCoupond}`
  );
}

function GetUserInputForm() {
  let couponName = document.getElementById("couponName").value;
  let couponValue = document.getElementById("couponValue").value;
  let expirationDate = document.getElementById("expirationDate").value;
  let couponBackground = document.getElementById("couponBackground").value;
  // Create an object with the collected information
  let userInputObject = {
    tenKhuyenMai: couponName,
    giaTri: couponValue,
    hanSuDung: expirationDate,
    background: couponBackground,
  };

  // Convert the object to a JSON string
  let userInputJSON = JSON.stringify(userInputObject);

  return userInputJSON;
}

function PrepareFormCreateCoupond() {
  document.getElementById("createCouponModalLabel").innerHTML =
    "Tạo Mới Khuyến Mãi";
  document.getElementById("couponName").value = "";
  document.getElementById("couponValue").value = "";
  document.getElementById("expirationDate").value = "";
  document.getElementById("couponBackground").value = "#ff0000";
  // document.getElementById("action").value = "PrepareEditData";

  document.getElementById("submitCouponBtn").onclick = () => {
    // UpdateCoupondInfo(`${idKhuyenMai}`);
    CreateCoupond();
  };
}

function CreateCoupond() {
  //User input
  let UserInputInfoCoupond = GetUserInputForm();
  // alert();
  if (!validInfoCoupond(UserInputInfoCoupond)) return;
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ROUTES/KhuyenMaiRoutes.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      // alert(this.responseText);
      dataResponse = JSON.parse(this.responseText);
      if (dataResponse.success) {
        alert("Tạo khuyến mãi thành công");
      } else {
        alert("Tạo khuyến mãi không thành công");
      }
      autoLoadView(dataResponse.couponsList.length);
      let html = ``;
      dataResponse.couponsList.forEach(function (coupon) {
        html += `<div class="row coupond pt-1 pb-1 border-bottom  d-flex justify-content-center align-items-center"
        id="coupond${coupon.id}">
        <div class="col-2">
          <p class="mb-0">${coupon.tenKhuyenMai}</p>
        </div>
        <div class="col-2">
          <p class="mb-0 text-center">${coupon.giaTri}</p>
        </div>
        <div class="col-2">
          <p class="mb-0 text-center">${coupon.hanSuDung}</p>
        </div>
        <div class="col-2">
          <p class="mb-0 text-center">${coupon.background}</p>
        </div>
        <div class="col-4 d-flex align-items-center justify-content-center d-none d-xl-block">
          <button class="btn btn-primary btn-sm ms-1" data-bs-toggle="modal" data-bs-target="#createCouponModal"
            onclick="PrepareInfoCoupondEditModal(${coupon.id})"><i class="fas fa-edit"></i>
            Sửa</button>
          <button class="btn btn-danger btn-sm ms-1 me-1"
            onclick="confirmDeleteCoupond(${coupon.id},'${coupon.tenKhuyenMai}')"><i
              class="fas fa-trash-alt"></i> Xóa</button>
          <button class="btn btn-secondary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#viewDetailCoupondModal"
            onclick="ViewDetailCoupond(${coupon.id})"><i class="fas fa-eye"></i>Chi tiết</button>
          <button class="btn btn-success btn-sm btn-apply-coupond  me-1" data-bs-toggle="modal"
            data-bs-target="#applyCouponModal" coupond-id="${coupon.id}"
            coupon-name="${coupon.tenKhuyenMai}"
            onclick="PrepareDataApplyModal(${coupon.id},'${coupon.tenKhuyenMai}')"><i
              class="fas fa-arrow-right"></i> Áp dụng</button>
        </div>
      </div>`;
      });
      document.getElementById("coupond-container-body").innerHTML = html;
    }
  };
  xhr.send(`action=TaoMoiKhuyemMai&coupondInfo=${UserInputInfoCoupond}`);
}

// ---------------------------------------------------List Function Validate Form Input ----------------------
function containsSpecialCharacters(str) {
  let pattern = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
  return pattern.test(str);
}

function isDateGreaterThanCurrent(dateString) {
  inputDate = new Date(dateString);
  currentDate = new Date();
  return inputDate >= currentDate;
}

function correctNumber(min, max, value) {
  return value >= min && value <= max;
}

function isNumber(value) {
  let pattern = /^[0-9]*$/;
  return pattern.test(value);
}

//vaidate name of coupond with role not has spectial character
function isCorrectNameCoupond(coupondName) {
  signal = containsSpecialCharacters(coupondName);
  // console.log(coupondName == "");
  if (coupondName == "") {
    document.getElementById("coupond-name-error").classList = "d-block";
    document.getElementById("message-name-error").innerHTML =
      "Tên không được để trống";
    return false;
  } else if (signal) {
    document.getElementById("coupond-name-error").classList = "d-block";
    document.getElementById("message-name-error").innerHTML =
      "Tên khuyến mãi tồn tại kí tự đặt biệt";
    return false;
  } else {
    document.getElementById("coupond-name-error").classList = "d-none";
    return true;
  }
}

//validate value of coupond jiust in range [1-100]
function isCorrectValueCoupond(value) {
  signal = correctNumber(1, 100, value);
  if (value == 0) {
    document.getElementById("coupond-value-error").classList = "d-block";
    document.getElementById("message-value-error").innerHTML =
      "Giá trị không được để trống";
    return false;
  } else if (!signal) {
    document.getElementById("coupond-value-error").classList = "d-block";
    document.getElementById("message-value-error").innerHTML =
      "Giá trị phải trong khoản từ 1 đến 100";
    return false;
  } else {
    document.getElementById("coupond-value-error").classList = "d-none";
    return true;
  }
}

//ngày tạo khyến mãi ít nhất phải lớn hơn ngày hiện tại
function isCorrectDateCoupond(date) {
  // alert(typeof date);
  signal = isDateGreaterThanCurrent(date);
  if (date == "") {
    document.getElementById("coupond-date-error").classList = "d-block";
    document.getElementById("message-date-error").innerHTML =
      "Hạn sử dụng không được để trống";
    return false;
  } else if (!signal) {
    document.getElementById("coupond-date-error").classList = "d-block";
    document.getElementById("message-date-error").innerHTML =
      "Hạn sử dụng phải lớn hơn ngày hiện tại";
    return false;
  } else {
    document.getElementById("coupond-date-error").classList = "d-none";
    return true;
  }
}

function validInfoCoupond(coupondinfo) {
  data = JSON.parse(coupondinfo);
  nameCoupond = data.tenKhuyenMai;
  value = Number(data.giaTri);
  date = data.hanSuDung;
  // return !isCorrectDateCoupond(date);
  if (
    !isCorrectNameCoupond(nameCoupond) ||
    !isCorrectValueCoupond(value) ||
    !isCorrectDateCoupond(date)
  ) {
    return false;
  } else {
    document.getElementById("btn-close_createcoupondmodal").click();
    return true;
  }
}

function clearAllErrorMessage() {
  document.getElementById("coupond-name-error").classList = "d-none";
  document.getElementById("coupond-value-error").classList = "d-none";
  document.getElementById("coupond-date-error").classList = "d-none";
}

// ----------------------------------------AUTO UnApplied Coupond for Product -----------------------------------
//Make request to server to auto unapplied coupond for poduct is it was get time
function autoUnppliedCoupond() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ROUTES/KhuyenMaiRoutes.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    // if (xhr.readyState == 4 && xhr.status == 200) {
    // }
  };
  xhr.send(`action=AutoUnappliedCoupond`);
}

//Auto call this function after one day
setInterval(function () {
  autoUnppliedCoupond();
}, 86400000); //run every day

// --------------------------------------
function autoLoadView(listCoupond) {
  if (listCoupond == 0) {
    document.getElementById("coupond-container-body").classList =
      "row coupond-container-body d-none";
    document.getElementById("empty-coupond-container").classList =
      "empty-coupond-container d-block";
  } else {
    document.getElementById("coupond-container-body").classList =
      "row coupond-container-body d-block";
    document.getElementById("empty-coupond-container").classList =
      "empty-coupond-container d-none";
  }
}
