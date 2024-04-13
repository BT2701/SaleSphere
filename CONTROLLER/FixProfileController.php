<?php
     require_once 'C:\xampp\htdocs\web2\MODEL\ProfileModel.php';
     $profileModel = new ProfileModel();
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id1= $_POST['IdProfile'];
        $username1= $_POST["username"];
        if($_POST['email']=="Chưa cập nhật")
        {
            $email1='0';
        }
        else{
            $email1 =$_POST["email"];
        }
        if($_POST['phone_number']=="Chưa cập nhật")
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
        else
            $gender1='Nữ';
        if(empty($_POST['dob']))
        {
            $dob1=date("d/m/Y");
        }
        else
        {
            $dob1=$_POST["dob"];
        }
        if($_POST['diachi']=="Chưa cập nhật")
        {
            $diachi1='0';
        }
        else{
            $diachi1=$_POST["diachi"];
        }
        $src1=$_POST['imageURL'];
    }
    $profileModel->EditProfile($id1,$username1,$email1,$sdt1,$gender1,$dob1,$diachi1);
    //$profileModel->EditImage($id1,$src1);
    $_SESSION['login_name'] = $username1; 
    header('Location: /web2/VIEWS/profile/profile.php');
?>