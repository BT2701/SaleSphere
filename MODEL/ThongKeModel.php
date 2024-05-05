<?php
    class ThongKeModel{
        public function getInstance(){
            require_once __DIR__.'\..\MODEL\Database.php';
        }
        function GetThongTinHeader($Month,$Year){
            $this->getInstance();
            $db = new Database();
            $conn = $db->getConnection();
            // Biến lưu trữ kết quả
            $result = array();

            // Tính tổng số đơn hàng
            $sql_orders = "SELECT COUNT(id) AS total_orders 
                        FROM hoadon 
                        WHERE MONTH(ngayLap) = $Month AND YEAR(ngayLap) = $Year";
            $result_orders = $conn->query($sql_orders);
            $row_orders = $result_orders->fetch_assoc();
            $result['total_orders'] = $row_orders['total_orders'];

            // Tính tổng số sản phẩm đã bán
            $sql_products_sold = "SELECT SUM(soLuong) AS total_products_sold 
                                FROM chitiethoadon 
                                WHERE idHoaDon IN (
                                    SELECT id 
                                    FROM hoadon 
                                    WHERE MONTH(ngayLap) = $Month AND YEAR(ngayLap) = $Year
                                )";
            $result_products_sold = $conn->query($sql_products_sold);
            $row_products_sold = $result_products_sold->fetch_assoc();
            $result['total_products_sold'] = $row_products_sold['total_products_sold'];

            // Tính tổng doanh thu
            $sql_revenue = "SELECT SUM(tongTien) AS total_revenue 
                            FROM hoadon 
                            WHERE MONTH(ngayLap) = $Month AND YEAR(ngayLap) = $Year";
            $result_revenue = $conn->query($sql_revenue);
            $row_revenue = $result_revenue->fetch_assoc();
            $result['total_revenue'] = $row_revenue['total_revenue'];

            // Tính số đánh giá tốt
            $sql_good_reviews = "SELECT COUNT(*) AS total_good_reviews
            FROM danhgia
            INNER JOIN hoadon ON danhgia.idhoadon = hoadon.id
            WHERE MONTH(hoadon.ngayLap) = $Month AND YEAR(hoadon.ngayLap) = $Year
            AND star >= 4"; // Điều kiện rating >= 4 có thể được điều chỉnh tùy theo định nghĩa cụ thể của "đánh giá tốt"
            $result_good_reviews = $conn->query($sql_good_reviews);
            $row_good_reviews = $result_good_reviews->fetch_assoc();
            $result['total_good_reviews'] = $row_good_reviews['total_good_reviews'];

            // Đóng kết nối
            $conn->close();
            // Trả về kết quả dưới dạng JSON
            return $result;
        }
        public function GetDailyRevenueData($Month, $Year) {
            $this->getInstance();
            $db = new Database();
            $conn = $db->getConnection();
            $result = array();
            // Truy vấn dữ liệu từ cơ sở dữ liệu
            $sql = "SELECT ngayLap, SUM(tongTien) AS revenue FROM hoadon WHERE MONTH(ngayLap) = $Month AND YEAR(ngayLap) = $Year GROUP BY ngayLap";
            $query = $conn->query($sql);
            while ($row = $query->fetch_assoc()) {
                $result[] = $row;
            }
            $conn->close();
            return $result;
        }
        public function GetAllLoaiSanPham($Month, $Year) {
            $this->getInstance();
            $db = new Database();
            $conn = $db->getConnection();
            $result = array();
        
            // Truy vấn dữ liệu từ cơ sở dữ liệu
            $sql = "SELECT DISTINCT loaisp.id, loaisp.tenLoaiSP
                    FROM sanpham 
                    INNER JOIN loaisp ON sanpham.idLoaiSP = loaisp.id 
                    INNER JOIN chitiethoadon ON sanpham.id = chitiethoadon.idSanPham 
                    INNER JOIN hoadon ON chitiethoadon.idHoaDon = hoadon.id 
                    WHERE MONTH(hoadon.ngayLap) = $Month AND YEAR(hoadon.ngayLap) = $Year";
            $query = $conn->query($sql);
            while ($row = $query->fetch_assoc()) {
                // Lưu cả id và tên loại sản phẩm vào mảng kết quả
                $result[] = array(
                    'id' => $row['id'],
                    'tenLoaiSP' => $row['tenLoaiSP']
                );
            }
            $conn->close();
        
            // Trả về kết quả
            return $result;
        }

        public function GetTopSellingProducts($Month, $Year, $productType) {
            $this->getInstance();
            $db = new Database();
            $conn = $db->getConnection();
        
            // Khởi tạo phần điều kiện WHERE cho loại sản phẩm
            $productTypeCondition = '';
        
            // Nếu $productType khác 'all', thêm điều kiện WHERE cho loại sản phẩm
            if ($productType != 'all') {
                $productTypeCondition = "AND sanpham.idLoaiSP = $productType";
            }
        
            // Truy vấn dữ liệu từ cơ sở dữ liệu với điều kiện WHERE cho tháng, năm và loại sản phẩm
            $sql = "SELECT sanpham.tenSanPham, sanpham.giaBan, SUM(chitiethoadon.soLuong) AS total_sold
                    FROM sanpham
                    INNER JOIN chitiethoadon ON sanpham.id = chitiethoadon.idSanPham
                    INNER JOIN hoadon ON chitiethoadon.idHoaDon = hoadon.id
                    WHERE MONTH(hoadon.ngayLap) = $Month AND YEAR(hoadon.ngayLap) = $Year
                    $productTypeCondition
                    GROUP BY sanpham.id
                    ORDER BY total_sold DESC
                    LIMIT 10";
        
            $result = $conn->query($sql);
        
            $topSellingProducts = array();
        
            // Lặp qua kết quả và lưu vào mảng
            while ($row = $result->fetch_assoc()) {
                $product = array(
                    'tenSanPham' => $row['tenSanPham'],
                    'giaBan' => $row['giaBan'],
                    'total_sold' => $row['total_sold']
                );
                $topSellingProducts[] = $product;
            }
        
            // Đóng kết nối
            $conn->close();
        
            // Trả về danh sách top 10 sản phẩm bán chạy
            return $topSellingProducts;
        }



        //------------------------------------------------------------------------------------------------------------------------//
        //Lấy dữ liệu cho DateTimePicker
        public function GetThongTinHeaderByDateRange($fromDate, $toDate){
            $this->getInstance();
            $db = new Database();
            $conn = $db->getConnection();
            $result = array();
        
            // Tính tổng số đơn hàng
            $sql_orders = "SELECT COUNT(id) AS total_orders 
                        FROM hoadon 
                        WHERE ngayLap BETWEEN '$fromDate' AND '$toDate'";
            $result_orders = $conn->query($sql_orders);
            $row_orders = $result_orders->fetch_assoc();
            $result['total_orders'] = $row_orders['total_orders'];
        
            // Tính tổng số sản phẩm đã bán
            $sql_products_sold = "SELECT SUM(soLuong) AS total_products_sold 
                                FROM chitiethoadon 
                                WHERE idHoaDon IN (
                                    SELECT id 
                                    FROM hoadon 
                                    WHERE ngayLap BETWEEN '$fromDate' AND '$toDate'
                                )";
            $result_products_sold = $conn->query($sql_products_sold);
            $row_products_sold = $result_products_sold->fetch_assoc();
            $result['total_products_sold'] = $row_products_sold['total_products_sold'];
        
            // Tính tổng doanh thu
            $sql_revenue = "SELECT SUM(tongTien) AS total_revenue 
                            FROM hoadon 
                            WHERE ngayLap BETWEEN '$fromDate' AND '$toDate'";
            $result_revenue = $conn->query($sql_revenue);
            $row_revenue = $result_revenue->fetch_assoc();
            $result['total_revenue'] = $row_revenue['total_revenue'];
        
            // Tính số đánh giá tốt
            $sql_good_reviews = "SELECT COUNT(*) AS total_good_reviews
            FROM danhgia
            INNER JOIN hoadon ON danhgia.idhoadon = hoadon.id
            WHERE ngayLap BETWEEN '$fromDate' AND '$toDate'
            AND star >= 4"; // Điều kiện rating >= 4 có thể được điều chỉnh tùy theo định nghĩa cụ thể của "đánh giá tốt"
            $result_good_reviews = $conn->query($sql_good_reviews);
            $row_good_reviews = $result_good_reviews->fetch_assoc();
            $result['total_good_reviews'] = $row_good_reviews['total_good_reviews'];
        
            // Đóng kết nối
            $conn->close();
            // Trả về kết quả dưới dạng JSON
            return $result;
        }
        
        public function GetAllLoaiSanPhamByDateRange($fromDate, $toDate) {
            $this->getInstance();
            $db = new Database();
            $conn = $db->getConnection();
            $result = array();
        
            // Truy vấn dữ liệu từ cơ sở dữ liệu
            $sql = "SELECT DISTINCT loaisp.id, loaisp.tenLoaiSP
                    FROM sanpham 
                    INNER JOIN loaisp ON sanpham.idLoaiSP = loaisp.id 
                    INNER JOIN chitiethoadon ON sanpham.id = chitiethoadon.idSanPham 
                    INNER JOIN hoadon ON chitiethoadon.idHoaDon = hoadon.id 
                    WHERE ngayLap BETWEEN '$fromDate' AND '$toDate'";
            $query = $conn->query($sql);
            while ($row = $query->fetch_assoc()) {
                // Lưu cả id và tên loại sản phẩm vào mảng kết quả
                $result[] = array(
                    'id' => $row['id'],
                    'tenLoaiSP' => $row['tenLoaiSP']
                );
            }
            $conn->close();
        
            // Trả về kết quả
            return $result;
        }
        
        public function GetTopSellingProductsByDateRange($fromDate, $toDate, $productType) {
            $this->getInstance();
            $db = new Database();
            $conn = $db->getConnection();
        
            // Khởi tạo phần điều kiện WHERE cho loại sản phẩm
            $productTypeCondition = '';
        
            // Nếu $productType khác 'all', thêm điều kiện WHERE cho loại sản phẩm
            if ($productType != 'all') {
                $productTypeCondition = "AND sanpham.idLoaiSP = $productType";
            }
        
            // Truy vấn dữ liệu từ cơ sở dữ liệu với điều kiện WHERE cho tháng, năm và loại sản phẩm
            $sql = "SELECT sanpham.tenSanPham, sanpham.giaBan, SUM(chitiethoadon.soLuong) AS total_sold
                    FROM sanpham
                    INNER JOIN chitiethoadon ON sanpham.id = chitiethoadon.idSanPham
                    INNER JOIN hoadon ON chitiethoadon.idHoaDon = hoadon.id
                    WHERE ngayLap BETWEEN '$fromDate' AND '$toDate'
                    $productTypeCondition
                    GROUP BY sanpham.id
                    ORDER BY total_sold DESC
                    LIMIT 10";
        
            $result = $conn->query($sql);
        
            $topSellingProducts = array();
        
            // Lặp qua kết quả và lưu vào mảng
            while ($row = $result->fetch_assoc()) {
                $product = array(
                    'tenSanPham' => $row['tenSanPham'],
                    'giaBan' => $row['giaBan'],
                    'total_sold' => $row['total_sold']
                );
                $topSellingProducts[] = $product;
            }
        
            // Đóng kết nối
            $conn->close();
        
            // Trả về danh sách top 10 sản phẩm bán chạy
            return $topSellingProducts;
        }        
        
    }


?>