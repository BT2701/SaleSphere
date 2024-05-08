<?php 
class DonViTinhModel{
    public function getInstance(){
        require_once __DIR__.'\..\MODEL\Database.php';
    }
    public function getList() {
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $sql = "SELECT *
        FROM donvitinh;
        ";
        $result = $conn->query($sql);
        $dvt = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dvt[] = $row;
            }
        }
        $conn->close();
        return $dvt;
    }
}
?>