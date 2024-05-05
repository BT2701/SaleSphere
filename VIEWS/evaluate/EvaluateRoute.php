<?php 

require_once __DIR__.'\..\..\CONTROLLER\evaluateController.php';

$action = isset($_POST['act']) ? $_POST['act'] : '';
echo "vaooo";
switch ($action) {
    case 'AddEvalute':
        // Kiểm tra xem action có phải là AddEvalute không
            // Nếu là phương thức POST, thực hiện gọi hàm AddEvalute từ evaluateController
            $reviewText = $_POST["txtreviewText"];
            $Star = $_POST["txtselectedStar"];
            $idSanPham = $_POST["txtidSanPham"];
            $idKhachHang = $_POST["txtidKhachHang"];
            $idHoaDon = $_POST["txtidHoaDon"];
            $currentDate = date('Y-m-d');

            $evaluateController = new evaluateController();
            $evaluateController->AddEvalute($idSanPham, $reviewText, $Star,$idKhachHang,$idHoaDon);
        break;


    // Các route khác có thể được xác định ở đây nếu cần


    default:
        // Xử lý các yêu cầu không xác định hoặc mặc định
        exit();
}



?>