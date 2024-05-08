<?php
require_once __DIR__.'\DanhGiaController.php';
require_once __DIR__.'\GioHangController.php';
require_once __DIR__.'\SanPhamController.php';

function index($idSanPham,$idUser)
{
    $detailProduct = getDetailProduct($idSanPham,$idUser);
    require_once __DIR__.'\..\VIEWS\productdetail\product-detail.php';
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
    $SanPhamController =  new SanPhamController();
    $infoProduct = $SanPhamController->detailProduct($idSanPham);
    $giaTriKhuyenMai = $SanPhamController->sumOfValueDiscount($idSanPham);
    $giaKhuyenMai = $infoProduct['giaBan'] - $infoProduct['giaBan'] * ($giaTriKhuyenMai / 100);
    $soLuongDaBan = $SanPhamController->quantityOfProductsSold($idSanPham);
    $soLuongDanhGiaTatCa = $SanPhamController->countOfEvaluate($idSanPham, "_");
    $soLuongDanhGia5Sao = $SanPhamController->countOfEvaluate($idSanPham, "5");
    $soLuongDanhGia4Sao = $SanPhamController->countOfEvaluate($idSanPham, "4");
    $soLuongDanhGia3Sao = $SanPhamController->countOfEvaluate($idSanPham, "3");
    $soLuongDanhGia2Sao = $SanPhamController->countOfEvaluate($idSanPham, "2");
    $soLuongDanhGia1Sao = $SanPhamController->countOfEvaluate($idSanPham, "1");
    $danhGiaTrungBinh = $SanPhamController->avgOfStarEvaluate($idSanPham);
    $soLuongSanPhamTrongGioHang = QuantityProductInCart($idSanPham,$idUser);
    $soLuongSanPhamTrongKho = $SanPhamController->quantityProduct($idSanPham);
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