<?php
// Kiểm tra xem action đã được gửi hay chưa
//khi chạy đồ án thêm postid khách hàng để load lịch sử đơn hàng nhé
if(isset($_POST['action'])) {
    $action = $_POST['action'];

    switch($action) {
        case 'GetThongTinHeader':
            $Month = $_POST['Month'];
            $Year=$_POST['Year'];
            // Gọi phương thức để xử lý action 'getOrderHistory'
            $ThongKeController = new ThongKeController();
            $result = $ThongKeController->GetThongTinHeader($Month, $Year);
            // Trả về dữ liệu dạng JSON
            echo json_encode($result);
            break;
        case 'GetDailyRevenueData':
            $Month = $_POST['Month'];
            $Year=$_POST['Year'];
            $ThongKeController = new ThongKeController();
            $result = $ThongKeController->GetDailyRevenueData($Month, $Year);
            echo json_encode($result);
            break;
        case 'GetAllLoaiSanPham':
            $Month = $_POST['Month'];
            $Year=$_POST['Year'];
            $ThongKeController = new ThongKeController();
            $result = $ThongKeController->GetAllLoaiSanPham($Month, $Year);
            echo json_encode($result);
            break;

        case 'GetTopSellingProducts':
            $Month = $_POST['Month'];
            $Year=$_POST['Year'];
            $productType=$_POST['productType'];
            $ThongKeController = new ThongKeController();
            $result = $ThongKeController->GetTopSellingProducts($Month, $Year, $productType);
            echo json_encode($result);
            break;


        case 'GetThongTinHeaderByDateRange':
            $fromDate= $_POST['fromDate'];
            $toDate= $_POST['toDate'];
             // Gọi phương thức để xử lý action 'getOrderHistory'
            $ThongKeController = new ThongKeController();
            $result = $ThongKeController->GetThongTinHeaderByDateRange($fromDate, $toDate);
            // Trả về dữ liệu dạng JSON
            echo json_encode($result);
            break;
        case 'GetAllLoaiSanPhamByDateRange':
            $fromDate= $_POST['fromDate'];
            $toDate= $_POST['toDate'];
             // Gọi phương thức để xử lý action 'getOrderHistory'
            $ThongKeController = new ThongKeController();
            $result = $ThongKeController->GetAllLoaiSanPhamByDateRange($fromDate, $toDate);
            // Trả về dữ liệu dạng JSON
            echo json_encode($result);
            break;
       case 'GetTopSellingProductsByDateRange':
            $fromDate= $_POST['fromDate'];
            $toDate= $_POST['toDate'];
            $productType=$_POST['productType'];
            $ThongKeController = new ThongKeController();
            $result = $ThongKeController->GetTopSellingProductsByDateRange($fromDate, $toDate, $productType);
            echo json_encode($result);
            break;
        // Xử lý các action khác ở đây
    }
}

class ThongKeController {
    public function GetThongTinHeader($Month, $Year) {
        require_once __DIR__.'\..\MODEL\ThongKeModel.php';
        $ThongKeModel = new ThongKeModel();
        $result = $ThongKeModel->GetThongTinHeader($Month, $Year);        
        return $result;
    }
    public function GetDailyRevenueData($Month, $Year) {
        require_once __DIR__.'\..\MODEL\ThongKeModel.php';
        $ThongKeModel = new ThongKeModel();
        return $ThongKeModel->GetDailyRevenueData($Month, $Year);
    }
    public function GetAllLoaiSanPham($Month, $Year) {
        require_once __DIR__.'\..\MODEL\ThongKeModel.php';
        $ThongKeModel = new ThongKeModel();
        return $ThongKeModel->GetAllLoaiSanPham($Month, $Year);
    }
    public function GetTopSellingProducts($Month, $Year, $productType) {
        require_once __DIR__.'\..\MODEL\ThongKeModel.php';
        $ThongKeModel = new ThongKeModel();
        return $ThongKeModel->GetTopSellingProducts($Month, $Year, $productType);
    }


    public function GetThongTinHeaderByDateRange($fromDate, $toDate) {
        require_once __DIR__.'\..\MODEL\ThongKeModel.php';
        $ThongKeModel = new ThongKeModel();
        $result = $ThongKeModel->GetThongTinHeaderByDateRange($fromDate, $toDate);        
        return $result;
    }

    public function GetAllLoaiSanPhamByDateRange($fromDate, $toDate) {
        require_once __DIR__.'\..\MODEL\ThongKeModel.php';
        $ThongKeModel = new ThongKeModel();
        return $ThongKeModel->GetAllLoaiSanPhamByDateRange($fromDate, $toDate);
    }
    public function GetTopSellingProductsByDateRange($fromDate, $toDate, $productType) {
        require_once __DIR__.'\..\MODEL\ThongKeModel.php';
        $ThongKeModel = new ThongKeModel();
        return $ThongKeModel->GetTopSellingProductsByDateRange($fromDate, $toDate, $productType);
    }
}
?>
