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
    public function insertProduct(){
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
            // Kiểm tra xem có dữ liệu không
            if(isset($_POST['productName']) && isset($_POST['productPrice']) && isset($_POST['productType']) && isset($_POST['productUnit']) && isset($_POST['productDescription'])) {
                $productName = $_POST['productName'];
                $productRoot=$_POST['productRoot'];
                $productPrice = $_POST['productPrice'];
                $productType = $_POST['productType'];
                $type= trim(explode("-", $productType)[0]);
                $productUnit = $_POST['productUnit'];
                $unit=trim(explode("-", $productUnit)[0]);
                $productDescription = $_POST['productDescription'];
                // $src="/web2/STATIC/assets/product3.png";
                // Xử lý upload ảnh nếu cần
                // Đường dẫn đến thư mục lưu ảnh
                $targetDir = "../STATIC/assets/";
                $targetFile = $targetDir . basename($_FILES["productImage"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

                // Kiểm tra xem tệp ảnh có tồn tại không
                if(isset($_FILES["productImage"])) {
                    $check = getimagesize($_FILES["productImage"]["tmp_name"]);
                    if($check !== false) {
                        $uploadOk = 1;
                    } else {
                        echo "File không phải là ảnh.";
                        $uploadOk = 0;
                    }
                }

                // Kiểm tra xem tệp ảnh đã tồn tại chưa
                if (file_exists($targetFile)) {
                    echo "Tệp ảnh đã tồn tại.";
                    $uploadOk = 0;
                }

                // Kiểm tra kích thước ảnh
                if ($_FILES["productImage"]["size"] > 5000000) {
                    echo "Tệp ảnh quá lớn.";
                    $uploadOk = 0;
                }

                // Cho phép các định dạng ảnh nhất định
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    echo "Chỉ cho phép tải lên các tệp JPG, JPEG, PNG & GIF.";
                    $uploadOk = 0;
                }

                // Kiểm tra nếu $uploadOk không bằng 0, thực hiện lưu tệp
                if ($uploadOk == 0) {
                    echo "Tệp của bạn không được tải lên.";
                } else {
                    if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
                        echo "Tệp ". basename( $_FILES["productImage"]["name"]). " đã được tải lên thành công.";
                    } else {
                        echo "Đã xảy ra lỗi khi tải tệp lên.";
                    }
                }
                $src=str_replace("../", "/web2/", $targetFile);
                $this->sanphamModel->insertProduct($productName,$productRoot,$productPrice,$productType, $productUnit, $productDescription, $src);
            }else {
                echo "Dữ liệu không hợp lệ.";
            }
        }
    }
    public function loadEditInfor(){
        if(isset($_GET['product_id'])){
            $id=$_GET['product_id'];
            return $this->sanphamModel->getProductDetail($id);
        }   
    }
    public function updateProduct(){
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
            // Kiểm tra xem có dữ liệu không
            if(isset($_POST['productName']) && isset($_POST['productPrice']) && isset($_POST['productType']) && isset($_POST['productUnit']) && isset($_POST['productDescription'])) {
                $id=$_POST['productId'];
                $productName = $_POST['productName'];
                $productRoot=$_POST['productRoot'];
                $productPrice = $_POST['productPrice'];
                $productType = $_POST['productType'];
                $type= trim(explode("-", $productType)[0]);
                $productUnit = $_POST['productUnit'];
                $unit=trim(explode("-", $productUnit)[0]);
                $productDescription = $_POST['productDescription'];
                // $src="/web2/STATIC/assets/product3.png";
                // Xử lý upload ảnh nếu cần
                // Đường dẫn đến thư mục lưu ảnh
                $targetDir = "../../STATIC/assets/";
                $targetFile = $targetDir . basename($_FILES["productImage"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
                
                // Kiểm tra xem tệp ảnh có tồn tại không
                if(isset($_FILES["productImage"])) {
                    $check = getimagesize($_FILES["productImage"]["tmp_name"]);
                    if($check !== false) {
                        $uploadOk = 1;
                    } else {
                        echo "File không phải là ảnh.";
                        $uploadOk = 0;
                    }
                }

                // Kiểm tra xem tệp ảnh đã tồn tại chưa
                if (file_exists($targetFile)) {
                    echo "Tệp ảnh đã tồn tại.";
                    $uploadOk = 0;
                }

                // Kiểm tra kích thước ảnh
                if ($_FILES["productImage"]["size"] > 5000000) {
                    echo "Tệp ảnh quá lớn.";
                    $uploadOk = 0;
                }

                // Cho phép các định dạng ảnh nhất định
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    echo "Chỉ cho phép tải lên các tệp JPG, JPEG, PNG & GIF.";
                    $uploadOk = 0;
                }

                // Kiểm tra nếu $uploadOk không bằng 0, thực hiện lưu tệp
                if ($uploadOk == 0) {
                    echo "Tệp của bạn không được tải lên.";
                } else {
                    if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
                        echo "Tệp ". basename( $_FILES["productImage"]["name"]). " đã được tải lên thành công.";
                    } else {
                        echo "Đã xảy ra lỗi khi tải tệp lên.";
                    }
                }
                $src=str_replace("../../", "/web2/", $targetFile);

                $result=$this->sanphamModel->updateProduct($id,$productName,$productRoot,$productPrice,$productType, $productUnit, $productDescription, $src);
                if ($result) {
                    echo '<script>window.location.href = "/web2/VIEWS/ADMIN/admin_home.php?page=quanLySanPham";</script>';
                    exit; // Đảm bảo dừng kịch bản sau khi chuyển hướng
                }
            }else {
                echo "Dữ liệu không hợp lệ.";
            }
        }
    }
    
    public function deleteProduct(){
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
            if(isset($_POST['product_id'])) {
                $productId = $_POST['product_id'];
                $this->sanphamModel->deleteProduct($productId);
            } else {
                echo "Không có ID sản phẩm được gửi đi!";
            }
        }
    }
    public function getList($limit){
        return $this->sanphamModel->getSanPhamList(0,$limit);
    }
    public function phanTrangMainList(){
        if(isset($_GET['action'])&&$_GET['action']==''){
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
        if (isset($_GET['action']) && $_GET['action'] == 'getDsSPtheoLoai' && isset($_GET['value'])) {
            $category = $_GET['value'];
            $list=$this->sanphamModel->getSanPhamList($start,$limit);

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
        if (isset($_GET['action']) && $_GET['action'] == 'getDsSPtheoTen' && isset($_GET['value'])) {
            $name = $_GET['value'];
            $list=$this->sanphamModel->getSanPhamList($start,$limit);
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
        if (isset($_GET['action']) && $_GET['action'] == 'getDsSPtheoKhoangGia' && isset($_GET['value'])) {
            $khoangGia= $_GET['value'];
            $list=$this->sanphamModel->getSanPhamList($start,$limit);
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
    // ---------------------DU---------------------
    //LẤY CHI TIẾT SẢN PHẨM
    public function detailProduct($productID) {
        $sanphamModel = new SanPhamModel();
        return $sanphamModel->getProductDetail($productID);
    }

    //LẤY SỐ LƯỢNG SẢN PHẨM CÒN TRONG KHO
    // public function quantityProduct($productID){
    //     $this->getInstance();
    //     $sanPhamModel = new SanPhamModel();
    //     $soLuongNhap = $sanPhamModel->getQuantityProductImported($productID);
    //     $soLuongDaBan = $sanPhamModel->getQuantityOfProductsSold($productID);
    //     return $soLuongNhap['soLuongNhap']-$soLuongDaBan['soLuongDaBan'];
    // }

    public function quantityProduct($productID){
        $sanPhamModel = new SanPhamModel();
        $soLuongTonKho = $sanPhamModel->getQuantityInventoryProduct($productID);
        if($soLuongTonKho !== null){
            return $soLuongTonKho['soLuongTonKho'];
        }
        return 0;
    }

    //LẤY SỐ LƯỢNG SẢN PHẨM ĐÃ ĐƯỢC BÁN
    public function quantityOfProductsSold($productID){
        $sanPhamModel = new SanPhamModel();
        $soLuongDaBan = $sanPhamModel->getQuantityOfProductsSold($productID);
        if($soLuongDaBan['soLuongDaBan'] == null){
            return 0;
        }
        return $soLuongDaBan['soLuongDaBan'];
    }

    //LẤY TỔNG SỐ LƯỢNG SAO SẢN PHẨM ĐƯỢC ĐÁNH GIÁ 
    public function avgOfStarEvaluate($productID){
        $sanPhamModel = new SanPhamModel();
        $soLuongSao = $sanPhamModel->getAvgOfStarEvaluate($productID);
        return $soLuongSao['tongSoSao'];
    }

    //LẤY SỐ LƯỢNG ĐÁNH GIÁ SẢN PHẨM 
    // public function countOfEvaluate($productID){
    //     $this->getInstance();
    //     $sanPhamModel = new SanPhamModel();
    //     $soLuongDanhGia = $sanPhamModel->getCountOfEvaluate($productID);
    //     return $soLuongDanhGia['tongSoLuongDanhGia'];
    // }
    public function countOfEvaluate($productID,$soSao){
        $sanPhamModel = new SanPhamModel();
        $soLuongDanhGia = $sanPhamModel->getCountOfEvaluate($productID,$soSao);
        return $soLuongDanhGia;
    }

    //LẤY THÔNG TIN KHUYẾN MÃI
    public function sumOfValueDiscount($productID){
        $sanPhamModel = new SanPhamModel();
        $giaTriKhuyenMai = $sanPhamModel->getInfoDiscount($productID);
        return $giaTriKhuyenMai;
    }
    public function GetAllProduct(){
        $sanPhamModel = new SanPhamModel();
        $Products = $sanPhamModel->GetALlProduct();
        return $Products;
    }
    // ---------------------DU---------------------

}
$controller = new SanPhamController();
$controller->getDsSPtheoLoai();
$controller->getDsSPtheoTen();
$controller->getDsSPtheoKhoangGia();
$controller->phanTrangMainList();
$controller->insertProduct();
$controller->deleteProduct();
$controller->updateProduct();
// $controller->loadInformationById();
?>