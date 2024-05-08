<?php
    class PhanQuyenModel{
        public function getInstance(){
            require_once __DIR__.'\..\MODEL\Database.php';
        }
        public function getChiTietQuyenById($id){
            $this->getInstance();
            $db=new Database();
            $conn=$db->getConnection();
            $sql="SELECT quyen.tenQuyen,chucnang.ten,chucnang.id,chitietquyen.TinhTrang,chitietquyen.hanhdong FROM `chucnang`,`quyen`,`chitietquyen` WHERE quyen.id=$id AND chucnang.id=chitietquyen.idchucnang AND quyen.id=chitietquyen.idquyen";
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
        public function getTenQuyen(){
            $this->getInstance();
            $db=new Database();
            $conn=$db->getConnection();
            $sql="SELECT quyen.tenQuyen,quyen.id FROM `quyen` WHERE id NOT IN (1,2)";
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
        public function getTenQuyenByID($id){
            $this->getInstance();
            $db=new Database();
            $conn= $db->getConnection();
            $sql = "SELECT `tenQuyen` FROM `quyen` WHERE  `id`='$id'";
            $result=mysqli_query($conn, $sql);
            if($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                return $row['tenQuyen'];
            }
        }
        public function checkIdtontai($id){
            $this->getInstance();
            $db= new Database();
            $conn= $db->getConnection();
            $sql= "SELECT `idquyen` FROM `chitietquyen` WHERE `idquyen`=$id";
            $result= mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0)
            {
                return false;
            }else
                return true;
        }
        public function getIdByHanhdong($hanhdong,$idchucnang,$idquyen){
            $this->getInstance();
            $db= new Database();
            $conn=$db->getConnection();
            $sql="SELECT `id` FROM `chitietquyen` WHERE `hanhdong`='$hanhdong' AND `idchucnang`=$idchucnang AND `idquyen`=$idquyen";
            $resutl=mysqli_query($conn,$sql);
            if($resutl&&mysqli_num_rows($resutl)>0){
                $row = mysqli_fetch_assoc($resutl);
                return $row['id'];
            }
        }
        public function getTinhTrang($hanhdong,$idchucnang,$idquyen){
            $this->getInstance();
            $db= new Database();
            $conn=$db->getConnection();
            $sql="SELECT `TinhTrang` FROM `chitietquyen` WHERE `hanhdong`='$hanhdong' AND `idchucnang`='$idchucnang' AND `idquyen`=$idquyen";
            $resutl=mysqli_query($conn,$sql);
            if($resutl&&mysqli_num_rows($resutl)>0){
                $row = mysqli_fetch_assoc($resutl);
                return $row['TinhTrang'];
            }
        }
        public function getlistChucnang(){
            $this->getInstance();
            $db=new Database();
            $conn=$db->getConnection();
            $sql="SELECT * FROM chucnang";
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
        public function insertPhanQuyenvoiTinhTrang($id,$idquyen,$idchucnang,$hanhdong,$tinhtrang){
            $this->getInstance();
            $db=new Database();
            $conn=$db->getConnection();
            $sql="INSERT INTO `chitietquyen` ( `id`,`idquyen`,`idchucnang`,`hanhdong`,`TinhTrang`) VALUES ('$id','$idquyen','$idchucnang','$hanhdong','$tinhtrang')";
            $result=mysqli_query($conn,$sql);
            return $result;
        }
        public function insesrtQuyen($tenQuyen)
        {
            $this->getInstance();
            $db= new Database();
            $conn=$db->getConnection();
            $sql= "INSERT INTO `quyen` (`tenQuyen`) VALUES ('$tenQuyen') ";
            $result=mysqli_query($conn,$sql);
            return $result;
        }
        public function updatePhanQuyenvoiTinhtrangHanhdongThem($id,$idchucnang,$idquyen,$TinhTrang){
            $this->getInstance();
            $db=new Database();
            $conn=$db->getConnection();
            $sql = "UPDATE `chitietquyen` SET  `TinhTrang`='$TinhTrang' WHERE `id`=$id AND `idquyen`=$idquyen AND `idchucnang`=$idchucnang";
            $result=mysqli_query($conn, $sql);
            return $result;
        }
        public function updateTenQuyenById($id,$tenQuyen){
            $this->getInstance();
            $db= new Database();
            $conn= $db->getConnection();
            $sql= "UPDATE `quyen` SET `tenQuyen`='$tenQuyen' WHERE `id`=$id";
            $result= mysqli_query($conn,$sql);
            return $result;
        }
        public function deleteQuyen($id){
            $this->getInstance();
            $db = new Database();
            $conn= $db->getConnection();
            $sql= "DELETE FROM `quyen` WHERE `id`=$id";
            $result= mysqli_query($conn,$sql);
            return $result;
        }
        public function deleteChiTietQuyen($id,$idquyen,$idchucnang){
            $this->getInstance();
            $db= new Database();
            $conn= $db->getConnection();
            $sql = "DELETE FROM `chitietquyen` WHERE `id`=$id AND `idquyen`=$idquyen AND `idchucnang`=$idchucnang";
            $result= mysqli_query($conn,$sql);
            return $result;
        }   
        public function GetIdmoinhat(){
            $this->getInstance();
            $db= new Database();
            $conn=$db->getConnection();
            $sql= "SELECT MAX(id) + 1 AS next_id FROM chitietquyen";
            $resutl=mysqli_query($conn,$sql);
            if($resutl&&mysqli_num_rows($resutl)>0){
                $row = mysqli_fetch_assoc($resutl);
                return $row['next_id'];
            }
        }
        public function getmaQuyenbyId($id){
            $this->getInstance();
            $db = new Database();
            $conn= $db->getConnection();
            $sql= "SELECT taikhoan.maQuyen FROM `taikhoan` WHERE `id`=$id";
            $resutl=mysqli_query($conn,$sql);
            if($resutl&&mysqli_num_rows($resutl)>0){
                $row = mysqli_fetch_assoc($resutl);
                return $row['maQuyen'];
            }
        }
        public function getIdChucnangbyTenChucnang($ten){
            $this->getInstance();
            $db = new Database();
            $conn= $db->getConnection();
            $sql= "SELECT chucnang.id FROM `chucnang` WHERE `ten`='$ten' ";
            $resutl=mysqli_query($conn,$sql);
            if($resutl&&mysqli_num_rows($resutl)>0){
                $row = mysqli_fetch_assoc($resutl);
                return $row['id'];
            }
        }
    }
?>