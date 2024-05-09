<?php

class CartModel{
    
    public function getInstance(){
        require_once __DIR__.'\..\MODEL\Database.php';
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

     public function deleteMultipleProduct($userid, $listDeleteMultipleProduct){
        $this->getInstance();
        $db= new Database();
        $conn= $db->getConnection();
        $listProduct= implode(",", $listDeleteMultipleProduct);
        $sql = "DELETE FROM chitietgiohang WHERE userid = $userid AND idsanpham IN ($listProduct)";
        $result= $conn->query($sql);
        if ($result === true) {
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        } 
      }

    public function updateQuantity($userid, $idSanPham, $soLuongMoi){
      $this-> getInstance();
      $db= new Database();
      $conn= $db->getConnection();
      $sql = "UPDATE chitietgiohang
      SET 
          soluong = ?
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
  
          //Hàm truy vấn sản phẩm tồn kho
          $strCheck= "SELECT  chitietkiemke.idSanPham,
                              chitietkiemke.soLuongTonKho,
                              chitietgiohang.soluong,
                              sanpham.tenSanPham
                      FROM chitietkiemke
                      INNER JOIN chitietgiohang ON chitietkiemke.idSanPham=chitietgiohang.idsanpham
                      INNER JOIN sanpham ON sanpham.id=chitietkiemke.idSanPham
                      WHERE chitietgiohang.userid=$userid AND chitietkiemke.idSanPham IN ($idsString)";
  
          $result= mysqli_query($connection, $strCheck);
          $listSanPhamHetHang=array();
  
          if(mysqli_num_rows($result) > 0){
              while($row= mysqli_fetch_array($result)){
                  $tenSanPham= $row['tenSanPham'];
                  $idSanPham= $row['idSanPham'];
                  $soLuongTonKho= $row['soLuongTonKho'];
                  $soLuongDatHang= $row['soluong'];
                  if($soLuongTonKho<$soLuongDatHang){
                      $listSanPhamHetHang[] = array("idSanPham" => $idSanPham, "tenSanPham" => $tenSanPham);
                  }
              }
              if(!empty($listSanPhamHetHang)){
                  return $listSanPhamHetHang;
              }
          }
  
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
                              }
                          } else {
  
                              break; 
                          }
  
                      } else {
  
                          break; 
                      }
                      
                  }
                  $strSQL5= "SELECT* FROM chitiethoadon WHERE idHoaDon=$idHoaDon";
                  $result5= mysqli_query($connection, $strSQL5);
                  if (mysqli_num_rows($result5) > 0) {
                      while ($row = mysqli_fetch_array($result5)) {
                          $idSanPham= $row[1];
                          $soLuong = $row[2];
                          $strSQL6 = "UPDATE chitietkiemke SET soLuongTonKho= soLuongTonKho-$soLuong
                                      WHERE idSanPham= $idSanPham;
                                       ";
                          $result6 = mysqli_query($connection, $strSQL6);
                                
                          
                      }
                  }
  
                  return true; 
              }
          } 
          
          
          else {
              // echo "Không thể lấy ID của hóa đơn";
              return false;
          }
      } else {
          // echo "Lỗi khi thực hiện truy vấn: " . mysqli_error($connection);
          return false;
      }
    }

}
?>