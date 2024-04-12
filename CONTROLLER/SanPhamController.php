<?php
    
class SanPhamController {
    public $sanphamModel;
    private $soLuongSanPham;
    public function __construct() {
        require_once 'C:\xampp\htdocs\web2\MODEL\SanPhamModel.php';
        $this->sanphamModel = new SanPhamModel();
    }

    public function setSoLuongSP($soLuong){
        $this->soLuongSanPham =$soLuong;
    }
    public function getSoLuongSP(){
        return $this->soLuongSanPham;
    }

    public function getDataForView() {
        $this->setSoLuongSP($this->sanphamModel->laySoLuongSanPham());
        return $this->sanphamModel->getSanPhamList(0,10);
    }
    public function phanTrangMainList(){
        if(isset($_GET['start'])){
            $start = $_GET['start'] ?? 0; // Vị trí bắt đầu của trang
            $limit = $_GET['limit'] ?? 10; // Số lượng sản phẩm trên mỗi trang
            $sanPhamList=$this->sanphamModel->getSanPhamList($start,$limit);
            echo json_encode($sanPhamList);
        }
    }
    public function getDataForViewNoiBac() {
        return $this->sanphamModel->getListSPNoiBac();
    }
    public function getDataForViewKhuyenMai() {
        return $this->sanphamModel->getListSPKhuyenMai();
    }
    public function getDsSPtheoLoai() {
        $start = $_GET['start'] ?? 0; // Vị trí bắt đầu của trang
        $limit = $_GET['limit'] ?? 10; // Số lượng sản phẩm trên mỗi trang
        if (isset($_GET['action']) && $_GET['action'] == 'getDsSPtheoLoai' && isset($_GET['category'])) {
            $category = $_GET['category'];
            $list=$this->getDataForView();

            if($category!='Tất cả sản phẩm'){
                $this->setSoLuongSP($this->sanphamModel->laySoLuongSanPhamTheoLoai($category));
                $list = $this->sanphamModel->getDsSPtheoLoai($category, $start, $limit);
            }
            // Trả về dữ liệu dưới dạng JSON
            echo json_encode($list);
        }
    }
    public function getDsSPtheoTen() {
        $start = $_GET['start'] ?? 0; // Vị trí bắt đầu của trang
        $limit = $_GET['limit'] ?? 10; // Số lượng sản phẩm trên mỗi trang
        if (isset($_GET['action']) && $_GET['action'] == 'getDsSPtheoTen' && isset($_GET['name'])) {
            $name = $_GET['name'];
            $list=$this->getDataForView();
            if($name!=""){
                $this->setSoLuongSP($this->sanphamModel->laySoLuongSanPhamTheoTen($name));
                $list = $this->sanphamModel->getDsSPtheoTen($name, $start, $limit);
            }
            // Trả về dữ liệu dưới dạng JSON
            echo json_encode($list);
        }
    }

    public function getDsSPtheoKhoangGia() {
        $start = $_GET['start'] ?? 0; // Vị trí bắt đầu của trang
        $limit = $_GET['limit'] ?? 10; // Số lượng sản phẩm trên mỗi trang
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
                $this->setSoLuongSP($this->sanphamModel->laySoLuongSanPhamTheoKhoangGia($from,$to));
                $list = $this->sanphamModel->getDsSPtheoKhoangGia($from,$to, $start, $limit);
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
$controller->phanTrangMainList();

?>