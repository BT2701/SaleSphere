<?php
// include 'C:\xampp\htdocs\web2\CONTROLLER\ChiTietSanPhamController.php';
require_once __DIR__.'\..\CONTROLLER\ChiTietSanPhamController.php';
// include("C:\xampp\htdocs\web2\CONTROLLER\SanPhamController.php");
if(isset($_POST['action']) && $_POST['action']=='LoadDanhGia'){
    loadDanhGia($_POST);
}
else if(isset($_POST['action']) && $_POST['action'] =='AddProductToCart'){
    addProductToCart($_POST);
}
else{
   $productID = $_GET['id'];
   index($productID);
}