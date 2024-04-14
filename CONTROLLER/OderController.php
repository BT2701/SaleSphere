<?php
// Kiểm tra xem action đã được gửi hay chưa
//khi chạy đồ án thêm postid khách hàng để load lịch sử đơn hàng nhé
if(isset($_POST['action'])) {
    $action = $_POST['action'];
    $page = $_POST['page']; // Thay đổi page tùy theo nhu cầu
    $CustomerID=$_POST['CustomerID'];
    $limit = $_POST['limit'];//số sản phẩm
    switch($action) {
        case 'getOrderHistory':
            // Gọi phương thức để xử lý action 'getOrderHistory'
            $orderController = new OrderController();
            $orders = $orderController->getOrderHistory($CustomerID,$page,$limit);
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
        require_once 'C:\xampp\htdocs\web2\MODEL\OrderModel.php';
        $orderModel = new OrderModel();
        // Tính toán offset
        $offset = ($page - 1) * $limit;

        // Gọi hàm từ Model để lấy lịch sử đơn hàng
        $orders = $orderModel->getOrderHistory($CustomerID, $offset, $limit);        
        // Trả về mảng dữ liệu đơn hàng
        return $orders;
    }
}
?>
