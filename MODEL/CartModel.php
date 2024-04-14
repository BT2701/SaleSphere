<?php

class CartModel{
    
    public function getInstance(){
        require_once 'C:\xampp\htdocs\web2\MODEL\Database.php';
    }

    public function getCartList($userid){
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "
          SELECT 
            sanpham.id,
            sanpham.tenSanPham,
            sanpham.src,
            sanpham.giaBan,
            chitietgiohang.soLuong,
            sanpham.moTa
          FROM
            chitietgiohang
          INNER JOIN
            sanpham ON chitietgiohang.idsanpham = sanpham.id
          WHERE
            chitietgiohang.userid = '$userid';
                  ";
         $result = $conn->query($sql);
         $cartList = array();
         if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cartList[] = $row;
            }
        }
        $conn->close();
        return $cartList;
    }

    public function getPromotionValue($idSanPham){
        $this->getInstance();
        $db = new Database();
        $conn = $db->getConnection();
        $sql=" SELECT khuyenmai.giaTri
        FROM chitietkhuyenmai
        INNER JOIN khuyenmai
        ON chitietkhuyenmai.idkhuyenmai= khuyenmai.id
        WHERE chitietkhuyenmai.idsanpham= $idSanPham
              ";
        $result = $conn->query($sql);
        $promotionList = array();
         if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $promotionList[] = $row;
            }
        }
        $conn->close();
        return $promotionList;
    }

    public function deleteProduct($userid, $idSanPham){
      $this->getInstance();
      $db= new Database();
      $conn= $db->getConnection();
      $sql = "DELETE FROM chitietgiohang WHERE userid = ? AND idsanpham = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ii", $userid, $idSanPham);
      $stmt->execute();
      if ($stmt->affected_rows > 0) {
        return true;
      }else 
        return false;
    }

    public function updateQuantity($userid, $idSanPham, $soLuongMoi){
      $this-> getInstance();
      $db= new Database();
      $conn= $db->getConnection();
      $sql = "UPDATE chitietgiohang
      SET 
          soLuong = ?
      WHERE
          userid = ? AND idsanpham= ?";
      $stmt= $conn->prepare($sql);
      $stmt->bind_param("iii", $soLuongMoi, $userid, $idSanPham);
      $stmt->execute();
      if ($stmt->affected_rows > 0) {
        return true;
      }else 
        return false;
    }
    public function createInvoiceAndInvoiceDetails($userid, $tongTien, $selectedProductIDs){
      $this->getInstance();
      $db = new Database();
      $connection = $db->getConnection();
      $idsString = implode(",", $selectedProductIDs);
      
      $currentTime = date("Y-m-d"); 
     
      // 1/ Tạo hóa đơn
      $strSQL = "INSERT INTO hoadon( `ngayLap`, `idKhachHang`, `trangThai`, `tongTien`)
               VALUES ('$currentTime', $userid, 1, $tongTien)";

    $result = mysqli_query($connection, $strSQL);
    if ($result) {
        // Lấy ID của hóa đơn vừa tạo
        $idHoaDon = mysqli_insert_id($connection);
        if ($idHoaDon > 0) {

            // 2/ Tạo chi tiết hóa đơn
            $strSQL1 = "SELECT * FROM chitietgiohang WHERE userid = $userid AND idsanpham IN ($idsString)";
            $result1 = mysqli_query($connection, $strSQL1);
            if (mysqli_num_rows($result1) > 0) {
                while ($row = mysqli_fetch_array($result1)) {
                    $idSanPham = $row[0];
                    $soLuong = $row[1];

                    // Thực hiện INSERT vào bảng chitiethoadon với idHoaDon vừa lấy được
                    $strSQL2 = "INSERT INTO chitiethoadon(`idHoaDon`, `idSanPham`, `soLuong`)
                                VALUES ($idHoaDon, $idSanPham, $soLuong)";
                    $result2 = mysqli_query($connection, $strSQL2);
                    // Kiểm tra kết quả truy vấn INSERT vào bảng chitiethoadon
                    if ($result2) {
                        $strSQL3 = "SELECT * FROM chitiethoadon
                        WHERE idHoaDon=$idHoaDon
                        ";
                        $result3 = mysqli_query($connection, $strSQL3);
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row = mysqli_fetch_array($result3)) {
                                $idSanPham = $row[1];
                                $strSQL4 = "DELETE FROM chitietgiohang
                                WHERE userid=$userid AND idsanpham=$idSanPham
                                ";
                                $result4 = mysqli_query($connection, $strSQL4);
                                    return true;
                                
                            }
                        } else {
                            break; 
                        }

                    } else {
                        break; 
                    }
                }
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
  }
  
  
  
}


?>