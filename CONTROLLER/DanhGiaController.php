<?php
// require_once'C:\xampp\htdocs\SaleSphere\MODEL\DanhGiaModel.php';
require_once __DIR__.'\..\MODEL\DanhGiaModel.php';
function getInfoEvaluateOfProductController($productID,$danhGiaBatDau,$loaiDanhGia){
    $danhGiaModel = new DanhGiaModel();
    $response = $danhGiaModel->getInfoEvaluateOfProduct($productID,$danhGiaBatDau,$loaiDanhGia);
    echo json_encode($response);
}