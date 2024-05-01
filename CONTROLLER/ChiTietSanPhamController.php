<?php
require_once 'C:\xampp\htdocs\web2\CONTROLLER\DanhGiaController.test.php';
require_once 'C:\xampp\htdocs\web2\CONTROLLER\GioHangController.test.php';
require_once 'C:\xampp\htdocs\web2\CONTROLLER\SanPhamController.test.php';

function index($idSanPham)
{
    $detailProduct = getDetailProduct($idSanPham,1);
    require_once 'C:\xampp\htdocs\web2\VIEWS\productdetail\product-detail.test.php';
}


function loadDanhGia($infoRequest){
    $productID = $infoRequest['idSanPham'];
    $danhGiaBatDau = $infoRequest['danhGiaBatDau'];
    $loaiDanhGia = $infoRequest['loaiDanhGia'];
    getInfoEvaluateOfProductController($productID,$danhGiaBatDau,$loaiDanhGia);
}


function addProductToCart($infoRequest){
    $idSanPham = $infoRequest['idSanPham'];
    $idUser = $infoRequest['idUser'];
    $soLuongThem = $infoRequest['soLuongThem'];
    AddProductToCartController($idSanPham,$idUser,$soLuongThem);
}

function getDetailProduct($idSanPham,$idUser){
    $infoProduct = detailProduct($idSanPham);
    $giaTriKhuyenMai = sumOfValueDiscount($idSanPham);
    $giaKhuyenMai = $infoProduct['giaBan'] - $infoProduct['giaBan'] * ($giaTriKhuyenMai / 100);
    $soLuongDaBan = quantityOfProductsSold($idSanPham);
    $soLuongDanhGiaTatCa = countOfEvaluate($idSanPham, "_");
    $soLuongDanhGia5Sao = countOfEvaluate($idSanPham, "5");
    $soLuongDanhGia4Sao = countOfEvaluate($idSanPham, "4");
    $soLuongDanhGia3Sao = countOfEvaluate($idSanPham, "3");
    $soLuongDanhGia2Sao = countOfEvaluate($idSanPham, "2");
    $soLuongDanhGia1Sao = countOfEvaluate($idSanPham, "1");
    $danhGiaTrungBinh = avgOfStarEvaluate($idSanPham);
    $soLuongSanPhamTrongGioHang = QuantityProductInCart($idSanPham,$idUser);
    $soLuongSanPhamTrongKho = quantityProduct($idSanPham);
    $soLuongSanPhamCoTheThem = $soLuongSanPhamTrongKho - $soLuongSanPhamTrongGioHang;
    $detailProduct = array(
        'infoProduct' => $infoProduct,
        'valueDiscount'=>$giaTriKhuyenMai,
        'discountPrice'=>$giaKhuyenMai,
        'quantitySold' => $soLuongDaBan,
        'quantityEvaluateAll' => $soLuongDanhGiaTatCa,
        'quantityEvaluate5Star'=> $soLuongDanhGia5Sao,
        'quantityEvaluate4Star'=> $soLuongDanhGia4Sao,
        'quantityEvaluate3Star'=> $soLuongDanhGia3Sao,
        'quantityEvaluate2Star'=> $soLuongDanhGia2Sao,
        'quantityEvaluate1Star'=> $soLuongDanhGia1Sao,
        'avgEvaluate'=>$danhGiaTrungBinh,
        'quantityProductBaseOnUserID' =>$soLuongSanPhamCoTheThem,
        'quantityProductInStore' => $soLuongSanPhamTrongKho
    );
    return $detailProduct;
}