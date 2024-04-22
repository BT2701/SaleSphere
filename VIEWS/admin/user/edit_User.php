<?php
    require_once 'C:\xampp\htdocs\web2\CONTROLLER\UserController.php';
    $userController= new UserController();
    $userListDetail=$userController->getList();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="formxuly">
                    <?php if(isset($userListDetail)&&!empty($userListDetail)) ?>
                    <?php foreach($userListDetail as $user1): ?>
                    <form action="/web2/CONTROLLER/UserController.php?controller=sua&&id=<?php echo $user1['id']?>" method="post" id="Form1">
                        <label>ID</label>
                        <input type="text" name="id" id="Id" value="<?php echo $user1['id']; ?>" readonly>
                        <br><br>
                        <label>Tên</label>
                        <input type="text" name="username" id="Username" value="<?php echo $user1['tenTaiKhoan']; ?>">
                        <input type="hidden" name="usernametemp" id="Usernametemp" value="<?php echo $user1['tenTaiKhoan']; ?>">
                        <p id="errorusername"></p>
                        <label>Email</label>
                        <input type="text" name="email" id="Email" value="<?php if($user1['email']=="0") {echo '';}else {echo $user1['email'];} ?>">
                        <p id="erroremail"></p>
                        <label>SĐT</label>
                        <input type="text" name="phone_number" id="Phone_number" value="<?php if($user1['sdt']=="0") {echo '';}else { echo $user1['sdt'];} ?>">
                        <p id="errorphone_number"></p>
                        <label>Mật khẩu</label>
                        <input type="text" name="password" id="Password" value="<?php echo $user1['matKhau']; ?>">
                        <p id="errorpassword"></p>
                        <label>Quyền</label>
                        <?php if($user1['tenQuyen']=='admin') {?>
                        <select style="width:300px;" class="phanquyen" name="PhanQuyen" >
                            <option selected value="1">Admin</option>
                            <option value="4">Quản lý</option>
                            <option value="3">Nhân viên</option>
                            <option value="2">Khách hàng</option>
                         </select>
                         <?php } elseif($user1['tenQuyen']=='employee') {?>
                        <select style="width:300px;" class="phanquyen" name="PhanQuyen" >
                            <option  value="1">Admin</option>
                            <option value="4">Quản lý</option>
                            <option selected value="3">Nhân viên</option>
                            <option value="2">Khách hàng</option>
                         </select>
                         <?php } elseif($user1['tenQuyen']=='client') {?>
                        <select style="width:300px;" class="phanquyen" name="PhanQuyen" >
                            <option  value="1">Admin</option>
                            <option value="4">Quản lý</option>
                            <option value="3">Nhân viên</option>
                            <option selected value="2">Khách hàng</option>
                         </select>
                        <?php } elseif($user1['tenQuyen']=='quanly') {?>
                            <select style="width:300px;" class="phanquyen" name="PhanQuyen" >
                            <option  value="1">Admin</option>
                            <option selected value="4">Quản lý</option>
                            <option value="3">Nhân viên</option>
                            <option value="2">Khách hàng</option>
                         </select>
                         <?php } ?>
                         <br> <br>
                        <label>Tình trạng</label>
                        <?php if ($user1['TinhTrang'] == 1) { ?>
                            <input class="cb" type="radio" name="cbstate" id="action" value="Action" checked />
                            <label class="lbcb">Hoạt động</label>
                            <input class="cb" type="radio" name="cbstate" id="block" value="Block" />
                            <label class="lbcb">Bị khóa</label>
                        <?php } else { ?>
                            <input class="cb" type="radio" name="cbstate" id="action" value="Action"  />
                            <label class="lbcb">Hoạt động</label>
                            <input class="cb" type="radio" name="cbstate" id="block" value="Block" checked />
                            <label class="lbcb">Bị khóa</label>
                        <?php } ?>
                        <br> <br>
                        <input type="submit"  class="btn btn-success mb-3 btnthem" value="Sửa" id="tinh" name="btntinh">
                    </form>
                    <?php endforeach;?>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                <script src="/web2/STATIC/js/validation_edit.js"></script>
</body>
</html>