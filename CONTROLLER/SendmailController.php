<?php
require_once __DIR__ . '/../MODEL/SendmailModel.php';

class SendmailController {
    public function sendConfirmationEmail($email) {
        // Bắt đầu hoặc tiếp tục phiên session
        session_start();

        // Tạo mã xác nhận ngẫu nhiên có 6 chữ số
        $confirmationCode = $this->generateRandomCode();
        $SenmailModel = new SendmailModel();
        if ($SenmailModel->sendConfirmationEmail($email, $confirmationCode)) {
            // Lưu mã xác nhận vào session
            $_SESSION['confirmation_code'] = $confirmationCode;
            $_SESSION['email']=$email;
            return true;
        } else {
            return false;
        }
    }

    // Hàm để tạo mã xác nhận ngẫu nhiên có 6 chữ số
    private static function generateRandomCode() {
        // Tạo một số ngẫu nhiên từ 100000 đến 999999
        return mt_rand(100000, 999999);
    }
}
?>
