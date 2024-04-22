<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="formxuly">
                    <h2>Thêm tài khoản</h2>
                    <br>
                    <form action="/web2/CONTROLLER/UserController.php?controller=them" method="post" id="Form1">
                        <label>Tên</label>
                        <input type="text" name="username" id="Username">
                        <p id="errorusername"></p>
                        <label>Email</label>
                        <input type="text" name="email" id="Email">
                        <p id="erroremail"></p>
                        <label class="lbphone_number">SĐT</label>
                        <input type="text" name="phone_number" id="Phone_number">
                        <p id="errorphone_number"></p>
                        <label>Mật khẩu</label>
                        <input type="text" name="password" id="Password">
                        <p id="errorpassword"></p>
                        <label>Quyền</label>
                        <select style="width:300px;" class="phanquyen" name="PhanQuyen" >
                            <option value="1">Admin</option>
                            <option value="4">Quản lý</option>
                            <option value="3">Nhân viên</option>
                            <option  selected value="2">Khách hàng</option>
                         </select>
                         <br> <br>
                        <label>Tình trạng</label>
                        <input class="cb" type="radio" name="cbstate" id="action" value="Action" checked />
                        <label class="lbcb">Hoạt động</label>
                        <input class="cb" type="radio" name="cbstate" id="block" value="Block" />
                        <label class="lbcb">Bị khóa</label>
                        <br> <br> 
                        <input type="submit" class="btn btn-success mb-3 btnthem" value="Thêm" id="tinh" name="btntinh">
                    </form>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                <script src="/web2/STATIC/js/validation_add.js"></script>
</body>
</html>