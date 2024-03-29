<?php
    require_once 'C:\xampp\htdocs\web2\MODEL\SignUpModel.php';
    $signupModel = new SignUpModel();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username= $_POST["Username"];
        $password =$_POST["Password"];
        $cpassword=$_POST["cPassword"];
    }
    if($signupModel->isUsernameTaken($username)==0){
        if($password == $cpassword){
            $signupModel->registerUser($username,$password);
            {
                header('Location: /web2/index.php');
            }
        }else{
            echo 'Mật khẩu không trùng khớp';
        }
    }else
    {
        echo 'tài khoản đã tồn tại';
    }