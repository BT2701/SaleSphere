<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/web2/STATIC/css/sign_up.css">
    <link rel="stylesheet" href="/web2/STATIC/css/evaluate.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Đánh Giá Sản Phẩm</title>
    
    <!-- Custom CSS -->
    <style>
        .custom-star {
            color: #FFD700; /* Màu vàng */
            font-size: 24px; /* Kích thước lớn hơn */
        }
    </style>
</head>
<body style="">
    <?php
        require_once 'C:\xampp\htdocs\web2\CONTROLLER\evaluateController.php';
        $evaluateController =new evaluateController();
        $idSanPham=$_POST['idsanpham'];
        $idKhachHang=$_POST['idkhachhang'];
        $idHoaDon=$_POST['iddonhang'];

        $SanPhamDanhGia=$evaluateController ->GetSanPhamDanhGia( $_POST['idsanpham']);
    ?>   
<div style="height: 100vh; width:100%; background-color:#ADD8E6;">
    <form action="EvaluateRoute.php?" method="POST" onsubmit="return checkInfoEvalute()">
        <input type="hidden" name="txtidSanPham" id="id" value="<?php echo $idSanPham; ?>">
        <input type="hidden" name="txtidKhachHang" id="id" value="<?php echo $idKhachHang; ?>">
        <input type="hidden" name="txtidHoaDon" id="id" value="<?php echo $idHoaDon; ?>">

        <input type="hidden" name="txtselectedStar" id="selectedStar" value="0"> <!-- Trường ẩn để lưu giá trị selectedStar -->
        <input type="hidden"  name="act" value="AddEvalute"> <!-- Thay đổi giá trị ở đây nếu cần -->
        <div class=" p-4" style="background-color: #ADD8E6;">
            <h1 class="text-center">Đánh Giá Sản Phẩm</h1>
        <!-- First set of product information and image -->
            <div class="row">
                <div class="col-md-2 ">
                <!-- Product image -->
                    <img src="<?php echo $SanPhamDanhGia['src']; ?>" class="img-fluid" alt="Product Image ">
                </div>
                <div class="col-md-5">
                <!-- Product information -->
                    <h2><?php echo $SanPhamDanhGia['tenSanPham']; ?></h2>
                    <h1><?php echo formatPrice($SanPhamDanhGia['giaBan']); echo " VND" ?></h1>

                    <div style="font-size: 25px;">Mô tả:<?php echo $SanPhamDanhGia['moTa']; ?></div>
                    <!-- Add any other product information here -->
                </div>
                <div class="col-md-5">
                    <!-- Đánh giá số sao -->
                    <h1 for="starRating" class="form-label">Chọn số sao:</h1>
                    <div class="mb-3">       
                    <button type ="button" class="star-button" onclick="rateStar(1)" id="star1">&#9733;</button>
                    <button type ="button" class="star-button" onclick="rateStar(2)" id="star2">&#9733;</button>
                    <button type ="button" class="star-button" onclick="rateStar(3)" id="star3">&#9733;</button>
                    <button type ="button" class="star-button" onclick="rateStar(4)" id="star4">&#9733;</button>
                    <button type ="button" class="star-button" onclick="rateStar(5)" id="star5">&#9733;</button>
                </div>
            </div>
            <!-- Ô textbox đánh giá -->
            <div class="mb-3">
                <h2 for="reviewText" class="form-label">Nhận xét:</h2>
                <textarea class="form-control" name ="txtreviewText" id="reviewText" rows="4" placeholder="Viết cảm nhận về sản phẩm của bạn vào đây..."></textarea>
            </div>

        <!-- Nút Gửi Đánh Giá -->
            <button type="submit" name= "act" value="AddEvalute" class="btn btn-primary">Gửi Đánh Giá</button>
        </div>
        <?php
        function formatPrice($price) {
            return number_format($price, 0, ',', '.'); // Chuyển đổi giá thành chuỗi định dạng số
        }
        ?>
    </form>
</div>
</body>
<script src="/web2/STATIC/js/evaluate.js"></script>

</html>
