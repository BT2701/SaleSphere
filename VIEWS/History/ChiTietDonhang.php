
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/web2/STATIC/css/LichSuDonHang.css">
</head>
<body>
    <div class="container">
        <h1 class="">Chi Tiết Đơn Hàng</h1>
        <div id="ChiTietDonHang" class="row">
            <!-- Dữ liệu Chi Tiết Đơn Hàng sẽ được hiển thị ở đây -->
        </div>
    </div>
    

    <!-- Bootstrap JavaScript và các thư viện liên quan -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- JavaScript tải dữ liệu đơn hàng -->
    <script src="/web2/STATIC/js/ChiTietDonHang.js"></script>
    <script>
        $(document).ready(function() {
        var customerId=<?php echo $_POST['idkhachhang']?>;
        var iddonhang=<?php echo $_POST['iddonhang']?>;
        FirstLoad(customerId,iddonhang);
        });
    </script>

    
</body>
</html>

