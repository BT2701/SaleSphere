<?php
    require_once __DIR__.'\..\..\..\MODEL\PhanQuyenModel.php'; 

    if(isset($_SESSION['id'])&&$_SESSION['id']!="")
    {
        $id=$_SESSION['id'];
    }
    $phanquyenmodel= new PhanQuyenModel();
 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Thống kê</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/web2/STATIC/css/ThongKe.css">
</head>
<body>
    <div>
        <div class="headerThongKe" id="headerThongKe">
            <div class="twoheaderBox">
                <div class="headderBox">
                    <img src="/web2/STATIC/assets/DoneOrder.png" class="leftheaderBox" alt="Product Image ">
                    <div class="rightheaderBox">
                        <div >  Đơn Hàng Đã Hoàn Thành</div>
                        <div style="font-weight: bold; padding-top :2%;" id="TongSoDonHang"> 1000</div>
                    </div>
                </div>
                <div class="headderBox">
                    <img src="/web2/STATIC/assets/GioHangIMG.jpg" class="leftheaderBox" alt="Product Image ">
                    <div class="rightheaderBox">
                        <div> Tổng số sản phẩm</div>
                        <div style="font-weight: bold; padding-top :2%;" id="TongSoSanPham"> 1000</div>
                    </div>
                </div>
            </div>
            <div class="twoheaderBox">
                <div class="headderBox">
                    <img src="/web2/STATIC/assets/money.jpg" class="leftheaderBox" alt="Product Image ">
                    <div class="rightheaderBox">
                        <div> Doanh thu</div>
                        <div style="font-weight: bold; padding-top :2%;"id="TongSoDoanhThu">  </div>
                        <div>VND</div>
                    </div>
                </div>
                <div class="headderBox">
                    <img src="/web2/STATIC/assets/rating.jpg" class="leftheaderBox" alt="Product Image ">
                    <div class="rightheaderBox">
                        <div > Đánh giá tích cực</div>
                        <div style="font-weight: bold; padding-top :2%;"id="DanhGiaTichCuc"> </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-5">
            <h2 class="mt-4 mb-3" style="display: flex; justify-content: center;">Loại Thống Kê</h2>
            <div class="" style="display: flex; justify-content: center; ">
                <select class="form-select selectLoaisanpham" id="idLoaiThongKe" onchange="changeLoaiThongKe()" style="font-size: 20px; text-align: center;">
                    <option value="Thang">Thống Kê Theo Tháng</option>
                    <option value="time">Thống Kê Theo Khoảng Thời Gian</option>
                </select>
            </div>
        </div>

        <div class="comboboxMonthYear" id="idComboboxMonthYear">
            <div class="select">
                <label for="month" style="font-size: 20px; width: 220px; display: flex;align-items: center;font-weight: bold;">Chọn Tháng: </label>
                <select id="month"  onchange="onchangeMonth()" class="form-select" style="font-size: 20px; text-align: center;">
                     <!-- JavaScript sẽ tự động thêm các tùy chọn tháng vào đây -->
                </select>
            </div>
            <div class="select">
                <label for="year" style="font-size: 20px; width: 200px; display: flex;align-items: center;font-weight: bold;">Chọn Năm: </label>
                <select id="year" onchange="onchangeYear()" class="form-select" style="font-size: 20px; text-align: center;">
                    <!-- JavaScript sẽ tự động thêm các tùy chọn năm vào đây -->
                </select>
            </div>
        </div> 


    <!-- pick time -->
    <div class="comboboxMonthYear" id="idDatePicker" style="display: none; ">
        <div class="select">
            <label for="month" style="font-size: 20px; width: 220px; display: flex;align-items: center;font-weight: bold;">Từ ngày:(MM/DD/YYYY) </label>
            <input type="date" id="fromDate" name="fromDate" class="form-control" style="font-size: 20px; text-align: center;" onchange="changeFromDate()">
        </div>
        <div class="select">
            <label for="year" style="font-size: 20px; width: 200px; display: flex;align-items: center;font-weight: bold;">Đến ngày:(MM/DD/YYYY) </label>
            <input type="date" id="toDate" name="toDate" class="form-control" style="font-size: 20px; text-align: center;" onchange="changeToDate()">
        </div>
    </div>




    <div class="container-chart"> 
            <div id="linechart" class="chart"></div>
        </div>
    </div>

    <div class="container" >
        <h2 class="mt-4 mb-3" style="display: flex; justify-content: center;">Loại Sản Phẩm</h2>
        <div class="combobox" style="display: flex; justify-content: center; ">
            <select class="form-select selectLoaisanpham" id="productType" onchange="OnchangeLoaiSP()" style="font-size: 20px; text-align: center;">
                <!-- JavaScript sẽ tự động thêm các tùy chọn Loại sản phẩm vào đây -->
            </select>
        </div>
    </div>


    <div class="container" style="margin-bottom: 5%; " >
        <h2 class="mt-4 mb-3">Top 10 sản phẩm bán chạy nhất</h2>
        <div class="table-responsive">
            <table id="topProductsTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá sản phẩm (VNĐ)</th>
                        <th scope="col">Lượt mua</th>
                        <th scope="col">Chi tiết</th>
                    </tr>
                </thead>
                <?php if($phanquyenmodel->getTinhTrang('L',$phanquyenmodel->getIdChucnangbyTenChucnang("Quản lý thống kê"),$phanquyenmodel->getmaQuyenbyId($id))){ ?>
                <tbody>
                    <!-- Dữ liệu sẽ được thêm vào đây từ mã JavaScript -->
                </tbody>
                <?php } else {} ?>
            </table>
        </div>
    </div>

    <!-- Bao gồm thư viện Bootstrap JavaScript (tuỳ chọn) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/web2/STATIC/js/ThongKe.js"></script>

</body>
</html>
