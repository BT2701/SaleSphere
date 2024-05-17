<?php
// Đảm bảo rằng request là POST request
require 'C:\xampp\htdocs\SaleSphere\MODEL\Database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $username = $_POST["username"];
    $email1= $_POST['email'];
    $sdt1=$_POST['phone_number'];
    $password = $_POST["password"];


    // Kiểm tra dữ liệu
    $errors = array();
    if (empty($username)) {
        $errors['username'] = 'Tên đăng nhập không được để trống';
    }
    if (strlen($username) < 6) {
        $errors['username1'] = 'Tên đăng nhập phải có ít nhất 6 ký tự';
    }
    if (strlen($username) >= 20) {
        $errors['username2'] = 'Tên đăng nhập chỉ có tối đa 20 kí tự';
    }
    if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
        $errors['username3'] = 'Tên đăng nhập chỉ bao gồm chữ cái, số';
    }
    if (!preg_match("/^.*(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&*()-]).*$/", $password)) {
        $errors['password1'] = 'Mật khẩu phải chứa ít nhất 1 chữ thường, 1 chữ hoa, 1 ký tự đặc biệt (@#$%^&*()-), 1 chữ số';
    }
    if (strlen($password) <= 12) {
        $errors['password2'] = 'Mật khẩu ít nhất phải có 12 kí tự';
    }
    if (empty($password)) {
        $errors['password'] = 'Mật khẩu không được để trống';
    }
    $sql = "Select tenTaiKhoan from taikhoan where tenTaiKhoan='$username'";
    $db = new Database();
    $conn = $db->getConnection();


    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);
    if ($num > 0) {
        $errors['username0'] = 'Tên tài khoản đã tồn tại. VUI LÒNG ĐỔI TÊN!';
    }
    if (!preg_match("/^[A-Za-z\._\0-9]*[@?][A-Za-z]*[\.][a-z]{2,4}$/", $email1)&&!empty($email1)) {
        $errors['email10'] = 'Email chưa đúng định dạng. VD: example@gmail.com';
    }
    if(!preg_match("/^\d{10}$/",$sdt1)&&!empty($sdt1)){
        $errors['phone_number10']='Số điện thoại không được có chữ và đủ 10 số';
    }
  
    if(empty($errors)){
        $response= array(
            'success'=> true
        );
    } else{
        $response = array(
            'success' => false,
            'errors' => $errors
        );
    }

    // Nếu không có lỗi, tiến hành xử lý
    if (empty($errors)) {
        // Tiếp tục xử lý dữ liệu (ví dụ: lưu vào cơ sở dữ liệu)
        // Sau khi xử lý, trả về một phản hồi JSON cho client
        $response = array(
            'success' => true
        );
    } else {
        // Nếu có lỗi, trả về thông báo lỗi dưới dạng JSON
        $response = array(
            'success' => false,
            'errors' => $errors
        );
    }

    // Trả về kết quả dưới dạng JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

