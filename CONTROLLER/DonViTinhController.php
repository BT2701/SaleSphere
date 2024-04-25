<?php
class DonViTinhController{
    public function getInstance(){
        require_once 'C:\xampp\htdocs\web2\MODEL\DonViTinhModel.php';
    }
    public function getList(){
        $this->getInstance();
        $dvt = new DonViTinhModel();
        return $dvt->getList();
    }
}
?>