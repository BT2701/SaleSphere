<?php
// File: OrderModel.php

class OrderModel {

    public function getInstance(){
        require_once 'C:\xampp\htdocs\web2\MODEL\Database.php';
    }

    public function getOrderHistory($customerId, $offset, $limit) {//offset là vị trí dữ liệu bắt đầu lấy limit là số lượng sữ liệu
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $query = "SELECT hoadon.id, hoadon.ngayLap, hoadon.trangThai, hoadon.tongTien, 
            sanpham.tenSanPham, sanpham.src, hoadon.idKhachHang,sanPham.giaBan
          FROM hoadon
          INNER JOIN chitiethoadon ON hoadon.id = chitiethoadon.idHoaDon
          INNER JOIN sanpham ON chitiethoadon.idSanPham = sanpham.id
          WHERE hoadon.idKhachHang = $customerId and hoadon.trangThai=1 
          GROUP BY hoadon.id
          ORDER BY hoadon.ngayLap DESC
          LIMIT $limit OFFSET $offset;";
        
        $stmt = $conn->query($query);
        $sanpham = array();
        if ($stmt->num_rows > 0) {
            while ($row = $stmt->fetch_assoc()) {
                $sanpham[] = $row; // Thêm hàng dữ liệu vào mảng
            }
        }
        $conn->close();
        return $sanpham;
    }
}
?>
