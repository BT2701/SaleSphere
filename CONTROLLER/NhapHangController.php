<?php
class NhapHangController{
    public $nhapHangModel;
    public function __construct() {
        require_once 'C:\xampp\htdocs\web2\MODEL\NhapHangModel.php';
        $this->nhapHangModel = new NhapHangModel();
    }

    //1.KHU VỰC GIỎ HÀNG NHẬP
    public function themGioHangNhap(){
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['themgiohangnhap'])){
            $idSanPham=$_POST['product_id'];
            $idUser=2;  //ĐẶT TẠM GIÁ TRỊ CỦA USER HỆ THỐNG
            $soLuong=1; // mỗi lần nhất nút dấu cộng chỉ cộng 1 đơn vị
            $result=$this->nhapHangModel->themGioHangNhap($idSanPham, $idUser, $soLuong);
            if($result){
                echo '<script>window.location.href = "/web2/VIEWS/ADMIN/admin_home.php?page=quanLyNhapHang";</script>';
            }  
        }
    }
    public function laySoLuong($idSanPham, $idUser){
        return $this->nhapHangModel->laySoLuong($idSanPham,$idUser);
    }
    public function capNhatSoLuong(){
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['soLuong']) && $_POST['soLuong'] != $this->laySoLuong($_POST['product_id'],$_POST['user_id'])){   
            $idSanPham=$_POST['product_id'];
            $idUser=$_POST['user_id'];
            $soLuong=$_POST['soLuong'];
            $sl=$soLuong;
            if($sl<1){
                $result=$this->nhapHangModel->xoaDong($idSanPham,$idUser);
                if($result){
                    echo '<script>window.location.href = "/web2/VIEWS/ADMIN/admin_home.php?page=quanLyNhapHang&&luachon=giohang";</script>';
                }
            }
            else{
                $result=$this->nhapHangModel->capNhatSoLuong($idSanPham,$idUser,$sl);
                if($result){
                    echo '<script>window.location.href = "/web2/VIEWS/ADMIN/admin_home.php?page=quanLyNhapHang&&luachon=giohang";</script>';
                }
            }
        }
        
        else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['plus'])){   
            $idSanPham=$_POST['product_id'];
            $idUser=$_POST['user_id'];
            $soLuong=$_POST['soLuong'];
            $sl=$soLuong+1;
            if($sl<1){
                $result=$this->nhapHangModel->xoaDong($idSanPham,$idUser);
                if($result){
                    echo '<script>window.location.href = "/web2/VIEWS/ADMIN/admin_home.php?page=quanLyNhapHang&&luachon=giohang";</script>';
                }
            }
            else{
                $result=$this->nhapHangModel->capNhatSoLuong($idSanPham,$idUser,$sl);
                if($result){
                    echo '<script>window.location.href = "/web2/VIEWS/ADMIN/admin_home.php?page=quanLyNhapHang&&luachon=giohang";</script>';
                }
            }
        }
        else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['minus'])){   
            $idSanPham=$_POST['product_id'];
            $idUser=$_POST['user_id'];
            $soLuong=$_POST['soLuong'];
            $sl=$soLuong-1;
            if($sl<1){
                $result=$this->nhapHangModel->xoaDong($idSanPham,$idUser);
                if($result){
                    echo '<script>window.location.href = "/web2/VIEWS/ADMIN/admin_home.php?page=quanLyNhapHang&&luachon=giohang";</script>';
                }
            }
            else{
                $result=$this->nhapHangModel->capNhatSoLuong($idSanPham,$idUser,$sl);
                if($result){
                    echo '<script>window.location.href = "/web2/VIEWS/ADMIN/admin_home.php?page=quanLyNhapHang&&luachon=giohang";</script>';
                }
            }
        }
        
    }
    public function xoaDong(){
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove'])){
            $idSanPham=$_POST['product_id'];
            $idUser=$_POST['user_id'];
            $result=$this->nhapHangModel->xoaDong($idSanPham,$idUser);
            if($result){
                echo '<script>window.location.href = "/web2/VIEWS/ADMIN/admin_home.php?page=quanLyNhapHang&&luachon=giohang";</script>';
            }
        }
    }
    public function layDsGioHangNhap(){
        return $this->nhapHangModel->layDsGioHangNhap();
    }
    public function countGioHangNhap($idUser){
        return $this->nhapHangModel->countGioHangNhap($idUser);
    }
    //END 1.

    
}
$nhapHangController= new NhapHangController();
$nhapHangController->themGioHangNhap();
$nhapHangController->xoaDong();
$nhapHangController->capNhatSoLuong();
?>