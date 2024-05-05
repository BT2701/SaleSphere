<?php
    class ProfileController{
        public function getInstance()
        {
            require_once __DIR__.'\..\MODEL\ProfileModel.php';
        }
        public function getDataForView()
        {
            if(isset($_SESSION['id'])&&$_SESSION['id']!="")
            {
                $id=$_SESSION['id'];
            }
            $this->getInstance();
            $profileModel= new ProfileModel();
            return $profileModel->getList($id);
        }
        public function getID_google($id){
            $this->getInstance();
            $profileModel= new ProfileModel();
            return $profileModel->GetIdByGoogle($id);
        }
        public function getTinhTrang_google($id){
            $this->getInstance();
            $profileModel= new ProfileModel();
            return $profileModel->GetTinhTrangByGoogle($id);
        }
        public function getID_facebook($id){
            $this->getInstance();
            $profileModel= new ProfileModel();
            return $profileModel->GetIdByFB($id);
        }
        public function getTinhTrang_facebook($id){
            $this->getInstance();
            $profileModel= new ProfileModel();
            return $profileModel->GetTinhTrangByFB($id);
        }
        public function GetTenById($id){
            $this->getInstance();
            $profileModel= new ProfileModel();
            return $profileModel->GettenByID($id);
        }
        public function GetAnhById($id){
            $this->getInstance();
            $profileModel= new ProfileModel();
            return $profileModel->getAnhByID($id);
        }
    }
?>