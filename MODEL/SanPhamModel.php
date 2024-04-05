<?php
    
class SanPhamModel {
    public function getInstance(){
        require_once 'C:\xampp\htdocs\web2\MODEL\Database.php';
    }
    public function getSanPhamList() {
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $sql = "SELECT s.tenSanPham, s.giaBan, s.src, k.giaTri, k.background,SUM(cthd.soluong) AS TongSoLuongBanDuoc, k.tenKhuyenMai, dg.star, k.hansudung 
        FROM sanpham s
        LEFT JOIN chitietkhuyenmai ctk ON s.id = ctk.idsanpham
        LEFT JOIN khuyenmai k ON ctk.idkhuyenmai = k.id
        LEFT JOIN danhgia dg ON s.id = dg.idsanpham
        LEFT JOIN chitiethoadon cthd ON s.id = cthd.idsanpham
        GROUP BY cthd.idsanpham, s.tenSanPham, s.giaBan, s.src, k.giaTri, k.tenKhuyenMai, dg.star
        ORDER BY TongSoLuongBanDuoc DESC
        ";
        $result = $conn->query($sql);
        $sanphamList = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sanphamList[] = $row;
            }
        }
        $conn->close();
        return $sanphamList;
    }
    public function getListSPNoiBac(){
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $sql = "SELECT s.tenSanPham, s.giaBan, s.src, k.giaTri, k.background,SUM(cthd.soluong) AS TongSoLuongBanDuoc, k.tenKhuyenMai, dg.star, k.hansudung
        FROM sanpham s
        LEFT JOIN chitietkhuyenmai ctk ON s.id = ctk.idsanpham
        LEFT JOIN khuyenmai k ON ctk.idkhuyenmai = k.id
        LEFT JOIN danhgia dg ON s.id = dg.idsanpham
        LEFT JOIN chitiethoadon cthd ON s.id = cthd.idsanpham
        GROUP BY cthd.idsanpham, s.tenSanPham, s.giaBan, s.src, k.giaTri, k.tenKhuyenMai, dg.star
        ORDER BY TongSoLuongBanDuoc DESC
        LIMIT 5;
        ";
        $result = $conn->query($sql);
        $sanphamList = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sanphamList[] = $row;
            }
        }
        $conn->close();
        return $sanphamList;
    }
    public function getListSPKhuyenMai(){
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $sql = "SELECT s.tenSanPham, s.giaBan, s.src, k.giaTri, k.background,SUM(cthd.soluong) AS TongSoLuongBanDuoc, k.tenKhuyenMai, dg.star
        FROM sanpham s
        LEFT JOIN chitietkhuyenmai ctk ON s.id = ctk.idsanpham
        LEFT JOIN khuyenmai k ON ctk.idkhuyenmai = k.id
        LEFT JOIN danhgia dg ON s.id = dg.idsanpham
        LEFT JOIN chitiethoadon cthd ON s.id = cthd.idsanpham
        WHERE k.hansudung > NOW() OR k.hansudung IS NULL AND s.id = ctk.idsanpham
        GROUP BY cthd.idsanpham, s.tenSanPham, s.giaBan, s.src, k.giaTri, k.tenKhuyenMai, dg.star
        ORDER BY TongSoLuongBanDuoc DESC
        ";
        $result = $conn->query($sql);
        $sanphamList = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sanphamList[] = $row;
            }
        }
        $conn->close();
        return $sanphamList;
    }
    public function getDsSPtheoLoai($category) {
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $sanphamList = array();
        $sql = "SELECT s.tenSanPham, s.giaBan, s.src, k.giaTri, k.background,SUM(cthd.soluong) AS TongSoLuongBanDuoc, k.tenKhuyenMai, dg.star, l.tenLoaiSP, k.hansudung 
        FROM sanpham s
        LEFT JOIN chitietkhuyenmai ctk ON s.id = ctk.idsanpham
        LEFT JOIN khuyenmai k ON ctk.idkhuyenmai = k.id
        LEFT JOIN danhgia dg ON s.id = dg.idsanpham
        LEFT JOIN chitiethoadon cthd ON s.id = cthd.idsanpham
        LEFT JOIN loaisp l ON s.idloaisp = l.id
        WHERE  l.tenLoaiSP = ? 
        GROUP BY cthd.idsanpham, s.tenSanPham, s.giaBan, s.src, k.giaTri, k.tenKhuyenMai, dg.star
        ORDER BY TongSoLuongBanDuoc DESC
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sanphamList[] = $row;
            }
        }
        
        $conn->close();
        return $sanphamList;
    }
}


?>
