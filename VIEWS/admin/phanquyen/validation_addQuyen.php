<?php
    require 'C:\xampp\htdocs\web2\MODEL\Database.php';
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $username= $_POST['username'];
        
        $errors = array();
        if(empty($username)){
            $errors['username']='Tên quyền không được để trống!';
        }
        $sql= "SELECT tenQuyen  from quyen WHERE tenQuyen='$username'";
        $db= new Database();
        $conn= $db->getConnection();
        $result=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($result);
        if($num>0){
            $errors['username1']='Tên quyền đã tồn tại. VUI LÒNG ĐỔI TÊN!';
        }

        if(empty($errors)){
            $response = array(
                'success' => true
            );
        }else{
            $response = array(
                'success' => false,
                'errors' => $errors
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
?>