<?php



class evaluateController {
    public function getInstance(){
        require_once __DIR__.'\..\MODEL\evaluateModel.php';
    }
    public function GetSanPhamDanhGia($idProduct) {
        $this->getInstance();
        $evaluateModel = new evaluateModel();
        return $evaluateModel->GetSanPhamDanhGia($idProduct);
    }
    public function AddEvalute($id, $reviewText, $Star,$idKhachHang,$idHoaDon) {
        $this->getInstance();
        $evaluateModel = new evaluateModel();
        // Kiểm tra xem form đã được gửi đi chưa
        echo "gettype($id)";
        echo "gettype($reviewText)";
        echo "gettype($Star)";
        echo "gettype($idKhachHang)";
        echo "gettype($idHoaDon)";
            $Ketqua=$evaluateModel->AddEvalute(intval($id), $reviewText,intval($Star),$idKhachHang,$idHoaDon);
            if ($Ketqua) {
                echo '<script>alert("Đánh giá thành công!");</script>';
                // Nếu thêm đánh giá thành công, chuyển hướng tới trang lichsudonhang.php
                // Sau khi thêm đánh giá thành công
                echo '<form id="redirectForm" action="../History/ChiTietDonHang.php" method="POST">';
                echo '<input type="hidden" name="idkhachhang" value="' . $idKhachHang . '">';
                echo '<input type="hidden" name="iddonhang" value="' . $idHoaDon . '">';
                echo '<input type="hidden" name="trangthai" value="3">';
                echo '</form>';
                echo '<script>document.getElementById("redirectForm").submit();</script>';
                exit(); // Kết thúc kịch bản để ngăn việc thực hiện các mã khác
            } else {
                // Xử lý trường hợp thêm đánh giá không thành công
                // Ví dụ: hiển thị thông báo lỗi
                echo "Thêm đánh giá không thành công!";
            }
        
    }
}
?>