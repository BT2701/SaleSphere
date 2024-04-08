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
            $list=$this->getDataForView();
            if($category!='Tất cả sản phẩm'){
                $list = $this->sanphamModel->getDsSPtheoLoai($category);
            }
            // Trả về dữ liệu dưới dạng JSON
            echo json_encode($list);
        }
    }
    public function getDsSPtheoTen() {
        if (isset($_GET['action']) && $_GET['action'] == 'getDsSPtheoTen' && isset($_GET['name'])) {
            $name = $_GET['name'];
            $list=$this->getDataForView();
            if($name!=""){
                $list = $this->sanphamModel->getDsSPtheoTen($name);
            }
            // Trả về dữ liệu dưới dạng JSON
            echo json_encode($list);
        }
    }

    public function getDsSPtheoKhoangGia() {
        if (isset($_GET['action']) && $_GET['action'] == 'getDsSPtheoKhoangGia' && isset($_GET['khoangGia'])) {
            $khoangGia= $_GET['khoangGia'];
            $list=$this->getDataForView();
            if($khoangGia!='Tất cả mệnh giá'){
                // Sử dụng preg_match_all để tìm tất cả các số nguyên trong chuỗi
                preg_match_all('/\d+/', $khoangGia, $matches);

                // Lấy mảng chứa các số nguyên từ kết quả
                $numbers = $matches[0];
                $from = $numbers[0]; // Số đầu tiên
                $to = $numbers[1]; // Số thứ hai
                
                $list = $this->sanphamModel->getDsSPtheoKhoangGia($from,$to);
            }
            // Trả về dữ liệu dưới dạng JSON
            echo json_encode($list);
        }
    }

}
$controller = new SanPhamController();
$controller->getDsSPtheoLoai();
$controller->getDsSPtheoTen();
$controller->getDsSPtheoKhoangGia();
?>