<?php
    require_once __DIR__.'\..\MODEL\SignUpModel.php';
    $signupModel = new SignUpModel();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username= $_POST["Username"];
        $password =$_POST["Password"];
        $cpassword=$_POST["cPassword"];
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $signupModel->registerTaikhoan($username,$hashedPassword);
    header('Location: /web2/VIEWS/login/login.php');
          