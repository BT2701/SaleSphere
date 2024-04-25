<?php
     require_once 'C:\xampp\htdocs\web2\CONTROLLER\PhanQuyenController.php';
     $phanquyenController= new PhanQuyenController();
     $phanquyenList=$phanquyenController->getListTenQuyen();
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý phân quyền</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/web2/STATIC/css/phanquyen.css">
</head>
<body>
    <div class="main">
        <div class="container">
        <hr>
            <a href="/web2/VIEWS/admin/admin_home.php?page=quanLyPhanQuyen" style="text-decoration: none; color: black;"><h1>Danh sách phân quyền</h1></a>
        <hr>
        <?php
            if (isset($_GET["msg"])) {
                $msg = $_GET["msg"];
                echo '<div id="myAlert" class="alert alert-warning alert-dismissible fade show" role="alert">
                ' . $msg . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
                
        ?>
        <a href="/web2/VIEWS/admin/admin_home.php?page=quanLyPhanQuyen&chon=them" class="btn btn-success mb-3"><i class="fa-solid fa-plus"></i> Thêm quyền</a>
        <h3>Quyền hiện tại</h3>
        <form action="/web2/CONTROLLER/PhanQuyenController.php?controller=sua" method="post">
            <select class="phanloai form-select mb-3" name="phanloai">
            <?php if(isset($phanquyenList)&&!empty($phanquyenList)) ?>
            <?php foreach($phanquyenList as $user1): ?>
                            <?php if(isset($_GET['id'])&&$_GET['id']==$user1['id']){ ?>
                            <option selected value="<?php echo $user1['id']?>"><?php echo $user1['tenQuyen'] ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $user1['id']?>"><?php echo $user1['tenQuyen'] ?></option>
                            <?php }?>
            <?php endforeach;?>
            </select>
            <div style="text-align: center;">
                <input type="submit" class="btn btn-success mb-3 " value="Sửa quyền"></input>
                
            </div>
        </form>
        <?php
            if(isset($_GET['chon'])&&$_GET['chon']=='them')
                require 'add_Quyen.php';
            elseif(isset($_GET['chon'])&&$_GET['chon']=='sua'){
                require 'edit_Quyen.php';
            }
            elseif(isset($_GET['chon'])&&$_GET['chon']=='xoa'){
                $phanquyenController->delete();
            }
        ?>
        </div>
    </div>  
    <script src="/web2/STATIC/js/User.js"></script>
</body>
</html>