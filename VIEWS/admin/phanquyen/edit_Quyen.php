<?php
        require_once __DIR__.'\..\..\..\CONTROLLER\PhanQuyenController.php';
        $phanquyenController= new PhanQuyenController();
        $phanquyenListDetail=$phanquyenController->getList();
        $phanquyenListChucnang=$phanquyenController->getListChucNang();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
            <div style="text-align: center;">
            <a href="/web2/VIEWS/admin/admin_home.php?page=quanLyPhanQuyen&chon=xoa&&id=<?php echo $_GET['id'] ?>" class="btn btn-danger mb-3">Xóa quyền</a>
            </div>
            <div class="formxuly" style="text-align: center;">
                    <h2>Sửa quyền</h2>
                    <br>
                    <form action="/web2/CONTROLLER/PhanQuyenController.php?controller=suaDetail&&id=<?php echo $_GET['id'] ?>" method="post" id="Form1">
                        <div style="font-size: 20px;">
                        <label style="padding-right: 5px;">Tên quyền</label>
                        <input type="text" name="username" id="Username" style="padding-left: 5px;" value="<?php echo $phanquyenController->getTenQuyenByid() ?>">
                        <input type="hidden" name="usernametemp" id="Usernametemp" value="<?php echo $phanquyenController->getTenQuyenByid() ?>">
                        <p id="errorusername"></p>
                        </div>
                        <table id="permissionsTable" class="permissions-table table table-bordered custom-border">
                            <thead>
                                <tr>
                                    <th>Chức Năng</th>
                                    <th>Thêm</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody> 
                                 <?php if(isset($phanquyenListChucnang)&&!empty($phanquyenListChucnang)) ?>
                                 <?php foreach($phanquyenListChucnang as $user): ?>
                                <tr>
                                <td><?php echo $user['ten'] ?></td>
                                <?php if(isset($phanquyenListDetail)&&!empty($phanquyenListDetail)) ?>
                                 <?php foreach($phanquyenListDetail as $user1): ?>
                                    <?php if($user1['hanhdong']=="T"&&$user1['id']==$user['id']&&$user1['TinhTrang']==1){?>
                                    <td><input type="checkbox" name="hanhdong<?php echo $user['id']?>[]" value="T" checked></td>
                                    <?php }if($user1['hanhdong']=="T"&&$user1['id']==$user['id']&&$user1['TinhTrang']==0){?>
                                    <td><input type="checkbox" name="hanhdong<?php echo $user['id']?>[]" value="T" ></td>
                                    <?php }?>
                                    <?php if($user1['hanhdong']=="S"&&$user1['id']==$user['id']&&$user1['TinhTrang']==1){?>
                                    <td><input type="checkbox" name="hanhdong<?php echo $user['id']?>[]" value="S" checked></td>
                                    <?php }if($user1['hanhdong']=="S"&&$user1['id']==$user['id']&&$user1['TinhTrang']==0){?>
                                    <td><input type="checkbox" name="hanhdong<?php echo $user['id']?>[]" value="S" ></td>
                                    <?php } ?>
                                    <?php if($user1['hanhdong']=="X"&&$user1['id']==$user['id']&&$user1['TinhTrang']==1){?>
                                    <td><input type="checkbox" name="hanhdong<?php echo $user['id']?>[]" value="X" checked></td>
                                    <?php }if($user1['hanhdong']=="X"&&$user1['id']==$user['id']&&$user1['TinhTrang']==0){?>
                                    <td><input type="checkbox" name="hanhdong<?php echo $user['id']?>[]" value="X" ></td>
                                    <?php } ?>
                                    <?php endforeach;?>  
                                </tr> 
                                <?php endforeach;?>  
                            </tbody>
                        </table>
                        <input type="submit" class="btn btn-success mb-3 btnthem" value="Sửa" id="tinh" name="btntinh">
                    </form>
                    
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                <script src="/web2/STATIC/js/validation_editQuyen.js"></script>
</body>
</html>