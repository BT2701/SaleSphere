<?php
    class ProfileModel{
        public function getInstance(){
            require_once 'C:\xampp\htdocs\web2\MODEL\Database.php';
        }
        public function getList($id){
            $this->getInstance();
            $db= new Database();
            $conn= $db->getConnection();
            $sql="SELECT u.id,u.ten, u.email, u.sdt, u.src, u.dob, u.gender,u.diachi
            FROM users u
            WHERE u.id=?";
            ;
            $profileList=array();
            // $result= $conn->query($sql);
            // $profileList=array();
            // if($result->num_rows>0)
            // {
            //     while($row = $result->fetch_assoc()){
            //         $profileList[] =$row;
            //     }
            // }
            // $conn->close();
            $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $profileList[] = $row;
            }
        }
        $conn->close();
            return $profileList;
        }
        public function EditProfile($id,$username,$email,$sdt,$gender,$dob,$address){
            $this->getInstance();
            $db=new Database();
            $conn= $db->getConnection();
            $sql = "UPDATE `users` SET `ten`='$username', `email`='$email', `sdt`='$sdt', `dob`='$dob', `gender`='$gender', `diachi`='$address' WHERE `id`=$id";
            mysqli_query($conn, $sql);
        }
        public function EditImage($id,$src)
        {
            $this->getInstance();
            $db=new Database();
            $conn= $db->getConnection();
            $sql = "UPDATE `users` SET `src`='$src' WHERE `id`=$id";
            mysqli_query($conn, $sql);
        }
        public function GetIdByGoogle($google_id)
    {
        $this->getInstance();
        $db=new Database();
        $conn= $db->getConnection();
        $sql = "SELECT `id` FROM `users` WHERE `google_id`='$google_id'";
        $result=mysqli_query($conn, $sql);
        if($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['id'];
        }
    }
    public function GetIdByFB($fb_id)
    {
        $this->getInstance();
        $db=new Database();
        $conn= $db->getConnection();
        $sql = "SELECT `id` FROM `users` WHERE `facebook_id`='$fb_id'";
        $result=mysqli_query($conn, $sql);
        if($result&& mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            return $row['id'];
        }
    }
    public function change_password($id,$pass){
        $this->getInstance();
        $db=new Database();
        $conn= $db->getConnection();
        $sql = "UPDATE `taikhoan` SET `matKhau`='$pass' WHERE `id`=$id";
        mysqli_query($conn, $sql);
    }
    public function GettenByID($id)
    {
        $this->getInstance();
        $db=new Database();
        $conn= $db->getConnection();
        $sql = "SELECT `ten` FROM `users` WHERE `id`='$id'";
        $result=mysqli_query($conn, $sql);
        if($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['ten'];
        }
    }
    public function getAnhByID($id){
        $this->getInstance();
        $db=new Database();
        $conn= $db->getConnection();
        $sql = "SELECT `src` FROM `users` WHERE `id`='$id'";
        $result=mysqli_query($conn, $sql);
        if($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['src'];
        }
    }
}
?>