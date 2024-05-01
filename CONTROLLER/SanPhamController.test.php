<?php
     function getInstance(){
        require_once 'C:\xampp\htdocs\web2\MODEL\SanPhamModel.php';
    }
    // ---------------------DU---------------------
    //LẤY CHI TIẾT SẢN PHẨM
     function detailProduct($productID) {
        getInstance();
        $sanphamModel = new SanPhamModel();
        return $sanphamModel->getProductDetail($productID);
    }

     function quantityProduct($productID){
        getInstance();
        $sanPhamModel = new SanPhamModel();
        $soLuongTonKho = $sanPhamModel->getQuantityInventoryProduct($productID);
        if($soLuongTonKho !== null){
            return $soLuongTonKho['soLuongTonKho'];
        }
        return 0;
    }

    //LẤY SỐ LƯỢNG SẢN PHẨM ĐÃ ĐƯỢC BÁN
     function quantityOfProductsSold($productID){
        getInstance();
        $sanPhamModel = new SanPhamModel();
        $soLuongDaBan = $sanPhamModel->getQuantityOfProductsSold($productID);
        if($soLuongDaBan['soLuongDaBan'] == null){
            return 0;
        }
        return $soLuongDaBan['soLuongDaBan'];
    }

    //LẤY TỔNG SỐ LƯỢNG SAO SẢN PHẨM ĐƯỢC ĐÁNH GIÁ 
     function avgOfStarEvaluate($productID){
        getInstance();
        $sanPhamModel = new SanPhamModel();
        $soLuongSao = $sanPhamModel->getAvgOfStarEvaluate($productID);
        return $soLuongSao['tongSoSao'];
    }

     function countOfEvaluate($productID,$soSao){
        getInstance();
        $sanPhamModel = new SanPhamModel();
        $soLuongDanhGia = $sanPhamModel->getCountOfEvaluate($productID,$soSao);
        return $soLuongDanhGia;
    }

    //LẤY THÔNG TIN KHUYẾN MÃI
     function sumOfValueDiscount($productID){
        getInstance();
        $sanPhamModel = new SanPhamModel();
        $giaTriKhuyenMai = $sanPhamModel->getInfoDiscount($productID);
        return $giaTriKhuyenMai;
    }


     function GetAllProduct(){
        getInstance();
        $sanPhamModel = new SanPhamModel();
        $Products = $sanPhamModel->GetALlProduct();
        return $Products;
    }
    // ---------------------DU--------------------