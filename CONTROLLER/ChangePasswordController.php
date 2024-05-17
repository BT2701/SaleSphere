<?php
    require_once __DIR__.'\..\MODEL\ProfileModel.php';
    $profileModel = new ProfileModel();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id1=$_POST['IdProfile'];
        $passhientai=$_POST['Oldpass'];
        $passmoi=$_POST['Newpass'];
        $cpassmoi=$_POST['cNewpass'];
    }
    $hashedPassword = password_hash($passmoi, PASSWORD_DEFAULT);
    $profileModel->change_password($id1,$hashedPassword);
    header('Location: /SaleSphere/VIEWS/profile/change_password.php');
?>