
<?php
$action = isset($_POST['action']) ? $_POST['action'] : null;

switch ($action) {
    case 'CheckEmail':
        require_once __DIR__.'\..\..\CONTROLLER\ForgotPasswordController.php';
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $ForgotPasswordController = new ForgotPasswordController();
        if($ForgotPasswordController->checkEmailExistence($email)){
            echo json_encode(true);
        } 
        else {
            echo json_encode(false);
        }
        break;
    case 'sendConfirmationEmail':
        require_once __DIR__.'\..\..\CONTROLLER\SendmailController.php';
        // require_once __DIR__ . '/../CONTROLLER/SendmailController.php';
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $SendmailController = new SendmailController();
        if ($SendmailController->sendConfirmationEmail($email)) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
        break;
    case 'ChangePassword':
        require_once __DIR__.'\..\..\CONTROLLER\ForgotPasswordController.php';
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $newPassword = isset($_POST['new_password']) ? $_POST['new_password'] : null;
        $ForgotPasswordController = new ForgotPasswordController();
        if ($ForgotPasswordController->changePassword($email, $newPassword)) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
        break;
    default:
        break;
}
?>