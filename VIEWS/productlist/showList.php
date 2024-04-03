

<?php
    require_once 'C:\xampp\htdocs\web2\CONTROLLER\LoaiSPController.php';
    $categoryController = new LoaiSPController();
    $categoryList = $categoryController->getCategoryList();

    
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
            if($page == 'productlist') {
                include 'VIEWS/productlist/productlist.php';
            } else{
                for ($i =0; $i <count($categoryList);$i++){
                    if($page == 'producttype'.$i) {
                        include 'VIEWS/productlist/danhSachSanPhamTheoLoai.php';
                    }
            }
            }
            
        } else {
            // Mặc định khi không có tham số, hiển thị trang home.php
            include 'VIEWS/productlist/productlist.php';
        }
    

?>