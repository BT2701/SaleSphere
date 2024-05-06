<?php
// class KhuyenMaiController{
require_once __DIR__.'\..\MODEL\KhuyenMaiModel.php';
require_once __DIR__.'\..\MODEL\SanPhamModel.php';
function index()
{
    $KhuyenMaiModel = new KhuyenMaiModel();
    $coupondList = $KhuyenMaiModel->DanhSachKhuyenMaiModel();
    require_once __DIR__.'\..\VIEWS\admin\coupond\quanlykhuyenmai.php';
}


// function TaoMoiKhuyenMaiController($coupondInfo)
// {
//     $isSuccessCreate = TaoMoiKhuyenMaiModel($coupondInfo);
//     $rows = DanhSachKhuyenMaiModel();
//     header("Location: http://localhost/web2/index.php?page=coupond");
// }

function TaoMoiKhuyenMaiController($coupondInfo)
{
    $KhuyenMaiModel = new KhuyenMaiModel();
    $isSuccessCreate = $KhuyenMaiModel->TaoMoiKhuyenMaiModel($coupondInfo);
    $couponsList = $KhuyenMaiModel->DanhSachKhuyenMaiModel();
    $response = array(
        'success' => $isSuccessCreate,
        'couponsList' => $couponsList
    );
    $jsonResponse = json_encode($couponsList);
    print_r(json_encode($response));
}

function XoaKhuyenMaiController($coupondID)
{
    //xoa danh sach chi tiet khuyen mai
    // $isSuccessDeleteDetailCoupond = XoaChiTietKhuyenMaiModel($coupondID);
    //xoa khuyen mai bang ma khuyen mai
    $KhuyenMaiModel = new KhuyenMaiModel();
    $isSuccessDeleteCoupond = $KhuyenMaiModel->XoaKhuyenMaiModel($coupondID);
    $coupondList = $KhuyenMaiModel->DanhSachKhuyenMaiModel();
    $response = array(
        'success' => $isSuccessDeleteCoupond,
        'couponsList' => $coupondList
    );
    print_r(json_encode($response));
    // if ($isSuccessDeleteCoupond) {
    //     echo "Xóa khuyến mãi thành công";
    // } else {
    //     echo "Xóa khuyến mãi thất bại";
    // }
}


function PrePareDataApplyModal($Products)
{
    $ProductsJson = json_encode($Products);
    echo $ProductsJson;
}


function SaveDetailApplyCoupondController($infoApply)
{
    $KhuyenMaiModel = new KhuyenMaiModel();
    $listProductIDWannaApply = $infoApply['listproductidwannaapply'];
    $coupondID = $infoApply['couponid'];
    $isSuccessSave = $KhuyenMaiModel->SaveDetailApplyCoupondModel($coupondID, $listProductIDWannaApply);
    if ($isSuccessSave == 1) {
        echo "Áp dụng khuyến mãi thành côngs!";
    } else {
        echo "Áp dụng khuyến mãi thất bại!";
    }
}

function ViewDetailCoupond($couponID)
{
    // Get product details
    $KhuyenMaiModel = new KhuyenMaiModel();
    $productsApplied = $KhuyenMaiModel->GetDetailCoupondByID($couponID);
    // Get coupon information
    $coupondInfo = $KhuyenMaiModel->GetCoupondById($couponID);
    // Combine coupon information with product details
    $couponDetail = array(
        "coupond_info" => $coupondInfo,
        "products_applied" => $productsApplied
    );
    // Encode the combined data as JSON
    $couponDetailJson = json_encode($couponDetail);
    // Echo JSON response
    echo $couponDetailJson;
    // echo $couponInfo;
}


function PrepareInfoCoupondEditModal($couponID)
{
    $KhuyenMaiModel = new KhuyenMaiModel();
    $coupondInfo = json_encode($KhuyenMaiModel->GetCoupondById($couponID));
    echo $coupondInfo;
}

function UpdateCoupondInfoController($couponID, $coupondInfo)
{
    $KhuyenMaiModel = new KhuyenMaiModel();
    $isSuccessUpdate = $KhuyenMaiModel->UpdateCoupondInfoModel($couponID,$coupondInfo); //this is number(bool)
    $couponsList = $KhuyenMaiModel->DanhSachKhuyenMaiModel(); //this is array 
    $response = array(
        'success' => $isSuccessUpdate,
        'couponsList' => $couponsList
    );
    print_r(json_encode($response));
}




function AutoUnappliedCoupondController(){
    $KhuyenMaiModel = new KhuyenMaiModel();
    $KhuyenMaiModel->AutoUnappliedCouponModel();
}