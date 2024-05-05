<?php 
class LoaiSPModel{
    public function getInstance(){
        require_once __DIR__.'\..\MODEL\Database.php';
    }
    public function getList() {
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $sql = "SELECT *
        FROM loaisp;
        ";
        $result = $conn->query($sql);
        $categoryList = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categoryList[] = $row;
            }
        }
        $conn->close();
        return $categoryList;
    }
}
?>