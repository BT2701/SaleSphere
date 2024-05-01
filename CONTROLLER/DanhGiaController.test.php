<?php
require_once'C:\xampp\htdocs\web2\MODEL\DanhGiaModel.php';


function getInfoEvaluateOfProductController($productID,$danhGiaBatDau,$loaiDanhGia){
    $danhGiaModel = new DanhGiaModel();
    $response = $danhGiaModel->getInfoEvaluateOfProduct($productID,$danhGiaBatDau,$loaiDanhGia);
    echo json_encode($response);
}