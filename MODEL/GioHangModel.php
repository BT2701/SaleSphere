<?php
class GioHangModel
{
    public function getInstance()
    {
        require_once 'C:\xampp\htdocs\web2\MODEL\Database.php';
        $db = new Database();
        $conn = $db->getConnection();
        return $conn;
    }

    //version 2
    public function addProductToCart($idSanPham, $userID, $soLuongThem)
    {
        $connection = $this->getInstance();
        // Check if the product exists and belongs to the specified account
        $productExistsForAccount = $this->checkProductExistsForAccount($idSanPham, $userID, $connection);
        if ($productExistsForAccount) {
            // If the product exists for the account, increase the quantity of the product
            $sql = "UPDATE chitietgiohang SET soLuong = soLuong + ? 
                    WHERE idsanpham = ? AND userid = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("iii", $soLuongThem, $idSanPham, $userID);
            $result = $stmt->execute();
            $stmt->close();
        } else {
            // If the product does not exist for the account, insert a new record into giohang
            $sql = "INSERT INTO chitietgiohang (idsanpham, userid, soluong)
                    VALUES (?, ?, ?)";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("iii", $idSanPham, $userID, $soLuongThem);
            $result = $stmt->execute();
            $stmt->close();
        }

        $connection->close();
        return $result;
        // return $productExistsForAccount;

    }

    // KIỂM TRA XEM TÀI KHOẢN NÀY ĐÃ THÊM SẢN PHẨM NÀY VÀO GIỎ HÀNG CHƯA
    private function checkProductExistsForAccount($idSanPham, $userID, $conn)
    {
        $sql = "SELECT COUNT(*) as count
                FROM chitietgiohang 
                WHERE idsanpham = ? AND userid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $idSanPham, $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        if($row['count']){
            return  true;
        }
        return false;
    }



    public function getQuantityProductInCart($userID){
        $conn = $this->getInstance();
        $sql = "SELECT COUNT(*) as quantity
        FROM chitietgiohang
        WHERE userid = ?";
         $stmt = $conn->prepare($sql);
         $stmt->bind_param("i",$userID);
         $stmt->execute();
         $result = $stmt->get_result();
         $row = $result->fetch_assoc();
         $stmt->close();
         return $row['quantity'];
    }


    //version 1 
    // public function addProductToCart($idSanPham, $userID, $soLuongThem)
    // {
    //     $connection = $this->getInstance();
    //     // Check if the product exists and belongs to the specified account
    //     $productExistsForAccount = $this->checkProductExistsForAccount($idSanPham, $userID, $connection);
    //     $idGioHang = $this->getCartID($userID,$connection);
    //     // $isExited = $this->checkProductExistsForAccount($idSanPham, $userID, $connection);
    //     if ($productExistsForAccount) {
    //         // If the product exists for the account, increase the quantity of the product
    //         $sql = "UPDATE chitietgiohang SET soLuong = soLuong + ? 
    //                 WHERE idsanpham = ? AND idgiohang = ?";
    //         $stmt = $connection->prepare($sql);
    //         $stmt->bind_param("iii", $soLuongThem, $idSanPham, $idGioHang);
    //         $result = $stmt->execute();
    //         $stmt->close();
    //     } else {
    //         // If the product does not exist for the account, insert a new record into giohang
    //         $sql = "INSERT INTO chitietgiohang (idgiohang, idsanpham, soLuong)
    //                 VALUES (?, ?, ?)";
    //         $stmt = $connection->prepare($sql);
    //         $stmt->bind_param("iii", $idGioHang, $idSanPham, $soLuongThem);
    //         $result = $stmt->execute();
    //         $stmt->close();
    //     }

    //     $connection->close();
    //     return $result;

    // }

    // // KIỂM TRA XEM TÀI KHOẢN NÀY ĐÃ THÊM SẢN PHẨM NÀY VÀO GIỎ HÀNG CHƯA
    // private function checkProductExistsForAccount($idSanPham, $userID, $conn)
    // {
    //     $sql = "SELECT ctgh.idgiohang
    //             FROM chitietgiohang as ctgh
    //             JOIN giohang as gh  ON gh.id = ctgh.idgiohang
    //             WHERE ctgh.idsanpham = ? AND  gh.userid = ?";

    //     $stmt = $conn->prepare($sql);
    //     $stmt->bind_param("ii", $idSanPham, $userID);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $stmt->close();
    //     if(mysqli_num_rows($result) > 0){
    //         return true;
    //     }
    //     return false;
    // }


    // private function getCartID( $userID, $conn){
    //     $sql = "SELECT id FROM giohang WHERE userid = ?";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bind_param("i", $userID);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $row = $result->fetch_assoc();
    //     $stmt->close();
    //     return $row['id'];
    // }


    //LẤY DANH SÁCH MÃ SẢN PHẨM CÓ TRONG GIỎ HÀNG
    // public function getListIDProductInCartByAccountID($accountID){
    //     $connection = $this->getInstance();
    //     $sql = "SELECT idSanPham FROM giohang WHERE accountID = ?";
    //     $stmt = $connection->prepare($sql);
    //     $stmt->bind_param("i", $accountID); 
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $cartInfo = array(); 
    //     while ($row = $result->fetch_assoc()) {
    //         $cartInfo[] = $row; // Append the row to the $cartInfo array
    //     }
    //     $stmt->close();
    //     $result->close();
    //     $connection->close();
    //     return $cartInfo;
    // }
}