<?php
    
class SanPhamController {
    public $sanphamModel;
    public function __construct() {
        require_once 'C:\xampp\htdocs\web2\MODEL\SanPhamModel.php';
        $this->sanphamModel = new SanPhamModel();
    }

    public function getDataForView() {
        return $this->sanphamModel->getSanPhamList();
    }
    public function getDataForViewNoiBac() {
        return $this->sanphamModel->getListSPNoiBac();
    }
    public function getDataForViewKhuyenMai() {
        return $this->sanphamModel->getListSPKhuyenMai();
    }
    public function getDsSPtheoLoai() {
        if (isset($_GET['action']) && $_GET['action'] == 'getDsSPtheoLoai' && isset($_GET['category'])) {
            $category = $_GET['category'];
            $list = $this->sanphamModel->getDsSPtheoLoai($category);
            // Trả về dữ liệu dưới dạng JSON
            echo json_encode($list);
        }
    }
}
$controller = new SanPhamController();
$controller->getDsSPtheoLoai();
?>