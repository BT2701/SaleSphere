<?php
class ForgotPasswordController {
    public function checkEmailExistence($email) {
        require_once __DIR__.'\..\MODEL\ForgotPasswordModel.php';
        // require_once __DIR__ . '/../MODEL/ForgotPasswordModel.php';
        $ForgotPasswordModel = new ForgotPasswordModel();

        if ($ForgotPasswordModel->checkEmailExistence($email)) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword($email, $newPassword) {
        require_once __DIR__.'\..\MODEL\ForgotPasswordModel.php';
        $ForgotPasswordModel = new ForgotPasswordModel();
    
        if ($ForgotPasswordModel->changePassword($email, $newPassword)) {
            return true;
        } else {
            return false;
        }
    }
}
?>

