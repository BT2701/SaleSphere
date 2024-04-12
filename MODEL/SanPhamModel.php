<?php
    
class SanPhamModel {
    public function getInstance(){
        require_once 'C:\xampp\htdocs\web2\MODEL\Database.php';
    }
    public function laySoLuongSanPham(){
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $sql = "SELECT COUNT(*) AS total FROM sanpham";

        // Thực thi truy vấn và lấy kết quả
        $result = $conn->query($sql);
        $total=0;
        // Kiểm tra xem có kết quả nào không
        if ($result->num_rows > 0) {
            // Lặp qua từng dòng dữ liệu
            while($row = $result->fetch_assoc()) {
                $total= $row["total"];
            }
        } 
        
        // Đóng kết nối
        $conn->close();
        return $total;
    }
    public function laySoLuongSanPhamTheoTen($name){
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $sql = "SELECT COUNT(*) AS total 
        FROM sanpham s 
        WHERE  s.tenSanPham LIKE ? ";

        // Thực thi truy vấn và lấy kết quả
        $stmt = $conn->prepare($sql);
        $name_param = "%" . $name . "%";
        $stmt->bind_param("s", $name_param);
        $stmt->execute();
        $result = $stmt->get_result();
        $total=0;
        // Kiểm tra xem có kết quả nào không
        if ($result->num_rows > 0) {
            // Lặp qua từng dòng dữ liệu
            while($row = $result->fetch_assoc()) {
                $total= $row["total"];
            }
        } 
        
        // Đóng kết nối
        $conn->close();
        return $total;
    }
    public function laySoLuongSanPhamTheoLoai($category){
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $sql = "SELECT COUNT(*) AS total
        FROM sanpham s  
        LEFT JOIN loaisp l ON s.idloaisp = l.id
        WHERE  l.tenLoaiSP = ?";

        // Thực thi truy vấn và lấy kết quả
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result();
        $total=0;
        // Kiểm tra xem có kết quả nào không
        if ($result->num_rows > 0) {
            // Lặp qua từng dòng dữ liệu
            while($row = $result->fetch_assoc()) {
                $total= $row["total"];
            }
        } 
        
        // Đóng kết nối
        $conn->close();
        return $total;
    }
    public function laySoLuongSanPhamTheoKhoangGia($from, $to){
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $sql = "SELECT COUNT(*) AS total 
        FROM sanpham s 
        WHERE  s.giaBan >= ? and s.giaBan < ? ";

        // Thực thi truy vấn và lấy kết quả
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $from, $to);
        $stmt->execute();
        $result = $stmt->get_result();
        $total=0;
        // Kiểm tra xem có kết quả nào không
        if ($result->num_rows > 0) {
            // Lặp qua từng dòng dữ liệu
            while($row = $result->fetch_assoc()) {
                $total= $row["total"];
            }
        } 
        
        // Đóng kết nối
        $conn->close();
        return $total;
    }
    public function getSanPhamList($start,$limit ) {
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $start = intval($start);
        $limit = intval($limit);
        $sql = "SELECT s.tenSanPham, s.giaBan, s.src, k.giaTri, k.background,SUM(cthd.soluong) AS TongSoLuongBanDuoc, k.tenKhuyenMai, dg.star, k.hansudung  
        FROM sanpham s
        LEFT JOIN chitietkhuyenmai ctk ON s.id = ctk.idsanpham
        LEFT JOIN khuyenmai k ON ctk.idkhuyenmai = k.id
        LEFT JOIN danhgia dg ON s.id = dg.idsanpham
        LEFT JOIN chitiethoadon cthd ON s.id = cthd.idsanpham
        GROUP BY cthd.idsanpham, s.tenSanPham, s.giaBan, s.src, k.giaTri, k.tenKhuyenMai, dg.star
        ORDER BY TongSoLuongBanDuoc DESC
        LIMIT ?, ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $start, $limit);
        $stmt->execute();
        $result = $stmt->get_result();
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
    public function getDsSPtheoLoai($category,$start,$limit ) {
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $start = intval($start);
        $limit = intval($limit);
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
        LIMIT ?, ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii", $category, $start, $limit);
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
    public function getDsSPtheoTen($name, $start,$limit ) {
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $start = intval($start);
        $limit = intval($limit);
        $sanphamList = array();
        $sql = "SELECT s.tenSanPham, s.giaBan, s.src, k.giaTri, k.background,SUM(cthd.soluong) AS TongSoLuongBanDuoc, k.tenKhuyenMai, dg.star, l.tenLoaiSP, k.hansudung 
        FROM sanpham s
        LEFT JOIN chitietkhuyenmai ctk ON s.id = ctk.idsanpham
        LEFT JOIN khuyenmai k ON ctk.idkhuyenmai = k.id
        LEFT JOIN danhgia dg ON s.id = dg.idsanpham
        LEFT JOIN chitiethoadon cthd ON s.id = cthd.idsanpham
        LEFT JOIN loaisp l ON s.idloaisp = l.id
        WHERE  s.tenSanPham LIKE ? 
        GROUP BY cthd.idsanpham, s.tenSanPham, s.giaBan, s.src, k.giaTri, k.tenKhuyenMai, dg.star
        ORDER BY TongSoLuongBanDuoc DESC
        LIMIT ?, ?";
        $stmt = $conn->prepare($sql);
        $name_param = "%" . $name . "%";
        $stmt->bind_param("sii", $name_param,$start, $limit);
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
    public function getDsSPtheoKhoangGia($from, $to,$start,$limit ) {
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $start = intval($start);
        $limit = intval($limit);
        $sanphamList = array();
        $sql = "SELECT s.tenSanPham, s.giaBan, s.src, k.giaTri, k.background,SUM(cthd.soluong) AS TongSoLuongBanDuoc, k.tenKhuyenMai, dg.star, l.tenLoaiSP, k.hansudung 
        FROM sanpham s
        LEFT JOIN chitietkhuyenmai ctk ON s.id = ctk.idsanpham
        LEFT JOIN khuyenmai k ON ctk.idkhuyenmai = k.id
        LEFT JOIN danhgia dg ON s.id = dg.idsanpham
        LEFT JOIN chitiethoadon cthd ON s.id = cthd.idsanpham
        LEFT JOIN loaisp l ON s.idloaisp = l.id
        WHERE  s.giaBan >= ? and s.giaBan < ? 
        GROUP BY cthd.idsanpham, s.tenSanPham, s.giaBan, s.src, k.giaTri, k.tenKhuyenMai, dg.star
        ORDER BY TongSoLuongBanDuoc DESC
        LIMIT ?, ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiii", $from, $to,$start, $limit);
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
