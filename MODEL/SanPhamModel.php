<?php
    
class SanPhamModel {
    public function getInstance(){
        require_once 'C:\xampp\htdocs\web2\MODEL\Database.php';
    }
    public function getSanPhamList() {
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $sql = "SELECT * FROM sanpham";
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
}

?>
