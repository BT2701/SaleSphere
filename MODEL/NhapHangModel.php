<?php
class NhapHangModel{
    public function getInstance(){
        require_once 'C:\xampp\htdocs\web2\MODEL\Database.php';
    }

    // KHU VỰC GIỎ HÀNG NHẬP
    public function themGioHangNhap($idSanPham, $idUser, $soLuong){
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        foreach($this->layDsGioHangNhap() as $item){
            if($item['idSanPham']==$idSanPham && $item['idUser']==$idUser){
                $sl=$item['soLuong'] + $soLuong;
                $result=$this->capNhatSoLuong($idSanPham, $idUser, $sl);
                return $result;
            }
        }
        $sql="INSERT INTO giohangnhap (idSanPham, idUser, soLuong) VALUES (?,?,?) ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii",$idSanPham, $idUser, $soLuong);
        $result=$stmt->execute();

        $conn->close();
        return $result;
    }
    public function laySoLuong($idSanPham, $idUser){
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $sql="SELECT soLuong FROM giohangnhap WHERE idSanPham= '$idSanPham' and idUser= '$idUser' ";
        $result = $conn->query($sql);
        $total=0;
        // Kiểm tra xem có kết quả nào không
        if ($result->num_rows > 0) {
            // Lặp qua từng dòng dữ liệu
            while($row = $result->fetch_assoc()) {
                $total= $row["soLuong"];
            }
        } 
        
        // Đóng kết nối
        $conn->close();
        return $total;
    }
    public function capNhatSoLuong($idSanPham, $idUser, $soLuong){
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $sql="UPDATE giohangnhap SET soLuong=? WHERE idSanPham=? AND idUser=? ";
        $stmt= $conn->prepare($sql);
        $stmt->bind_param("iii",$soLuong, $idSanPham, $idUser);
        $result=$stmt->execute();

        $conn->close();
        return $result;
    }
    public function xoaDong($idSanPham, $idUser){
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $sql="DELETE FROM giohangnhap WHERE idSanPham=? AND idUser=? ";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("ii",$idSanPham,$idUser);
        $result=$stmt->execute();
        $conn->close();
        return $result;
    }
    public function layDsGioHangNhap(){
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $sql="SELECT * FROM giohangnhap";
        $stmt=$conn->prepare($sql);
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
    public function clearGioHangNhap(){
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();   
        $sql="DELETE FROM giohangnhap";
        $stmt=$conn->prepare($sql);
        $result=$stmt->execute();
        $conn->close();
        return $result;
    }

    public function countGioHangNhap($idUser){
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $sql="SELECT COUNT(*) as total FROM giohangnhap WHERE idUser= '$idUser'";
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
    //1. KẾT THÚC GIỎ HÀNG NHẬP



    //2. KHU VỰC NHẬP HÀNG VÀ CHI TIẾT NHẬP HÀNG
    public function layDanhSachPhieuNhap(){

    }
    public function themPhieuNhap($id, $ngayNhap, $idUser, $tongTien){

    }
    public function themChiTietPhieuNhap($idPhieuNhap, $idSanPham, $soLuong){

    }
    public function themKiemKe($id, $ngayKiem){

    }
    public function themChiTietKiemKe($idKiemKe, $idSanPham, $soLuongTonKho){

    }
    //2. KẾT THÚC NHẬP HÀNG



    //3. KHU VỰC XEM LỊCH SỬ NHẬP HÀNG

    //3. KẾT THÚC LỊCH SỬ
}
?>