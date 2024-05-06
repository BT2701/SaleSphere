<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coupon Manager</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha384-ZyQnGV8tLw1FXs7QzutYulVJLYBfcG50ZcPLp3X6U3IVgeV+vAzdAdpFTS9vN2xV" crossorigin="anonymous">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="STATIC/css/khuyenmai.css">
</head>

<body onload="autoLoadView(<?php echo count($coupondList) ?>)">
  <div class="container">
    <h1 class="mt-4 mb-4 text-center">Quản Lý Khuyến Mãi</h1>
    <div class="row mb-3">
      <div class="col-md-6 offset-md-3">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search coupons...">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6 offset-md-3 text-center">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createCouponModal"
          onclick="PrepareFormCreateCoupond()"><i class="fas fa-plus"></i>Tạo khuyến mãi</button>
      </div>
    </div>

    <div class="coupond-container container my-5">
      <div class="row coupond-container-header border-bottom border-dark">
        <div class="col-2">
          <p class="text-center fw-bold">Tên Khuyến Mãi</p>
        </div>
        <div class="col-2">
          <p class="text-center fw-bold">Giá Trị (%)</p>
        </div>
        <div class="col-2">
          <p class="text-center fw-bold">Hạn Sử Dụng</p>
        </div>
        <div class="col-2">
          <p class="text-center fw-bold">Background</p>
        </div>
        <div class="col-4">
          <p class="text-center fw-bold">Thao Tác</p>
        </div>
      </div>
      <!-- case empty coupond  -->
      <div id="empty-coupond-container" class="empty-coupond-container d-none">
        <img class="empty-coupond-img" src="../../STATIC/assets/empty-coupond.gif" alt="">
        <span class="empty-coupond-message">Chưa có mã khuyến mãi nào! </span>
      </div>

      <div class="row coupond-container-body" id="coupond-container-body">
        <?php foreach ($coupondList as $coupond): ?>
          <div class="row coupond pt-1 pb-1 border-bottom  d-flex justify-content-center align-items-center"
            id="coupond<?php echo $coupond['id'] ?>" oncontextmenu="showContextMenu(event, <?php echo $coupond['id'] ?>)">
            <div class="col-2">
              <p class="mb-0"><?php echo $coupond['tenKhuyenMai'] ?></p>
            </div>
            <div class="col-2">
              <p class="mb-0 text-center"><?php echo $coupond['giaTri'] ?></p>
            </div>
            <div class="col-2">
              <p class="mb-0 text-center"><?php echo $coupond['hanSuDung'] ?></p>
            </div>
            <div class="col-2">
              <p class="mb-0 text-center"><?php echo $coupond['background'] ?></p>
            </div>
            <div class="col-4 d-flex align-items-center justify-content-center">
              <button class="btn btn-primary btn-sm ms-1" data-bs-toggle="modal" data-bs-target="#createCouponModal"
                onclick="PrepareInfoCoupondEditModal(<?php echo $coupond['id'] ?>)"><i class="fas fa-edit"></i>
                Sửa</button>
              <button class="btn btn-danger btn-sm ms-1 me-1"
                onclick="confirmDeleteCoupond(<?php echo $coupond['id'] ?>,`<?php echo $coupond['tenKhuyenMai'] ?>`)"><i
                  class="fas fa-trash-alt"></i> Xóa</button>
              <button class="btn btn-secondary btn-sm me-1" data-bs-toggle="modal"
                data-bs-target="#viewDetailCoupondModal" onclick="ViewDetailCoupond(<?php echo $coupond['id'] ?>)"><i
                  class="fas fa-eye"></i>Chi tiết</button>
              <button class="btn btn-success btn-sm btn-apply-coupond  me-1" data-bs-toggle="modal"
                data-bs-target="#applyCouponModal" coupond-id="<?php echo $coupond['id'] ?>"
                coupon-name="<?php echo $coupond['tenKhuyenMai'] ?>"
                onclick="PrepareDataApplyModal(<?php echo $coupond['id'] ?>,'<?php echo $coupond['tenKhuyenMai'] ?>')"><i
                  class="fas fa-arrow-right"></i> Áp dụng</button>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>


  <!-- <div class="empty-coupond">
            <img class="empty-coupond_image" src="data:image/png;base64,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" alt="">
            <span class="empty-coupond-message">Not has something</span>
          </div> -->
  <!-- Modal for Create Coupon -->
  <div class="modal fade" id="createCouponModal" tabindex="-1" role="dialog" aria-labelledby="createCouponModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createCouponModalLabel">Tạo Mới Khuyến Mãi</h5>
          <button id="btn-close_createcoupondmodal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            onclick="clearAllErrorMessage()"></button>
        </div>
        <div class="modal-body">
          <form id="createCouponForm" action="" method="POST">
            <input type="hidden" name="action" id="action" value="TaoMoiKhuyemMai">
            <div class="mb-1">
              <label for="couponName" class="col-form-label">Tên khuyến mãi</label>
              <input type="text" class="form-control" name="TenKhuyenMai" id="couponName"
                placeholder="Nhập tên khuyến mãi..." required autofocus tabindex="1"
                oninput="isCorrectNameCoupond(this.value)">
              <div id="coupond-name-error" class="d-none">
                <i class="fa-solid fa-circle-exclamation " style="color: #ff0000;"></i>
                <span id="message-name-error" style="color:red"></span>
              </div>
            </div>
            <div class="mb-1">
              <label for="couponValue" class="col-form-label">Giá trị (%)</label>
              <input type="number" min="1" max="100" name="GiaTriKhuyenMai" class="form-control" id="couponValue"
                placeholder="Nhập giá trị khuyến mãi..." required tabindex="2"
                oninput="isCorrectValueCoupond(this.value)">
              <div id="coupond-value-error" class="d-none">
                <i class="fa-solid fa-circle-exclamation " style="color: #ff0000;"></i>
                <span id="message-value-error" style="color:red"></span>
              </div>
            </div>
            <div class="mb-1">
              <label for="expirationDate" class="col-form-label">Hạn sử dụng</label>
              <input type="date" style="cursor: pointer;" name="HanKhuyenMai" class="form-control" id="expirationDate"
                required tabindex="3" oninput="isCorrectDateCoupond(this.value)">
              <div id="coupond-date-error" class="d-none">
                <i class="fa-solid fa-circle-exclamation " style="color: #ff0000;"></i>
                <span id="message-date-error" style="color:red"></span>
              </div>
            </div>
            <div class="mb-1">
              <label for="couponBackground" class="col-form-label">Background</label>
              <input type="color" style="cursor: pointer;" value="#FF0000" name="Background" class="form-control"
                id="couponBackground" required tabindex="4">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
            onclick="clearAllErrorMessage()">Hủy</button>
          <button type="submit" class="btn btn-primary" id="submitCouponBtn" tabindex="5">Lưu</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for Apply Coupon -->
  <div class="modal fade" id="applyCouponModal" tabindex="-1" role="dialog" aria-labelledby="applyCouponModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="applyCouponModalLabel">Áp Dụng Khuyến Mãi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form for applying a coupon -->
          <form id="applyCouponForm">
            <div class="mb-2">
              <label for="couponNameApply" class="col-form-label">
                Tên khuyến mãi:
                <span id="test" style="font-weight: 600"></span>
              </label>
            </div>
            <div class="mb-2">
              <label for="applyFor" class="col-form-label">Áp dụng cho</label>
              <select class="form-control" id="applyFor" style="cursor: pointer;">
                <option value="all">Tất cả sản phẩm</option>
                <option value="select-product">Chọn sản phẩm</option>
              </select>
            </div>

            <div id="productTypeCheckbox" style="display: none;">

            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="applyCoupondBtn">Lưu</button>
        </div>
      </div>
    </div>
  </div>



  <!-- Modal view detail coupond -->
  <div class="modal fade" id="viewDetailCoupondModal" tabindex="-1" role="dialog"
    aria-labelledby="viewDetailCoupondModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="couponModalLabel">Coupon Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-2 row">
              <label class="col-sm-4 col-form-label">Name:</label>
              <div class="col-sm-8">
                <span id="coupond-name" class="form-control">
              </div>
            </div>
            <div class="mb-2 row">
              <label class="col-sm-4 col-form-label">Value Discount:</label>
              <div class="col-sm-8">
                <span id="coupond-value" class="form-control"></span>
              </div>
            </div>
            <div class="mb-2 row">
              <label class="col-sm-4 col-form-label">Date:</label>
              <div class="col-sm-8">
                <span id="expiration-date" class="form-control"></span>
              </div>
            </div>
            <div class="mb-2 row">
              <label class="col-sm-4 col-form-label">Background Color:</label>
              <div class="col-sm-8">
                <span id="background-color" class="form-control"></span>
              </div>
            </div>
            <div class="mb-2 row">
              <label class="col-sm-4 col-form-label">Products applied:</label>
              <div class="col-sm-8 product-applied-container">

              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="STATIC/js/khuyenmai.js"></script>
  <script>
    document.getElementById('applyFor').addEventListener('change', function () {
      applyForValue = this.value;
      // Check if the selected option is "select-type"
      if (applyForValue === 'select-product') {
        // Show the checkboxes
        document.getElementById('productTypeCheckbox').style.display = 'block';
        //Load Danh Sach Product len 
      } else {
        // Hide the checkboxes for other options
        document.getElementById('productTypeCheckbox').style.display = 'none';
      }
    });
  </script>
</body>

</html>