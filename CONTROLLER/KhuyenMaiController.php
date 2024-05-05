<?php
// class KhuyenMaiController{
require_once __DIR__.'\..\MODEL\KhuyenMaiModel.php';
require_once __DIR__.'\..\MODEL\SanPhamModel.php';
function index()
{
    $coupondList = DanhSachKhuyenMaiModel();
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
    $isSuccessCreate = TaoMoiKhuyenMaiModel($coupondInfo);
    $couponsList = DanhSachKhuyenMaiModel();
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
    $isSuccessDeleteCoupond = XoaKhuyenMaiModel($coupondID);
    $coupondList = DanhSachKhuyenMaiModel();
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
    $listProductIDWannaApply = $infoApply['listproductidwannaapply'];
    $coupondID = $infoApply['couponid'];
    $isSuccessSave = SaveDetailApplyCoupondModel($coupondID, $listProductIDWannaApply);
    if ($isSuccessSave == 1) {
        echo "Áp dụng khuyến mãi thành côngs!";
    } else {
        echo "Áp dụng khuyến mãi thất bại!";
    }
}

function ViewDetailCoupond($couponID)
{
    // Get product details
    $productsApplied = GetDetailCoupondByID($couponID);
    // Get coupon information
    $coupondInfo = GetCoupondById($couponID);
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
    $coupondInfo = json_encode(GetCoupondById($couponID));
    echo $coupondInfo;
}

function UpdateCoupondInfoController($couponID, $coupondInfo)
{
    $isSuccessUpdate = UpdateCoupondInfoModel($couponID,$coupondInfo); //this is number(bool)
    $couponsList = DanhSachKhuyenMaiModel(); //this is array 
    $response = array(
        'success' => $isSuccessUpdate,
        'couponsList' => $couponsList
    );
    print_r(json_encode($response));
}




function AutoUnappliedCoupondController(){
    AutoUnappliedCouponModel();
}