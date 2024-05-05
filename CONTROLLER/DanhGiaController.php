<?php
// include '/web2/MODEL/DanhGiaModel.php';
require_once __DIR__.'\..\MODEL\DanhGiaModel.php';

if(isset($_POST['action']) && $_POST['action']=='LoadDanhGia'){
    $danhGiaModel = new DanhGiaModel();
    $productID = $_POST['idSanPham'];
    $danhGiaBatDau = $_POST['danhGiaBatDau'];
    $loaiDanhGia = $_POST['loaiDanhGia'];
    $response = $danhGiaModel->getInfoEvaluateOfProduct($productID,$danhGiaBatDau,$loaiDanhGia);
    // echo $_POST['action'];
    echo json_encode($response);
}
