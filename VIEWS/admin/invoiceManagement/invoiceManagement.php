
<?php
   require_once __DIR__.'\..\..\..\MODEL\PhanQuyenModel.php'; 

   if(isset($_SESSION['id'])&&$_SESSION['id']!="")
   {
       $id=$_SESSION['id'];
   }
   $phanquyenmodel= new PhanQuyenModel();

   

?>
<!-- Lưu ý -->
<!-- Nhớ cập nhật lại mã nhân viên trong InvoiceManagementModel ( cancelOrder và confirmOrder) vì đang lấy tạm thời maNV=5 -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="../../STATIC/js/invoiceManagement.js"></script>
    <title>Invoice Management</title>
    <style>
        th{
            text-align: center;
        }
        td{
            text-align: center;
            vertical-align: middle;
        }
        .chucnang{
            text-align: left !important;
        }
    </style>
</head>

<body>

<section id="searching" class="container" style="width: 70%;">
    <div class="text-center align-middle m-3">
        <div>
            <input type="radio" name="selectType" id="checkAllRadio" class="checkAll radio" value="checkAll" onchange="onRadioChange(this)" checked>
            <label for="checkAll">Liệt kê tất cả</label>

            <input id="checkPeriod" type="radio" name="selectType"  style="margin-left: 50px" value="checkPeriod" onchange="onRadioChange(this)">
            <label id="labelForCheckPeriod" for="selectType">Liệt kê theo khoảng thời gian</label>
            <div id="Date" style="display:none">
            <label for="startDateInput" > Từ</label>
            <input type="date" name="startDateInput" id="startDate" onchange="dateChange(1)">
            <label for="endDateInput" style="margin-left: 10px">Đến</label>
            <input type="date" name="endDateInput" id="endDate" onchange="dateChange(2)">
            </div>
        </div>
    </div>
    <div class="input-group mb-3">
        
        <input type="text" class="form-control" id="searchInput" style="border-color: gray;"  placeholder="Nhập nội dung tìm kiếm..." aria-label="Tìm kiếm theo..." aria-describedby="basic-addon2">
        <select class="form-control-sm "  id="searchSelect">
            <option value="maHoaDon">Mã hóa đơn</option>
            <option value="maKhachHang">Mã khách hàng</option>
            <option value="maNhanVien">Mã nhân viên</option>
            <option value="tinhTrangDonHang">Tình trạng đơn hàng</option>
        </select>
        <div class="input-group-append">
            <button class="btn btn-success" id="searchButton" style="border-radius: 0px 5px 5px 0px !important " type="button">Tìm kiếm</button>
        </div>
    </div>
</section>

<section id="invoiceTable" class="" style="width:auto; margin: 0px 50px 0px 50px">
    <table class="table table-striped table-hover" >
        <thead >
            <tr class="thead table-primary ">
                <th scope="col">#</th>
                <th scope="col">Mã hóa đơn</th>
                <th scope="col">Mã khách hàng</th>
                <th scope="col">Ngày đặt hàng</th>
                <th scope="col">Mã nhân viên</th>
                <th scope="col">Tình trạng đơn hàng</th>
                <th scope="col">Tổng tiền</th>
                <th scope="col">Chức năng</th>
            </tr>
        </thead>
        <?php if($phanquyenmodel->getTinhTrang('X',$phanquyenmodel->getIdChucnangbyTenChucnang("Quản lý hóa đơn"),$phanquyenmodel->getmaQuyenbyId($id))){ ?>
        <tbody>
        
        </tbody>
        <?php } else {} ?>
    </table>

        <!-- Modal -->


</section>
<div class="modal fade" id="invoiceDetailsModal" tabindex="-1" role="dialog" aria-labelledby="invoiceDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="invoiceDetailsModalLabel" >Chi tiết hóa đơn</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Chi tiết hóa đơn sẽ được hiển thị ở đây -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>




</body>

</html>
