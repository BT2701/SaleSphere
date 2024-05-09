<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách phiếu nhập</title>
    <link rel="stylesheet" href="/web2/STATIC/css/phieunhaplist.css">
    
</head>
<body>
<?php 
        require_once __DIR__.'\..\..\..\CONTROLLER\NhapHangController.php'; 
        require_once __DIR__.'\..\..\..\CONTROLLER\UserConTroller.php'; 
        require_once __DIR__.'\..\..\..\MODEL\PhanQuyenModel.php'; 

        if(isset($_SESSION['id'])&&$_SESSION['id']!="")
        {
            $id=$_SESSION['id'];
        }
        $phanquyenmodel= new PhanQuyenModel();
        $list=$nhapHangController->layDsPhieuNhap();
        include 'phieunhap_detail.php';
    ?>

    <div class="container mt-5">
        <div class="title-content">
            <h2>Danh Sách Phiếu Nhập</h2>
            <a href="/web2/VIEWS/admin/admin_home.php?page=quanLyNhapHang"><i class="fa-solid fa-xmark"></i></a>
        </div>
        <div class="search">
            <div class="search-by-nhanvien">
                <input type="text" class="form-control" placeholder="Tên nhân viên ..." id="searchInput" onkeyup="timKiemTheoTen()">
            </div>
            <div class="search-by-thoigian">
                <label for="startDate">Từ</label>
                <input type="date" class="form-control" id="startDate">
                <label for="toDate">Đến</label>
                <input type="date" class="form-control" id="toDate">
            </div>
            <div class="type-selection">
                <select name="selection" class="form-select" id="selection">Chọn bộ lọc
                    <option value="nhanvien">Nhân viên</option>
                    <option value="thoigian">Khoảng thời gian</option>
                </select>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="table-wrapper">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Ngày nhập</th>
                            <th scope="col">Tên nhân viên</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Xem chi tiết</th>
                        </tr>
                    </thead>
                    <tbody id="tableData">
                        <?php foreach($list as $item){?>
                        <form action="/web2/CONTROLLER/NhapHangController.php" method="post" id="myForm">
                            <tr>
                                <td>
                                    <?php echo $item['id']; ?>
                                </td>
                                <td><?php echo $item['ngayNhap']; ?></td>
                                <td id="employeeName<?php echo $userController->getByID($item['idUser'])['ten']; ?>"><?php echo $userController->getByID($item['idUser'])['ten']; ?></td>
                                <td><?php echo $item['tongtien']; ?></td>
                                <?php if($phanquyenmodel->getTinhTrang('L',$phanquyenmodel->getIdChucnangbyTenChucnang("Quản lý nhập hàng"),$phanquyenmodel->getmaQuyenbyId($id))){ ?>
                                    <td><button type="button" name="view-detail" class="btn btn-success btn-sm view-detail"  data-id="<?php echo $item['id']; ?>"><i class="fa-solid fa-list" style="font-size:20px;"></i></button></td>
                                <?php } else {} ?>
                            </tr>
                        </form>
                        <?php } ?>
                    </tbody>

                </table>
                </div>
            </div>
            
        </div>
        
            
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/web2/STATIC/js/nhaphang.js"></script>
</body>
</html>