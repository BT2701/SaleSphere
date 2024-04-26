<?php
    require_once 'C:\xampp\htdocs\web2\MODEL\ProfileModel.php';
    $profileModel = new ProfileModel();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id1=$_POST['IdProfile'];
        $passhientai=$_POST['Oldpass'];
        $passmoi=$_POST['Newpass'];
        $cpassmoi=$_POST['cNewpass'];
    }
    $hashedPassword = password_hash($passmoi, PASSWORD_DEFAULT);
    $profileModel->change_password($id1,$hashedPassword);
    header('Location: /web2/VIEWS/profile/change_password.php');
?>