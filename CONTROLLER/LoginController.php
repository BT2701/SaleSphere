<?php
//khi chạy đồ án thêm postid khách hàng để load lịch sử đơn hàng nhé
if(isset($_POST['action'])) {
    $action = $_POST['action'];

    switch($action) {
        case 'Login':
            $user = $_POST['username'];
            $Password=$_POST['password'];
            $LoginController = new LoginController();
            $result = $LoginController->checkLogin($user, $Password);
            echo json_encode($result);
            break;
        // Xử lý các action khác ở đây
    }
}

class LoginController {
    public function checkLogin($user, $Password) {
        require_once __DIR__.'\..\MODEL\LoginModel.php';
        $LoginModel = new LoginModel();
        $result = $LoginModel->checkLogin($user, $Password);      
        if($result!=false){
            session_start(); // Bắt đầu session
            $_SESSION['idusers'] = $result['id'];; // Thay $userId bằng ID thực tế của người dùng
        }
        return $result;
    }
    
}
?>
