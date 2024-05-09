<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Giỏ Hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="/web2/STATIC/css/phieunhaplist.css">
    <!-- Thêm icon của Font Awesome -->
</head>

<body>
    <?php require_once __DIR__.'\..\..\..\CONTROLLER\SanPhamController.php';
        require_once __DIR__.'\..\..\..\CONTROLLER\NhapHangController.php'; 
        require_once __DIR__.'\..\..\..\MODEL\PhanQuyenModel.php'; 

        if(isset($_SESSION['id'])&&$_SESSION['id']!="")
        {
            $id=$_SESSION['id'];
        }
        $phanquyenmodel= new PhanQuyenModel();
        $detailCartList=$nhapHangController->layDsGioHangNhap();
        $tongThanhToan=0;
        $idUser=2; /* ĐẶT TẠM GIÁ TRỊ USER */
    ?>
    <div class="container mt-5">
        <div class="title-content" >
            <h2>Giỏ Hàng</h2>
            <a href="/web2/VIEWS/admin/admin_home.php?page=quanLyNhapHang"><i class="fa-solid fa-xmark"></i></a>
        </div>
        <div class="row" style="padding-top: 10px;padding-bottom: 10px; ">
            <div class="col-md-8">
                <div class="table-wrapper">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tên Sản Phẩm</th>
                            <th scope="col">Số Lượng</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Thành Tiền</th>
                            <th scope="col">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($detailCartList as $item){
                                if($item['idUser']==$idUser) {?>
                        <form action="/web2/CONTROLLER/NhapHangController.php" method="post" id="myForm">
                        <tr>
                            <td>
                                <input type="hidden" name="product_id" value="<?php echo $item['idSanPham']; ?>">
                                <input type="hidden" name="user_id" value="<?php echo $idUser; ?>">
                                <?php echo $item['idSanPham']; ?>
                            </td>
                            <td><img src="<?php echo $controller->detailProduct($item['idSanPham'])['src']; ?>" alt="Product Image" class="product-image"></td>
                            <td><?php echo $controller->detailProduct($item['idSanPham'])['tenSanPham']; ?></td>
                            <td>
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="submit" name="minus">-</button>
                                    <input type="text" class="form-control" id="soLuong" name="soLuong" value="<?php echo $item['soLuong']; ?>">
                                    <button class="btn btn-outline-secondary" type="submit" name="plus">+</button>
                                </div>
                            </td>
                            <td><?php echo $controller->detailProduct($item['idSanPham'])['giaNhap']; ?></td>
                            <?php $gianhap =  $controller->detailProduct($item['idSanPham'])['giaNhap'];
                                $soluong= $item['soLuong'];
                                $tongtien=$gianhap*$soluong;
                                $tongThanhToan=$tongThanhToan+$tongtien;
                            ?>
                            <td><?php echo $tongtien; ?></td>
                            <?php if($phanquyenmodel->getTinhTrang('X',$phanquyenmodel->getIdChucnangbyTenChucnang("Quản lý nhập hàng"),$phanquyenmodel->getmaQuyenbyId($id))){ ?>
                            <td><button type="submit" name="remove" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash fs-5"></i></button></td>
                            <?php } else {} ?>
                        </tr>
                        </form>
                        <?php }} ?>
                    </tbody>
                </table>
                </div>
            </div>
            
        </div>
        <div class="col-md-4" style="border-top:1px solid gray; padding-top:5px;">
                <h3>Tổng thanh toán: <?php echo $tongThanhToan; ?></h3>

                <form action="/web2/CONTROLLER/NhapHangController.php" method="post">
                    <input type="hidden" name="user_id" value="<?php echo $idUser; ?>">
                    <input type="hidden" name="tongThanhToan" value="<?php echo $tongThanhToan; ?>">
                    <?php if($phanquyenmodel->getTinhTrang('T',$phanquyenmodel->getIdChucnangbyTenChucnang("Quản lý nhập hàng"),$phanquyenmodel->getmaQuyenbyId($id))&&$phanquyenmodel->getTinhTrang('S',$phanquyenmodel->getIdChucnangbyTenChucnang("Quản lý nhập hàng"),$phanquyenmodel->getmaQuyenbyId($id))&&$phanquyenmodel->getTinhTrang('X',$phanquyenmodel->getIdChucnangbyTenChucnang("Quản lý nhập hàng"),$phanquyenmodel->getmaQuyenbyId($id))&&$phanquyenmodel->getTinhTrang('L',$phanquyenmodel->getIdChucnangbyTenChucnang("Quản lý nhập hàng"),$phanquyenmodel->getmaQuyenbyId($id))){ ?>
                    <button type="submit" name="thanhToan" class="btn btn-success">Thanh Toán</button>
                    <?php } else {} ?>
                </form>
                
            </div>
            
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var inputSoLuong = document.getElementById('soLuong');
            inputSoLuong.addEventListener("keyup", function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault(); // Ngăn chặn hành động mặc định của nút Enter
                    document.getElementById('myForm').submit(); // Gửi form
                }
            });
        });
</script>
</body>

</html>
