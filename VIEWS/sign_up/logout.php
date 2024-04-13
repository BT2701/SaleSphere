<?php
    session_start();
    if(isset($_SESSION['login_name'])&&$_SESSION['login_name']!="")
    {
        unset($_SESSION['login_name']);
    }
    if(isset($_SESSION['id'])&&$_SESSION['id']!=''){
        unset($_SESSION['id']);
    }
    header('Location: /web2/index.php');
?>