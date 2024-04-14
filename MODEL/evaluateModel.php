<?php
    class evaluateModel{
        public function getInstance(){
            require_once 'C:\xampp\htdocs\web2\MODEL\Database.php';
        }
        function GetSanPhamDanhGia($id){
            $this->getInstance();
            $db = new Database();
            $conn = $db->getConnection();
            $sql = "SELECT id, tenSanPham, giaBan, src, moTa
            FROM sanpham 
            WHERE  id=$id;
            ";
             $result = $conn->query($sql);
             $sanpham = array();
             if ($result->num_rows > 0) {
                $sanpham = $result->fetch_assoc(); // Gán dữ liệu sản phẩm vào biến
            }
             $conn->close();
             return $sanpham;
        }
        function AddEvalute($idSanPham,$noiDung,$Star,$idKhachHang,$idHoaDon){
            $this->getInstance();
            $db = new Database();
            $conn = $db->getConnection();
            $sql = "INSERT INTO `danhgia`(`idsanpham`, `noidung`, `star`, `idkhachhang`, `idhoadon`,`ngaydanhgia`) 
            VALUES ('$idSanPham','$noiDung','$Star','$idKhachHang','$idHoaDon',CURRENT_DATE())
            ";
            $result = $conn->query($sql);
            // Kiểm tra kết quả và trả về giá trị tương ứng
            if ($result) {
                // Thêm dữ liệu thành công
                $conn->close();
                return true;
            } else {
                // Xảy ra lỗi khi thêm dữ liệu
                $conn->close();
                return false;
            }
        }
    }
?>