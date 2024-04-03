<?php
class LoaiSPController{
    public function getInstance(){
        require_once 'C:\xampp\htdocs\web2\MODEL\LoaiSPModel.php';
    }
    public function getCategoryList(){
        $this->getInstance();
        $categoryModel = new LoaiSPModel();
        return $categoryModel->getList();
    }
}
?>