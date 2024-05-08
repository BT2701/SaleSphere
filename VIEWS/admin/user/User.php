<?php
    require_once __DIR__.'\..\..\..\CONTROLLER\UserController.php';
    $userController= new UserController();
    $userList=$userController->getDataForView();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tài khoản</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/web2/STATIC/css/user.css">

</head>
<body >
    <div class="main">
        <div class="container">
            <hr>
            <a href="/web2/VIEWS/admin/admin_home.php?page=quanLyTaiKhoan" style="text-decoration: none; color: black;"><h1>Danh sách tài khoản</h1></a>
            <hr>
            <?php
                if (isset($_GET["msg"])) {
                $msg = $_GET["msg"];
                echo '<div id="myAlert" class="alert alert-warning alert-dismissible fade show" role="alert">
                ' . $msg . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
                if(isset($_GET['chon'])&&$_GET['chon']=='them')
                    require 'user/add_User.php';
                elseif(isset($_GET['chon'])&&$_GET['chon']=='sua'){
                    require 'user/edit_User.php';
                }
                elseif(isset($_GET['chon'])&&$_GET['chon']=='xoa'){
                    $userController->delete();
                }

            ?>
            <br>
            <div class="chucnang">
                <a href="/web2/VIEWS/admin/admin_home.php?page=quanLyTaiKhoan&&chon=them" class="btn btn-success mb-3"><i class="fa-solid fa-plus"></i> Thêm mới</a>
                <form class="row">
                    <div class="col-md-3">
                        <select class="phanloai form-select mb-3">
                            <option selected value="name">Tìm theo tên</option>
                            <option value="email">Tìm theo email</option>
                            <option value="phone_number">Tìm theo sđt</option>
                        </select>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="timkiem form-control mb-3" placeholder="Tìm kiếm">
                    </div>
                </form>
            </div>
            <table class="table table-bordered custom-border" style="text-align: center;">
                <thead class="table-dark">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên tài khoản</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Mật khẩu</th>
                    <th scope="col">Quyền</th>
                    <th scope="col">Tình trạng</th>
                    <th scope="col">Xem/Sửa</th>
                    <th scope="col">Xóa</th>
                    </tr>
                </thead>
                <tbody class="danhsach">
                <?php if(isset($userList)&&!empty($userList)) ?>
                <?php foreach($userList as $user1): ?>
                    <tr>
                        <td><?php echo $user1['id'] ?></td>
                        <td><?php echo $user1['tenTaiKhoan'] ?></td>
                        <td><?php if($user1['email']=='0'||$user1['email']=='') {echo "Chưa cập nhật";} else {echo $user1['email'];} ?></td>
                        <td><?php if($user1['sdt']=='0'||$user1['sdt']=='') {echo "Chưa cập nhật";} else {echo $user1['sdt'];} ?></td>
                        <td><?php echo $user1['matKhau'] ?></td>
                        <td><?php echo $user1['tenQuyen'] ?></td>
                        <td><?php if($user1['TinhTrang']==1) {echo "Đang hoạt động";} else {echo "Bị khóa";} ?></td>
                        <td ><a href="/web2/VIEWS/admin/admin_home.php?page=quanLyTaiKhoan&&chon=sua&&id=<?php echo $user1['id']?>" class="link-dark btn btn-success" style="text-align: center;"><i class="fa-solid fa-pen-to-square fs-5"></i></a></td>
                        <td><a href="/web2/VIEWS/admin/admin_home.php?page=quanLyTaiKhoan&&chon=xoa&&id=<?php echo $user1['id']?>" class="link-dark btn btn-danger"><i class="fa-solid fa-trash fs-5"></i></a></td>
                    </tr>     
                    <?php endforeach;?>    
                </tbody>
                
            </table>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="/web2/STATIC/js/User.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.timkiem').keyup(function(){
                var key = $('.timkiem').val()+','+$('.phanloai').val();
                $.post('user/Search.php',{data: key},function(data){
                    $('.danhsach').html(data);
                })
            })
        })
    </script>
    
</body>
</html>
