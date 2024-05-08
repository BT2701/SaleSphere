<?php



class InvoiceManagementModel
{

    public function getCartController()
    {
        require_once __DIR__ . '\..\..\web2\CONTROLLER\CartController.php';
        $cartController = new CartController();
        return $cartController;
    }
    public function getInstance()
    {
        require_once __DIR__ . '\..\MODEL\Database.php';
    }
    public function checkAll()
    {
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();

        $sql = " SELECT * FROM hoadon ";
        $result = $conn->query($sql);
        $invoiceList = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $invoiceList[] = $row;
            }
        }
        $conn->close();
        return $invoiceList;
    }
    public function checkPeriod($startDate, $endDate)
    {
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();

        $startDateFormatted = date('Y-m-d', strtotime($startDate));
        $endDateFormatted = date('Y-m-d', strtotime($endDate));

        $sql = "SELECT * FROM hoadon WHERE ngayLap >= '$startDateFormatted' AND ngayLap <= '$endDateFormatted'";
        $result = $conn->query($sql);
        $invoiceList = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $invoiceList[] = $row;
            }
        }
        $conn->close();
        return $invoiceList;
    }

    public function cancelOrder($invoiceId)
    {
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        //Nhớ cập nhật lại maNV
        // $maNV= $_SESSION['userid'];
        // $maNV=1;
        session_start();
        if (isset($_SESSION['id']) && $_SESSION['id'] != "") {
            $maNV = $_SESSION['id'];
        } else {
            $maNV = 0;
        }
        $sql = "UPDATE `hoadon` SET `idNV`='$maNV',`trangThai`= 4 WHERE id=$invoiceId";
        $result = $conn->query($sql);

        if ($result === true) {
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
    }
    public function confirmOrder($invoiceId)
    {
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        //Nhớ cập nhật lại maNV
        // $maNV= 1;
        session_start();
        if (isset($_SESSION['id']) && $_SESSION['id'] != "") {
            $maNV = $_SESSION['id'];
        }
        else{
            $maNV = 0;
        }

        $sql = "UPDATE `hoadon` SET `idNV`=$maNV,`trangThai`= 2 WHERE id=$invoiceId";
        $result = $conn->query($sql);

        if ($result === true) {
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
    }

    public function getInvoiceDetails($invoiceId)
    {
        $this->getInstance();
        $cartController = $this->getCartController();
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT sanpham.src, 
                            sanpham.id,
                            sanpham.tenSanPham,
                            sanpham.giaBan,
                            chitiethoadon.soLuong,
                            hoadon.ngayLap
                    FROM chitiethoadon
                    INNER JOIN sanpham ON chitiethoadon.idSanPham = sanpham.id 
                    INNER JOIN hoadon ON chitiethoadon.idHoaDon = hoadon.id
                    WHERE chitiethoadon.idHoaDon= $invoiceId";
        $result = $conn->query($sql);
        $invoiceDetailsList = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $khuyenmai = $cartController->getPromotionValue($row['id']);

                if (isset($khuyenmai) && !empty($khuyenmai)) {
                    $row['giaTriKhuyenMai'] = $khuyenmai[0]['giaTri']; // Giả sử chỉ có một giá trị khuyến mãi trả về
                } else {
                    $row['giaTriKhuyenMai'] = 0;
                }
                $invoiceDetailsList[] = $row;
            }
        }
        $conn->close();
        return $invoiceDetailsList;
    }

}


?>