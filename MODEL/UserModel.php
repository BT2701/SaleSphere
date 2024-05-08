<?php
    class UserModel{
        public function getInstance(){
            require_once __DIR__.'\..\MODEL\Database.php';
        }
        public function getAll(){
            $this->getInstance();
            $db=new Database();
            $conn=$db->getConnection();
            $sql="SELECT users.id,users.email,users.sdt,taikhoan.tenTaiKhoan,taikhoan.matKhau,taikhoan.TinhTrang,quyen.tenQuyen
            FROM users,taikhoan,quyen
            where taikhoan.TinhTrang = 1 AND taikhoan.maQuyen=quyen.id AND users.id=taikhoan.id AND users.id NOT IN (1) ORDER BY users.id ASC";
            $userList=array();
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->get_result();
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    $userList[]= $row;
                }
            }
            $conn->close();
            return $userList;
        } 
        public function getListByID($id){
            $this->getInstance();
            $db=new Database();
            $conn=$db->getConnection();
            $sql="SELECT users.id,users.email,users.sdt,taikhoan.tenTaiKhoan,taikhoan.matKhau,taikhoan.TinhTrang,quyen.tenQuyen
            FROM users,taikhoan,quyen
            where users.id=taikhoan.id AND users.id=$id AND taikhoan.maQuyen=quyen.id  ORDER BY users.id ASC";
            $userList=array();
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->get_result();
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    $userList[]= $row;
                }
            }
            $conn->close();
            return $userList;
        } 
        public function insertUser($username,$password,$email,$sdt,$state,$maquyen){
            $this->getInstance();
            $db=new Database();
            $conn=$db->getConnection();
            $sql = "INSERT INTO `users` ( `ten`,`usertype`,`email`,`sdt`) VALUES ('$username','khachhang','$email','$sdt')"; 
            $result = mysqli_query($conn, $sql);
            $sql1 = "INSERT INTO `taikhoan` ( `tenTaiKhoan`, `matKhau`,`maQuyen`,`TinhTrang`) VALUES ('$username',  '$password',$maquyen,$state)"; 
            mysqli_query($conn, $sql1);
            return $result;
        }
        public function updateUser($id,$username,$email,$password,$sdt,$state,$maquyen){
            $this->getInstance();
            $db=new Database();
            $conn=$db->getConnection();
            $sql = "UPDATE `users` SET  `email`='$email', `sdt`='$sdt' WHERE `id`=$id";
            $result=mysqli_query($conn, $sql);
            $sql1="UPDATE taikhoan SET `tenTaiKhoan`='$username' , `matKhau`='$password' ,`TinhTrang`='$state' , `maQuyen`='$maquyen' WHERE `id`=$id";
            mysqli_query($conn,$sql1);
            return $result;
        }
        public function deleteUser($id)
        {
            $this->getInstance();
            $db=new Database();
            $conn=$db->getConnection();
            $sql= "UPDATE `taikhoan` SET 'TinhTrang'= 0 WHERE `id`=$id";
            $result=mysqli_query($conn,$sql);
            return $result;
        }
        public function getTenQuyen(){
            $this->getInstance();
            $db=new Database();
            $conn=$db->getConnection();
            $sql="SELECT quyen.tenQuyen,quyen.id FROM `quyen` WHERE id NOT IN (1)";
            $quyenList=array();
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->get_result();
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    $quyenList[]= $row;
                }
            }
            $conn->close();
            return $quyenList;
        }


        // TRƯỞNG
        public function getById($id){
            $this->getInstance();
            $db=new Database();
            $conn=$db->getConnection();
            $sql="SELECT * FROM users WHERE id = ?";
            $stmt=$conn->prepare($sql);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $result=$stmt->get_result();
            $user=null;
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    $user=$row;
                }
            }
            $conn->close();
            return $user;
        }
    }
?>