<?php
// Đảm bảo rằng request là POST request
require 'C:\xampp\htdocs\web2\MODEL\Database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $username = $_POST["Username"];
    $password = $_POST["Password"];
    $cpassword = $_POST["cPassword"];


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
        if(!preg_match("/^[a-zA-Z0-9]+$/",$username)) {
            $errors['username3'] = 'Tên đăng nhập chỉ bao gồm chữ cái, số';
        }
        if(!preg_match("/^.*(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&*()-]).*$/",$password)) {
            $errors['password1'] = 'Mật khẩu phải chứa ít nhất 1 chữ thường, 1 chữ hoa, 1 ký tự đặc biệt (@#$%^&*()-), 1 chữ số';
        }
        if (strlen($password) <= 12) {
            $errors['password2'] = 'Mật khẩu ít nhất phải có 12 kí tự';
        }
    if (empty($password)) {
        $errors['password'] = 'Mật khẩu không được để trống';
    }
    if ($password != $cpassword) {
        $errors['cPassword'] = 'Mật khẩu không khớp';
    }
    $sql="Select * from taikhoan where tenTaiKhoan='$username'";
    $db = new Database();
    $conn = $db->getConnection();

    
    $result= mysqli_query($conn,$sql);

    $num= mysqli_num_rows($result);
    if($num>0)
    {
        $errors['username0'] = 'Tên tài khoản đã tồn tại. VUI LÒNG ĐỔI TÊN!';
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
?>