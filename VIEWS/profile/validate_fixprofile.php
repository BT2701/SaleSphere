<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email1=$_POST['email'];
        $sdt1=$_POST['phone_number'];

        $errors= array();
        if (!preg_match("/^[A-Za-z\._\0-9]*[@?][A-Za-z]*[\.][a-z]{2,4}$/", $email1)&&!empty($email1)) {
            $errors['email10'] = 'Email chưa đúng định dạng. VD: example@gmail.com';
        }
        if(!preg_match("/^\d{10}$/",$sdt1)&&!empty($sdt1)){
            $errors['phone_number10']='Số điện thoại không được có chữ và đủ 10 số';
        }
        if(empty($sdt1))
        {
            $errors['phone_number11']='';
        }
        if(empty($email1))
        {
            $errors['email11']='';
        }
        if(empty($errors)){
            $response= array(
                'success'=> true
            );
        } else{
            $response = array(
                'success' => false,
                'errors' => $errors
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
?>