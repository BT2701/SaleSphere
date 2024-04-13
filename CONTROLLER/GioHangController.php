<?php
require_once 'C:\xampp\htdocs\web2\MODEL\GioHangModel.php';
$gioHangModel = new GioHangModel();
//KIỂM TRA XEM HÀNH ĐỘNG LÀ GÌ? 

if(isset($_POST['action']) && $_POST['action'] =='AddProductToCart') {
    $idSanPham = $_POST['idSanPham'];
    $idUser = $_POST['idUser'];
    $soLuongThem = $_POST['soLuongThem'];
    $statusAddProduct = $gioHangModel->addProductToCart($idSanPham,$idUser,$soLuongThem);
    $quantityProductInCart = $gioHangModel->getQuantityProductInCart($idUser);
    $data = array(
        "quantityProductInCart" => $quantityProductInCart,
        "statusAddProduct" => $statusAddProduct
    );
    $json = json_encode($data);
    echo $json;
} 