<?php 
session_start(); // Bắt đầu session

// Kiểm tra xem action được gửi từ yêu cầu Ajax
if(isset($_POST['action'])) {
    $action = $_POST['action'];

    switch($action) {
        case 'validateSession':
            validateSession();
            break;
        case 'deleteSession':
            deleteSession();
            break;
        // Thêm các case khác nếu cần
        default:
            echo json_encode(false); // Nếu action không hợp lệ, trả về false
            break;
    }
} else {
    echo json_encode(false); // Nếu không có action được gửi, trả về false
}

// Hàm để kiểm tra session
function validateSession() {
    // Kiểm tra xem session đã được khởi tạo chưa
    if (!isset($_SESSION['email']) || !isset($_SESSION['confirmation_code'])) {
        echo json_encode(false); // Session chưa được thiết lập, trả về false
        exit; // Dừng việc thực thi mã PHP tiếp theo
    }

    // Lấy giá trị email và mã xác nhận từ yêu cầu Ajax
    $email = $_POST['email'];
    $confirmationCode = intval($_POST['confirmation_code']);

    // Lấy giá trị từ session
    $sessionEmail = $_SESSION['email'];
    $sessionConfirmationCode = intval($_SESSION['confirmation_code']);

    // Kiểm tra xem email và mã xác nhận có khớp với giá trị trong session không
    if ($email === $sessionEmail && $confirmationCode === $sessionConfirmationCode) {
        // Nếu khớp, trả về 'true'
        echo json_encode(true);
    } else {
        // Nếu không khớp, trả về 'false'
        echo json_encode(false);
    }
}

// Hàm để xóa session
function deleteSession() {
    // Xóa toàn bộ session
    session_unset();
    session_destroy();
    echo json_encode(true); // Trả về 'true' khi xóa session thành công
}
?>
