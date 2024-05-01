<?php
class NhapHangController{
    public $nhapHangModel;
    public function __construct() {
        require_once 'C:\xampp\htdocs\web2\MODEL\NhapHangModel.php';
        $this->nhapHangModel = new NhapHangModel();
    }
    public function themGioHangNhap(){
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['themgiohangnhap'])){
            $idSanPham=$_POST['product_id'];
            $idUser=1;  //ĐẶT TẠM GIÁ TRỊ CỦA USER HỆ THỐNG
            $soLuong=1; // mỗi lần nhất nút dấu cộng chỉ cộng 1 đơn vị
            $result=$this->nhapHangModel->themGioHangNhap($idSanPham, $idUser, $soLuong);
            if($result){
                echo '<script>window.location.href = "/web2/VIEWS/ADMIN/admin_home.php?page=quanLyNhapHang";</script>';
            }  
        }
    }
    public function layDsGioHangNhap(){
        return $this->nhapHangModel->layDsGioHangNhap();
    }
    public function countGioHangNhap(){
        return $this->nhapHangModel->countGioHangNhap();
    }
}
$nhapHangController= new NhapHangController();
$nhapHangController->themGioHangNhap();
?>