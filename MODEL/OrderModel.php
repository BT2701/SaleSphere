<?php
// File: OrderModel.php

class OrderModel {

    public function getInstance(){
        require_once __DIR__.'\..\MODEL\Database.php';
    }

    public function getOrderHistory($customerId, $offset, $limit) {
        //offset là vị trí dữ liệu bắt đầu lấy limit là số lượng sữ liệu
        //ý nghĩa của các số: 1 đã đặt hàng, 2 đơn hàng đã được xác nhân, 3 đã nhận được hàng, 4 đơn hàng đã bị hủy
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $query = "SELECT hoadon.id, hoadon.ngayLap, hoadon.trangThai, hoadon.tongTien, 
            sanpham.tenSanPham, sanpham.src, hoadon.idKhachHang,sanPham.giaBan
          FROM hoadon
          INNER JOIN chitiethoadon ON hoadon.id = chitiethoadon.idHoaDon
          INNER JOIN sanpham ON chitiethoadon.idSanPham = sanpham.id
          WHERE hoadon.idKhachHang = $customerId 
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
    public function daNhanDuocHang($idHoaDon) {
        //offset là vị trí dữ liệu bắt đầu lấy limit là số lượng sữ liệu
        //ý nghĩa của các số: 1 đã đặt hàng, 2 đơn hàng đã được xác nhân, 3 đã nhận được hàng, 4 đơn hàng đã bị hủy
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $query = "UPDATE hoadon 
        SET trangThai = '3' 
        WHERE id = ?;";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $idHoaDon);
        $stmt->execute();
    
        if ($stmt->affected_rows > 0) {
            return 'true'; // Trả về true nếu có hàng nào đã được cập nhật
        } else {
            return 'false'; // Trả về false nếu không có hàng nào được cập nhật
        }
    }
}
?>
