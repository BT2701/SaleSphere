<?php

class LoginModel {

    public function getInstance(){
        require_once __DIR__.'\..\MODEL\Database.php';
    }
    public function checkLogin($usernameOrEmail, $password) {
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
    
        // Xử lý chuỗi đầu vào để tránh tấn công SQL injection
        $usernameOrEmail = $conn->real_escape_string($usernameOrEmail);
    
        $query = "SELECT users.id, taikhoan.matKhau,taikhoan.maQuyen
                  FROM taikhoan
                  INNER JOIN users ON taikhoan.id = users.id
                  WHERE (taikhoan.tenTaiKhoan = ? OR users.sdt = ? OR users.email = ?)";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $usernameOrEmail, $usernameOrEmail, $usernameOrEmail);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashedPasswordFromDatabase = $row['matKhau'];
            // Kiểm tra mật khẩu với bcrypt
            if (password_verify($password, $hashedPasswordFromDatabase)) {
                // Đăng nhập thành công, trả về dữ liệu người dùng
                $userData = $row;
                $conn->close();
                return $userData;
            } else {
                // Đăng nhập thất bại vì mật khẩu không khớp
                $conn->close();
                return false;
            }
        } else {
            // Không tìm thấy tài khoản
            $conn->close();
            return false;
        }
    }
    
}
?>