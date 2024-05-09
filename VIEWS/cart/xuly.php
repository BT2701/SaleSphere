<?php

$connection = mysqli_connect("localhost", "root", "", "quan_ly_ban_hang");
//KHi nào có mã Khách hàng thì lấy thay vô
//  --------------------------------Xóa dữ liệu sản phẩm đang chọn-------------------------
// if (isset($_GET['delete']) && isset($_GET['nguoiDung']) && isset($_GET['idsanpham'])) {
//     $userid = $_GET['nguoiDung'];
//     $idsanpham = $_GET['idsanpham'];

//     $strSQL = "
//       DELETE FROM chitietgiohang
//       WHERE
//         chitietgiohang.userid= $userid  AND chitietgiohang.idsanpham= $idsanpham
//               ";

//     $result = mysqli_query($connection, $strSQL);
//     if ($result) {
//         $affectedRow = mysqli_affected_rows($connection);
//         if ($affectedRow > 0) {
//             header("Location: http://localhost/web2/VIEWS/cart/cart.php?deleteSuccessfully=true");
//         } else {
//             header("Location:http://localhost/web2/VIEWS/cart/cart.php?deleteSuccessfully=false ");
//         }
//     }
// }
// -------------------------------Cập nhật trạng thái đang chọn/ bỏ chọn --------------------------
// if (isset($_GET["userid"]) && isset($_GET["idsanpham"]) && isset($_GET["updateTrangThai"])) {

//     $userid = $_GET['userid'];
//     $idsanpham = $_GET['idsanpham'];
//     $valueTrangThai = $_GET['updateTrangThai'];

//     $strSQL = "
//         UPDATE chitietgiohang
//         SET 
//             chitietgiohang.trangThai=$valueTrangThai
//         WHERE
//         chitietgiohang.userid= $userid  AND chitietgiohang.idsanpham= $idsanpham
//           ";

//     // Thực thi câu lệnh
//     $result = mysqli_query($connection, $strSQL);
//     if ($result) {
//         $affectedRow = mysqli_affected_rows($connection);
//         if ($affectedRow > 0)

//             echo "Cập nhật thành công";
//         else {
//             echo "Lỗi khi cập nhật bản ghi: ";
//         }
//     }

// }

// -------------------reset trạng thái khi thoát khỏi trang-------------------
// if (isset($_GET["resetTrangThai"]) && isset($_GET["userid"])) {
//     $userid = $_GET['userid'];

//     $strSQL = "UPDATE chitietgiohang
//                    SET 
//                        chitietgiohang.trangThai = 0
//                    WHERE
//                        chitietgiohang.userid = $userid AND chitietgiohang.trangThai = 1";

//     $result = mysqli_query($connection, $strSQL);

//     // Kiểm tra kết quả truy vấn và hiển thị thông báo
//     if ($result) {
//         $affectedRows = mysqli_affected_rows($connection);
//         if ($affectedRows > 0) {
//             echo "Cập nhật thành công";
//         } else {
//             echo "Không có bản ghi nào được cập nhật";
//         }
//     } else {
//         echo "Lỗi khi thực hiện truy vấn: " . mysqli_error($connection);
//     }
// }
// --------------------------- update số lượng -----------------------------------
// if (isset($_GET["updateSoLuong"]) && isset($_GET["userid"]) && isset($_GET["idsanpham"]) && isset($_GET["soLuongMoi"])) {
//     $userid = $_GET['userid'];
//     $idsanpham = $_GET['idsanpham'];
//     $soLuongMoi = $_GET["soLuongMoi"];

//     $strSQL = "UPDATE chitietgiohang
//                    SET 
//                        chitietgiohang.soLuong = $soLuongMoi
//                    WHERE
//                        chitietgiohang.userid = $userid AND chitietgiohang.idsanpham= $idsanpham";
//     $result = mysqli_query($connection, $strSQL);

//     // Kiểm tra kết quả truy vấn và hiển thị thông báo
//     if ($result) {
//         $affectedRows = mysqli_affected_rows($connection);
//         if ($affectedRows > 0) {
//             echo "Cập nhật số lượng mới thành công";
//         } else {
//             echo "Không có bản ghi số lượng mới nào được cập nhật";
//         }
//     } else {
//         echo "Lỗi khi thực hiện truy vấn: " . mysqli_error($connection);
//     }
// }
// ------------------------------------------Thanh toán-------------------------------------------

// if (isset($_GET["thanhToan"]) && isset($_GET["userid"])) {
//     // 1/ Tạo hóa đơn
//     $selectedProductIDs= json_decode($_GET["selectedProductIDs"]);  
//     $idsString = implode(",", $selectedProductIDs);

//     $userid = $_GET["userid"];
//     $tongTien = $_GET["tongTien"];
//     $currentTime = date("Y-m-d");

//     $strSQL = "INSERT INTO hoadon( `ngayLap`, `idKhachHang`, `trangThai`, `tongTien`)
//                VALUES ('$currentTime', $userid, 1, $tongTien)";

//     $result = mysqli_query($connection, $strSQL);
//     if ($result) {
//         // Lấy ID của hóa đơn vừa tạo
//         $idHoaDon = mysqli_insert_id($connection);
//         if ($idHoaDon > 0) {
//             echo "Thêm hóa đơn mới thành công. ID hóa đơn: $idHoaDon";

//             // 2/ Tạo chi tiết hóa đơn
//             $strSQL1 = "SELECT * FROM chitietgiohang WHERE userid = $userid AND idsanpham IN ($idsString)";
//             $result1 = mysqli_query($connection, $strSQL1);
//             if (mysqli_num_rows($result1) > 0) {
//                 while ($row = mysqli_fetch_array($result1)) {
//                     $idSanPham = $row[0];
//                     $soLuong = $row[1];

//                     echo "" . $idSanPham . "" . $soLuong;
//                     // Thực hiện INSERT vào bảng chitiethoadon với idHoaDon vừa lấy được
//                     $strSQL2 = "INSERT INTO chitiethoadon(`idHoaDon`, `idSanPham`, `soLuong`)
//                                 VALUES ($idHoaDon, $idSanPham, $soLuong)";
//                     $result2 = mysqli_query($connection, $strSQL2);
//                     // Kiểm tra kết quả truy vấn INSERT vào bảng chitiethoadon
//                     if ($result2) {
//                         echo "Thêm chi tiết hóa đơn mới thành công";
//                         $strSQL3 = "SELECT * FROM chitiethoadon
//                         WHERE idHoaDon=$idHoaDon
//                         ";
//                         $result3 = mysqli_query($connection, $strSQL3);
//                         if (mysqli_num_rows($result3) > 0) {
//                             while ($row = mysqli_fetch_array($result3)) {
//                                 $idSanPham = $row[1];
//                                 $strSQL4 = "DELETE FROM chitietgiohang
//                                 WHERE userid=$userid AND idsanpham=$idSanPham
//                                 ";
//                                 $result4 = mysqli_query($connection, $strSQL4);
//                                 if ($result4) {
//                                     echo "Xóa chi tiết đặt hàng thành công!";
//                                     header("Location: http://localhost/web2/VIEWS/cart/cart.php");
//                                 }
//                             }
//                         } else {
//                             echo "Lỗi khi xóa chi tiết đặt hàng: " . mysqli_error($connection);
//                             break; 
//                         }

//                     } else {
//                         echo "Lỗi khi thêm chi tiết hóa đơn: " . mysqli_error($connection);
//                         break; 
//                     }
//                 }
//             }
//         } else {
//             echo "Không thể lấy ID của hóa đơn";
//         }
//     } else {
//         echo "Lỗi khi thực hiện truy vấn: " . mysqli_error($connection);
//     }
// }





?>