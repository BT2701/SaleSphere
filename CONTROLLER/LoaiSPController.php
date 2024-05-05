<?php
class LoaiSPController{
    public function getInstance(){
        require_once __DIR__.'\..\MODEL\LoaiSPModel.php';
    }
    public function getCategoryList(){
        $this->getInstance();
        $categoryModel = new LoaiSPModel();
        return $categoryModel->getList();
    }
}
?>