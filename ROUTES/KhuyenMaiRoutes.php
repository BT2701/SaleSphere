<?php
// include 'C:\xampp\htdocs\web2\CONTROLLER\KhuyenMaiController.php';
// include 'C:\xampp\htdocs\web2\CONTROLLER\SanPhamController.php';
require_once __DIR__.'\..\CONTROLLER\KhuyenMaiController.php';
require_once __DIR__.'\..\CONTROLLER\SanPhamController.php';

// $khuyenMaiController = new KhuyenMaiController();
if(isset($_POST['action']) && $_POST['action'] == 'TaoMoiKhuyemMai'){
    $coupondInfo = $_POST['coupondInfo'];
    TaoMoiKhuyenMaiController($coupondInfo);
}
else if(isset($_POST['action']) && $_POST['action'] == 'XoaKhuyenMai'){
    $coupondID = $_POST['idKhuyenMai'];
    XoaKhuyenMaiController($coupondID);
}
else if(isset($_POST['action']) && $_POST['action'] == 'PrepareApplyData'){
    $SPController = new SanPhamController();
    $Products = $SPController->GetAllProduct();
    PrePareDataApplyModal($Products);
}
else if(isset($_POST['action']) && $_POST['action'] == 'SaveDetailApplyCoupond'){
    SaveDetailApplyCoupondController($_POST);
}
else if(isset($_POST['action']) && $_POST['action'] == 'ViewDetailCoupond'){
    // SaveDetailApplyCoupondController($_POST);
    $coupondID = $_POST['coupondid'];
    ViewDetailCoupond($coupondID);
}
else if(isset($_POST['action']) && $_POST['action'] == 'PrepareEditData'){
    $coupondID = $_POST['coupondid'];
    PrepareInfoCoupondEditModal($coupondID);
}
else if(isset($_POST['action']) && $_POST['action'] == 'UpdateCoupondInfo'){
    $coupondID = $_POST['coupondid'];
    $coupondInfo = $_POST['coupondInfo'];
    UpdateCoupondInfoController($coupondID,$coupondInfo);
}
else if(isset($_POST['action']) && $_POST['action'] == 'AutoUnappliedCoupond'){
    AutoUnappliedCoupondController();
}
else{
    index();
}