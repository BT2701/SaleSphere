<?php

class ForgotPasswordModel{

    public function getInstance(){
        require_once __DIR__.'\..\MODEL\Database.php';
    }


    public function checkEmailExistence($email) {
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        // Chuẩn bị truy vấn SQL
        $query = "SELECT * FROM users WHERE email = ?";
        
        // Chuẩn bị và thực thi truy vấn SQL
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        // Lấy kết quả từ truy vấn
        $result = $stmt->get_result();
        
        // Lấy dữ liệu từ kết quả truy vấn
        $user = $result->fetch_assoc();

        // Kiểm tra xem user có tồn tại hay không
        if ($user !== null) {
            // Nếu tồn tại, trả về true
            return true;
        } else {
            // Nếu không tồn tại, trả về false
            return false;
        }
    }
    public function changePassword($email, $newPassword) {
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        // Chuẩn bị truy vấn SQL
        $query = "UPDATE taikhoan AS tk
                  JOIN users AS u ON u.id = tk.id
                  SET tk.matkhau = ?
                  WHERE u.email = ?";
        
        // Chuẩn bị và thực thi truy vấn SQL
        $stmt = $conn->prepare($query);
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt->bind_param("ss", $hashedPassword, $email);
        $stmt->execute();
    
        if ($stmt->affected_rows > 0) {
            return true; // Trả về true nếu có hàng nào đã được cập nhật
        } else {
            return false; // Trả về false nếu không có hàng nào được cập nhật
        }
    }
    
}
?>
