<?php
require_once 'C:\xampp\htdocs\web2\MODEL\GioHangModel.php';
require_once 'C:\xampp\htdocs\web2\CONTROLLER\SanPhamController.php';
function AddProductToCartController($idSanPham,$idUser,$soLuongThem){
    $gioHangModel = new GioHangModel();
    $statusAddProduct = $gioHangModel->addProductToCart($idSanPham,$idUser,$soLuongThem);
    // $numberProductInCart = $gioHangModel->getNumberProductInCart($idUser);
    $numberProductInCart = NumberProductInCart($idUser);

    $soLuongSanPhamTrongGioHang = QuantityProductInCart($idSanPham,$idUser);
    $soLuongSanPhamTrongKho = quantityProduct($idSanPham);
    $soLuongCoTheThem = $soLuongSanPhamTrongKho - $soLuongSanPhamTrongGioHang;
    
    $data = array(
        "numberProductInCart" => $numberProductInCart,
        "statusAddProduct" => $statusAddProduct,
        'quantityCanAdd' => $soLuongCoTheThem
    );
    $json = json_encode($data);
    echo $json;
}


function QuantityProductInCart($idSanPham,$idUser){
    $gioHangModel = new GioHangModel();
    $quantityProductInCart = $gioHangModel->getQuantityProductInCart($idSanPham,$idUser);
    return $quantityProductInCart;
}

function NumberProductInCart($idUser){
    $gioHangModel = new GioHangModel();
    $numberProductInCart = $gioHangModel->getNumberProductInCart($idUser);
    return $numberProductInCart;
}