<?php
// File: OrderModel.php

class ChiTietDonHangModel {

    public function getInstance(){
        require_once 'C:\xampp\htdocs\web2\MODEL\Database.php';
    }

    public function LayChiTietDonHang($customerId, $offset, $limit,$IDDonhang) {//offset là vị trí dữ liệu bắt đầu lấy limit là số lượng sữ liệu
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $query = "SELECT 
        sanpham.src,
        sanpham.tenSanPham,
        sanpham.giaBan,
        sanpham.id,
        chitiethoadon.soLuong
      FROM 
        hoadon
      INNER JOIN 
        chitiethoadon ON hoadon.id = chitiethoadon.idHoaDon
      INNER JOIN 
        sanpham ON chitiethoadon.idSanPham = sanpham.id
      WHERE 
        hoadon.idKhachHang = $customerId AND hoadon.id = $IDDonhang
      LIMIT 
        $limit OFFSET $offset;";
        
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
    public function CheckEvaluate($idKhachHang, $idHoaDon, $idSanPham){
      $this->getInstance();
      $db = new Database();
      $conn = $db->getConnection();
      $query = "SELECT * 
                FROM danhgia 
                WHERE idsanpham = $idSanPham
                AND idhoadon = $idHoaDon
                AND idkhachhang = $idKhachHang;";  
      $stmt = $conn->query($query);
      $hasValidRow = false; // Biến để kiểm tra xem có dòng nào thỏa mãn điều kiện hay không
      if ($stmt->num_rows > 0) {
          while ($row = $stmt->fetch_assoc()) {
              // Kiểm tra xem dòng hiện tại có đủ 3 tham số không
                  $hasValidRow = true; // Đánh dấu rằng có ít nhất một dòng thỏa mãn điều kiện
             // Thoát khỏi vòng lặp ngay khi có một dòng thỏa mãn
          }
      }
      $conn->close();
      return $hasValidRow; // Trả về true nếu có ít nhất một dòng thỏa mãn, ngược lại trả về false
  }
}  
?>
