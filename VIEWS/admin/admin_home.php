<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- link css reset normalize -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
        integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- link bootstrap 5  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- link font-awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- link css header style  -->

</head>
<body>
    <?php
    session_start();
    include 'admin_header.php';
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
        if($page == 'homepage') {
            include 'slider/slider.php';
        } elseif($page == 'quanLySanPham') {
            include 'product/quan_ly_san_pham.php';
        } elseif($page == 'promote') {
            include '/web2/VIEWS/promote/promote.php';
        }
        else if ($page == 'productdetail') {
            include '/web2/VIEWS/productdetail/product-detail.php';
        }
        else if ($page == 'quanLyNhapHang') {
            include 'nhaphang/nhaphang.php';
        }
        else if ($page == 'quanLyTaiKhoan') {
            include 'user/User.php';
        }
        else if ($page == 'quanLyPhanQuyen') {
            include 'phanquyen/phanquyen.php';
        }
        else if ($page == 'quanLyHoaDon') {
            include 'invoiceManagement/invoiceManagement.php';
        }
        else if($page=='quanLyKhuyenMai'){
            include '../../ROUTES/KhuyenMaiRoutes.php';
        }
        else if($page=='thongKe'){
            include 'ThongKe/ThongKe.php';
        }
        
        
    } else {
        // Mặc định khi không có tham số, hiển thị trang home.php
        include 'slider/slider.php';
    }



    //include 'admin_footer.php';


    ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<script src="https://kit.fontawesome.com/56362bb265.js" crossorigin="anonymous"></script>

</html>
