<?php
    require_once 'C:\xampp\htdocs\web2\MODEL\SignUpModel.php';
    $signupModel = new SignUpModel();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username= $_POST["Username"];
        $password =$_POST["Password"];
        $cpassword=$_POST["cPassword"];
    }
    $signupModel->registerTaikhoan($username,$password);
    header('Location: /web2/index.php');
          