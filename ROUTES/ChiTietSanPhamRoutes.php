<?php
// include 'C:\xampp\htdocs\SaleSphere\CONTROLLER\ChiTietSanPhamController.php';
require_once __DIR__.'\..\CONTROLLER\ChiTietSanPhamController.php';
require_once __DIR__.'\..\CONTROLLER\GioHangController.php';
require_once __DIR__.'\..\CONTROLLER\NhapHangController.php';
// include("C:\xampp\htdocs\SaleSphere\CONTROLLER\SanPhamController.php");
if(isset($_POST['action']) && $_POST['action']=='LoadDanhGia'){
    loadDanhGia($_POST);
}
else if(isset($_POST['action']) && $_POST['action'] =='AddProductToCart'){
    addProductToCart($_POST);
}
else if(isset($_POST['action']) && $_POST['action'] =='PayNow'){
    BuyNow($_POST);
}
else if(isset($_POST['action']) && $_POST['action'] =='XemChiTietPhieuNhap'){
    $idPhieuNhap = $_POST['idPhieuNhap'];
    $phieuNhapController =new NhapHangController();
    $phieuNhapController->layDsChiTietPhieuNhap1($idPhieuNhap);
}
else{
   $productID = $_GET['id'];
   index($productID,$idUser);
}