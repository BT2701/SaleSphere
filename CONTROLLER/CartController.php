<?php
     if(isset($_POST['action'])) {
        $action = $_POST['action'];
        switch($action){
            case 'deleteProduct':
                if(isset($_POST['userid']) && isset($_POST['idSanPham'])) {
                    $userid = $_POST['userid'];
                    $idSanPham = $_POST['idSanPham'];
        
                    $cartController= new CartController();
                    $result= $cartController->deleteProduct($userid, $idSanPham);
                    echo json_encode($result);
                } else {
                    // Trường hợp không có dữ liệu được gửi từ client
                    echo "Không có dữ liệu được gửi.";
                }
                break;
            case 'updateQuantity':
                if(isset($_POST['userid']) &&isset($_POST['idSanPham']) && isset($_POST['soLuongMoi'] )){
                    $userid = $_POST['userid'];
                    $idSanPham = $_POST['idSanPham'];
                    $soLuongMoi= $_POST['soLuongMoi'];
                    $cartController= new CartController();
                    $result= $cartController->updateQuantity($userid, $idSanPham, $soLuongMoi);
                    echo json_encode($result);
                } else {
                    // Trường hợp không có dữ liệu được gửi từ client
                    echo "Không có dữ liệu được gửi.";
                }
                break;
            case 'payProduct':
                if(isset($_POST['userid']) && isset($_POST['tongTien']) && isset($_POST['selectedProductIDs'])){
                    $userid = $_POST['userid'];
                    $tongTien= $_POST['tongTien'];
                    $selectedProductIDs= $_POST['selectedProductIDs'];
                    $cartController= new CartController();
                    $result=  $cartController->createInvoiceAndInvoiceDetails($userid, $tongTien, $selectedProductIDs);
                    echo json_encode($result);
                }   
        }
    
     }




    class CartController{
        public function getInstance(){
            require_once 'C:\xampp\htdocs\web2\MODEL\CartModel.php';
        }
        public function getCartList($userid) {
            $this->getInstance();
            $CartModel = new CartModel();
            return $CartModel->getCartList($userid);
        }
        public function getPromotionValue($idSanPham){
            $this->getInstance();
            $CartModel = new CartModel();
            return $CartModel->getPromotionValue($idSanPham);
        }

        public function  deleteProduct($iduser, $idSanPham){
            $this->getInstance();
            $CartModel = new CartModel();
            return $CartModel->deleteProduct($iduser, $idSanPham);
        }

        public function updateQuantity($userid, $idSanPham, $soLuongMoi){
            $this->getInstance();
            $CartModel = new CartModel();
            return $CartModel->  updateQuantity($userid, $idSanPham, $soLuongMoi);
        }
        public function createInvoiceAndInvoiceDetails($userid, $tongTien, $selectedProductIDs){
            $this->getInstance();
            $CartModel= new CartModel();
            return $CartModel-> createInvoiceAndInvoiceDetails($userid, $tongTien, $selectedProductIDs);
        }
    }   
   

?>