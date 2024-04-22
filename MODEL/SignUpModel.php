<?php
class SignUpModel{
    public function getInstance(){
        require_once 'C:\xampp\htdocs\web2\MODEL\Database.php';
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
    public function registerTaikhoan($username,$password){
        $this->getInstance();
        $db= new Database();
        $conn= $db->getConnection();
        $sql = "INSERT INTO `users` ( `ten`,`usertype`) VALUES ('$username','khachhang')"; 
        $result = mysqli_query($conn, $sql);
        $sql1 = "INSERT INTO `taikhoan` ( `tenTaiKhoan`, `matKhau`,`maQuyen`,`TinhTrang`) VALUES ('$username',  '$password','2','1')"; 
        $result1 = mysqli_query($conn, $sql1);
    }
}