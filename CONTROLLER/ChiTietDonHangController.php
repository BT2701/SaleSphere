<?php
// Kiểm tra xem action đã được gửi hay chưa
//khi chạy đồ án thêm postid khách hàng để load lịch sử đơn hàng nhé
if(isset($_POST['action'])) {
    $action = $_POST['action'];


    switch($action) {
        case 'laychitietdonhang':
            $page = $_POST['page']; // Thay đổi page tùy theo nhu cầu
            $CustomerID=$_POST['CustomerID'];
            $limit = $_POST['limit'];//số sản phẩm
            $IDDonHang = $_POST['IdDonHang'];//ID don hang
            // Gọi phương thức để xử lý action 'getOrderHistory'
            $ChiTietDonHangController = new ChiTietDonHangController();
            $result = $ChiTietDonHangController->LayChiTietDonHang($CustomerID,$page,$limit,$IDDonHang);
            // Trả về dữ liệu dạng JSON
            echo json_encode($result);
            break;
        case 'checkEvaluate':
            $idKhachHang = $_POST['idKhachHang'];
            $idHoaDon = $_POST['idDonHang'];
            $idSanPham = $_POST['idSanPham'];
            // Gọi phương thức để kiểm tra xem có dữ liệu thỏa mãn không
            $ChiTietDonHangController = new ChiTietDonHangController();
            $result = $ChiTietDonHangController->CheckEvaluate($idKhachHang, $idHoaDon, $idSanPham);
            // Trả về kết quả dưới dạng JSON
            echo json_encode($result);
            break;
        
        // Xử lý các action khác ở đây
    }
}

class ChiTietDonHangController {
    // Function để lấy lịch sử đơn hàng
    public function LayChiTietDonHang($CustomerID,$page,$limit,$IDDonHang) {
        // Gọi hàm từ Model để lấy lịch sử đơn hàng
        require_once __DIR__.'\..\MODEL\ChiTietDonHangModel.php';
        $ChiTietDonHangModel = new ChiTietDonHangModel();
        // Tính toán offset
        $offset = ($page - 1) * $limit;

        // Gọi hàm từ Model để lấy lịch sử đơn hàng
        $result = $ChiTietDonHangModel->LayChiTietDonHang($CustomerID, $offset, $limit,$IDDonHang);        
        // Trả về mảng dữ liệu đơn hàng
        return $result;
    }
    public function CheckEvaluate($idKhachHang,$idHoaDon,$idSanPham){
        require_once __DIR__.'\..\MODEL\ChiTietDonHangModel.php';
        $ChiTietDonHangModel = new ChiTietDonHangModel();
        return  $ChiTietDonHangModel->CheckEvaluate($idKhachHang,$idHoaDon,$idSanPham);        
      }
}
?>
