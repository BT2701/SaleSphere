<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

class SendmailModel {
    public static function sendConfirmationEmail($email, $confirmationCode) {
        $userEmail = 'web2sgu@gmail.com';
        $appPassword = 'azja wkfe qjgc dhmf'; // Thay thế 'your_app_password' bằng mật khẩu ứng dụng mới bạn đã tạo

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Thay đổi nếu sử dụng dịch vụ email khác
            $mail->SMTPAuth = true;
            $mail->Username = $userEmail;
            $mail->Password = $appPassword; // Sử dụng mật khẩu ứng dụng thay vì mật khẩu tài khoản chính thức
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom($userEmail, 'SGU WEB 2');
            $mail->addAddress($email);

            $mail->Subject = 'SGU WEB 2 MA XAC NHAN';
            $mail->Body = 'Mã xác nhận của bạn là: ' . $confirmationCode;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
        return false;
    }

}
?>
