<?php
class DanhGiaModel{
    public function getInstance()
    {
        require_once __DIR__.'\..\MODEL\Database.php';
    }

    //LẤY TOÀN BỘ THÔNG TN ĐÁNH GIÁ CỦA CÁC KHÁCH HÀNG ĐỐI VỚI SẢN PHẨM
    // public function getInfoEvaluateOfProduct($productID,$danhGiabatDau){
    //     $this->getInstance();
    //     $db = new Database();
    //     $connection = $db->getConnection();
    //     $sql = "SELECT * FROM `danhgia` as dg
    //             JOIN users ON users.id = dg.idkhachhang
    //     WHERE dg.idsanpham = ?
    //     ORDER BY ngaydanhgia DESC
    //     LIMIT 5 OFFSET ?";
    //     $stmt = $connection->prepare($sql);
    //     $stmt->bind_param("ii",$productID,$danhGiabatDau);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $thongTinDanhGia = array(); 
    //     while ($row = $result->fetch_assoc()) {
    //         $thongTinDanhGia[] = $row; // Append the row to the $cartInfo array
    //     }
    //     $stmt->close();
    //     $result->close();
    //     $connection->close();
    //     return $thongTinDanhGia;
    // }

    public function getInfoEvaluateOfProduct($productID,$danhGiabatDau,$loaiDanhGia){
            $this->getInstance();
            $db = new Database();
            $connection = $db->getConnection();
            $sql = "SELECT * FROM `danhgia` as dg
                    JOIN users ON users.id = dg.idkhachhang
            WHERE dg.idsanpham = ? AND star LIKE ?
            ORDER BY ngaydanhgia DESC
            LIMIT 5 OFFSET ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("isi",$productID,$loaiDanhGia,$danhGiabatDau);
            $stmt->execute();
            $result = $stmt->get_result();
            $thongTinDanhGia = array(); 
            while ($row = $result->fetch_assoc()) {
                $thongTinDanhGia[] = $row; // Append the row to the $cartInfo array
            }
            $stmt->close();
            $result->close();
            $connection->close();
            return $thongTinDanhGia;
        }
}