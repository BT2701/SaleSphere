<?php
class SignUpModel{
    public function getInstance(){
        require_once 'C:\xampp\htdocs\web2\MODEL\Database.php';
    }
    public function registerUser($username, $password) {
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $sql = "INSERT INTO `taikhoan` ( `tenTaiKhoan`,  `matKhau`) VALUES ('$username',  '$password')"; 
        $result = mysqli_query($conn, $sql);
    }
    
    public function isUsernameTaken($username) {
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $sql="Select * from taikhoan where tenTaiKhoan='$username'";
        $result= mysqli_query($conn,$sql);
        $num= mysqli_num_rows($result);
        return $num;
    }
}