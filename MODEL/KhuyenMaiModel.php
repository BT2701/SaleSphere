<?php
function getInstance()
{
    require_once __DIR__.'\..\MODEL\Database.php';
    $db = new Database();
    $conn = $db->getConnection();
    return $conn;
}

function TaoMoiKhuyenMaiModel($coupondInfo)
{
    $data = json_decode($coupondInfo, true);
    $conn = getInstance();
    $sql = "INSERT INTO `khuyenmai`(`tenKhuyenMai`, `hanSuDung`, `giaTri`, `background`) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $data['tenKhuyenMai'], $data['hanSuDung'], $data['giaTri'], $data['background']);
    $stmt->execute();
    $isSuccess = $stmt->affected_rows;
    $stmt->close();
    return $isSuccess;
}

function DanhSachKhuyenMaiModel()
{
    $conn = getInstance();
    $sql = "SELECT * FROM `khuyenmai` WHERE (hanSuDung >= CURRENT_DATE()) ORDER BY id DESC;";
    $result = $conn->query($sql);
    if ($result) {
        // Fetch all rows as an associative array
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        // Free the result set
        $result->free();
        // Close the connection
        $conn->close();
        // Return the fetched rows
        return $rows;
    } else {
        // Query failed
        echo "Error: " . $conn->error;
        return null;
    }
}


function XoaKhuyenMaiModel($coupondID)
{
    $conn = getInstance();
    if (XoaChiTietKhuyenMaiModel($coupondID, $conn)) {
        $sql = "DELETE FROM `khuyenmai` WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $coupondID);
        $stmt->execute();
        $isSuccess = $stmt->affected_rows;
        $stmt->close();
        return $isSuccess;
    }
    return false;
}

//XOA CHI TIET KHUYEN MAI BANG MA KHUYEN MAI
function XoaChiTietKhuyenMaiModel($coupondID, $conn)
{
    $sql = "DELETE FROM `chitietkhuyenmai` WHERE idkhuyenmai  = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $coupondID);
    $isSuccess = $stmt->execute();
    $stmt->close();
    return $isSuccess;
}


// function ApplyCoupondForEachProduct($coupondID,$listProductIDWannaApply)
// {
//     //case each product
//     //product has  => update 
//     //product has'n  => insert
//     $signal = XoaChiTietKhuyenMaiModel($listProductIDWannaApply);
//     return $signal;
// }


// function DeleteDetailCoupondByProductId($productIds,$coupondID)
// {
//     $conn = getInstance();
//     $productIdsArray = explode(",", $productIds);
//     $placeholders = rtrim(str_repeat('?,', count($productIdsArray)), ',');
//     $sql = "DELETE FROM `chitietkhuyenmai` WHERE idsanpham IN ($placeholders) OR idkhuyenmai = ?";
//     $stmt = $conn->prepare($sql);
//     $types = str_repeat('s', count($productIdsArray)); // Assuming productIds are strings
//     $stmt->bind_param($types, ...$productIdsArray);
//     $isSuccess = $stmt->execute();
//     $stmt->close();
//     return $isSuccess;
// }


function DeleteDetailCoupondByProductId($productIds, $coupondID)
{
    $conn = getInstance();
    $productIdsArray = explode(",", $productIds);
    $placeholders = rtrim(str_repeat('?,', count($productIdsArray)), ',');
    $types = str_repeat('i', count($productIdsArray)) . 'i'; // Assuming the coupon ID is also an integer
    if ($productIds == "") {
        $sql = "DELETE FROM `chitietkhuyenmai` WHERE idkhuyenmai = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $coupondID);
    } else {
        $sql = "DELETE FROM `chitietkhuyenmai` WHERE idsanpham IN ($placeholders) OR idkhuyenmai = ?";
        $stmt = $conn->prepare($sql);
        $params = array_merge($productIdsArray, [$coupondID]); // Assuming $couponID is an integer
        $stmt->bind_param($types, ...$params);
    }
    $isSuccessDelete = $stmt->execute();
    $stmt->close();
    return $isSuccessDelete;
}




function SaveDetailApplyCoupondModel($couponID, $listProductIDWannaApply)
{

    if ($listProductIDWannaApply == "") {
        return DeleteDetailCoupondByProductId($listProductIDWannaApply, $couponID);
    } else {
        $array = explode(",", $listProductIDWannaApply);
        DeleteDetailCoupondByProductId($listProductIDWannaApply, $couponID);
        $conn = getInstance();
        $values = '';
        foreach ($array as $productID) {
            $values .= "('$productID','$couponID'),"; // Corrected concatenation
        }
        $values = rtrim($values, ',');
        $sql = "INSERT INTO `chitietkhuyenmai`(`idsanpham`, `idkhuyenmai`) VALUES " . $values;
        $isSuccessSave = $conn->query($sql);
        return $isSuccessSave;
        // return false;
    }
}


function GetDetailCoupondByID($couponID)
{
    $conn = getInstance(); // Assuming this function returns the database connection
    $sql = "SELECT sp.id, sp.tenSanPham 
            FROM `sanpham` as sp 
            WHERE sp.id IN (
                SELECT idsanpham 
                FROM `chitietkhuyenmai` 
                WHERE idkhuyenmai = ?
            )";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $couponID); // Assuming the coupon ID is an integer
    $stmt->execute();
    $result = $stmt->get_result();
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    $stmt->close();

    // Now you can do whatever you want with the $products array, like returning it
    return $products;
}

function GetCoupondById($couponID)
{
    $conn = getInstance(); // Assuming this function returns the database connection
    $sql = "SELECT *
            FROM `khuyenmai`
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $couponID); // Assuming the coupon ID is an integer
    $stmt->execute();
    $result = $stmt->get_result();
    $coupon = $result->fetch_assoc();
    $stmt->close();
    // Now you can do whatever you want with the $coupon array, like returning it
    return $coupon;
}


function UpdateCoupondInfoModel($couponID, $coupondInfo)
{
    $data = json_decode($coupondInfo, true);
    $conn = getInstance(); // Assuming this function returns the database connection
    $sql = "UPDATE `khuyenmai` SET `tenKhuyenMai`=?,`hanSuDung`=?,`giaTri`=?,`background`=? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisi", $data['tenKhuyenMai'], $data['hanSuDung'], $data['giaTri'], $data['background'], $couponID); // Assuming the coupon ID is an integer
    $isSuccessUpdate = $stmt->execute();
    $stmt->close();
    return $isSuccessUpdate;
}


function ListCoupondExpiry()
{
    $conn = getInstance(); // Assuming this function returns the database connection
    $sql = "SELECT `id` FROM `khuyenmai` WHERE hanSuDung < CURRENT_DATE()";
    $result = $conn->query($sql);
    $listCoupondExpiry = array();
    while ($row = $result->fetch_assoc()) {
        $listCoupondExpiry[] = $row['id']; // Extract 'id' field from the fetched row
    }
    return $listCoupondExpiry;
}

function AutoUnappliedCouponModel()
{
    $conn = getInstance();
    $couponExpiryIdsArray = ListCoupondExpiry(); // Assuming this function returns an array of coupon expiry IDs
    if (empty($couponExpiryIdsArray)) {
        return false; // No coupon expiry IDs found, return false
    } else {
        // Prepare the SQL statement
        $placeholders = rtrim(str_repeat('?,', count($couponExpiryIdsArray)), ',');
        $sql = "DELETE FROM `chitietkhuyenmai` WHERE idkhuyenmai IN ($placeholders)";
        $stmt = $conn->prepare($sql);

        // Dynamically bind parameters
        $types = str_repeat('i', count($couponExpiryIdsArray)); // Assuming coupon expiry IDs are integers
        $stmt->bind_param($types, ...$couponExpiryIdsArray);

        // Execute the statement
        $isSuccessDelete = $stmt->execute();

        // Close the statement
        $stmt->close();

        return $isSuccessDelete; // Return whether the deletion was successful
    }
}
