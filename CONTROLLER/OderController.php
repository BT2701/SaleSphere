<?php
// Kiểm tra xem action đã được gửi hay chưa
//khi chạy đồ án thêm postid khách hàng để load lịch sử đơn hàng nhé
if(isset($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
        case 'getOrderHistory':
            $page = $_POST['page']; // Thay đổi page tùy theo nhu cầu
            $CustomerID=$_POST['CustomerID'];
            $limit = $_POST['limit'];//số sản phẩm
            // Gọi phương thức để xử lý action 'getOrderHistory'
            $orderController = new OrderController();
            $orders = $orderController->getOrderHistory($CustomerID,$page,$limit);
            // Trả về dữ liệu dạng JSON
            echo json_encode($orders);
            break;
        case 'daNhanDuocHang':
            $idhoadon = $_POST['idhoadon'];//số sản phẩm
            // Gọi phương thức để xử lý action 'getOrderHistory'
            $orderController = new OrderController();
            $orders = $orderController->daNhanDuocHang($idhoadon);
            // Trả về dữ liệu dạng JSON
            echo json_encode($orders);
            break;
        // Xử lý các action khác ở đây
    }
}

class OrderController {
    // Function để lấy lịch sử đơn hàng
    public function getOrderHistory($CustomerID,$page,$limit) {
        // Gọi hàm từ Model để lấy lịch sử đơn hàng
        require_once __DIR__.'\..\MODEL\OrderModel.php';
        $orderModel = new OrderModel();
        // Tính toán offset
        $offset = ($page - 1) * $limit;

        // Gọi hàm từ Model để lấy lịch sử đơn hàng
        $orders = $orderModel->getOrderHistory($CustomerID, $offset, $limit);        
        // Trả về mảng dữ liệu đơn hàng
        return $orders;
    }
    public function daNhanDuocHang($idhoadon) {
        // Gọi hàm từ Model để lấy lịch sử đơn hàng
        require_once __DIR__.'\..\MODEL\OrderModel.php';
        $orderModel = new OrderModel();
        // Gọi hàm từ Model để lấy lịch sử đơn hàng
        $orders = $orderModel->daNhanDuocHang($idhoadon);        
        // Trả về mảng dữ liệu đơn hàng
        return $orders;
    }
}
?>
