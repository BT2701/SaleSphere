<?php
    
class SanPhamController {
    public function getInstance(){
        require_once 'C:\xampp\htdocs\web2\MODEL\SanPhamModel.php';
    }
    public function getDataForView() {
        $this->getInstance();
        $sanphamModel = new SanPhamModel();
        return $sanphamModel->getSanPhamList();
    }
    public function getDataForViewNoiBac() {
        $this->getInstance();
        $sanphamModel = new SanPhamModel();
        return $sanphamModel->getListSPNoiBac();
    }
}
?>