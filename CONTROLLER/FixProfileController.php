<?php
     require_once 'C:\xampp\htdocs\web2\MODEL\ProfileModel.php';
     $profileModel = new ProfileModel();
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id1= $_POST['IdProfile'];
        $username1= $_POST["username"];
        if($_POST['email']=="")
        {
            $email1='0';
        }
        else{
            $email1 =$_POST["email"];
        }
        if($_POST['phone_number']=="")
        {
            $sdt1='0';
        }
        else{
            $sdt1=$_POST["phone_number"];
        }
        if($_POST['cbgender']=='Male')
        {
            $gender1='Nam';
        }
        else{
            $gender1='Nữ';
        }
        $dob1=$_POST['dob'];
        if($_POST['diachi']=="")
        {
            $diachi1='0';
        }
        else{
            $diachi1=$_POST["diachi"];
        }
        $src1=basename($_FILES['anh']['name']);
    }
    $profileModel->EditProfile($id1,$username1,$email1,$sdt1,$gender1,$dob1,$diachi1);
    $src2=$profileModel->getAnhByID($id1);
    $target_dir="/web2/STATIC/assets/";
    $target_file = $target_dir . $src1;
    if(empty($src1))
    $profileModel->EditImage($id1,$src2);
    else
    $profileModel->EditImage($id1,$target_file);
    header('Location: /web2/VIEWS/profile/profile.php');

?>