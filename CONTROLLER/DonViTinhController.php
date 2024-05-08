<?php
class DonViTinhController{
    public function getInstance(){
        require_once __DIR__.'\..\MODEL\DonViTinhModel.php';
    }
    public function getList(){
        $this->getInstance();
        $dvt = new DonViTinhModel();
        return $dvt->getList();
    }
}
?>