<?php
    
class SanPhamController {
    public $sanphamModel;
    public function getInstance(){
        require_once 'C:\xampp\htdocs\web2\MODEL\SanPhamModel.php';
        $this->sanphamModel= new SanPhamModel();
    }

    public function getDataForView() {
        $this->getInstance();
        return $this->sanphamModel->getSanPhamList();
    }
    public function getDataForViewNoiBac() {
        $this->getInstance();
        return $this->sanphamModel->getListSPNoiBac();
    }
    public function getDataForViewKhuyenMai() {
        $this->getInstance();
        return $this->sanphamModel->getListSPKhuyenMai();
    }
    public function getDsSPtheoLoai() {
        if (isset($_POST['category'])){
            $category = $_POST['category'];
            $this->getInstance();
            $list = $this->sanphamModel->getDsSPtheoLoai($category);
            $output='';
            if(isset($list) && !empty($list)) {
                foreach ($list as $sanpham) {
                    $output .= '<div class="product-gallery-content-product-item">';
                    $output .= '<img src="' . $sanpham['src'] . '" alt="">';
                    $output .= '<div class="product-gallery-content-product-text" >';
                    if ($sanpham['tenKhuyenMai'] != null && (strtotime($sanpham['hansudung']) > time() || strtotime($sanpham['hansudung']) == null)) {
                        if ($sanpham['background'] != null) {
                            $output .= '<li style="background-color:' . $sanpham['background'] . ';"><img src="/web2/STATIC/assets/icon-percent.webp" alt="">';
                            $output .= '<p>' . $sanpham['tenKhuyenMai'] . '</p>';
                            $output .= '</li>';
                        } else {
                            $output .= '<li style="background-color: #fcfcfc;"></li>';
                        }
                        $output .= '<li>' . $sanpham['tenSanPham'] . '</li>';
                        $output .= '<li>Online giá rẻ</li>';
                        $output .= '<li><a href="">' . $sanpham['giaBan'] . ' <sup>đ</sup></a><span>-';
                        $output .= $sanpham['giaTri'] != null ? $sanpham['giaTri'] : '0';
                        $output .= '%</span></li>';
                        $output .= '<li>';
                        if ($sanpham['giaTri'] != null) {
                            $value = $sanpham['giaBan'];
                            $khuyenmai = $sanpham['giaTri'];
                            $giaban = $value - $value * $khuyenmai / 100;
                            $output .= $giaban;
                        } else {
                            $output .= $sanpham['giaBan'];
                        }
                        $output .= ' <sup>đ</sup></li>';
                        $output .= '<li>';
                        if ($sanpham['star'] != null) {
                            for ($i = 0; $i < $sanpham['star']; $i++) {
                                $output .= '<i class="fa-solid fa-star" style="color: #FB6E2E;"></i>';
                            }
                        }
                        $output .= '</li>';
                        $output .= '<li>';
                        $output .= '<p style="color: gray;">Đã bán ';
                        $output .= $sanpham['TongSoLuongBanDuoc'] != null ? $sanpham['TongSoLuongBanDuoc'] : '0';
                        $output .= '</p>';
                        $output .= '</li>';
                    }
                    $output .= '</div>';
                    $output .= '</div>';
                }
            } else {
                $output .= "không có sản phẩm nào";
            }
    
            echo $output;
        }
    }
    
}
?>