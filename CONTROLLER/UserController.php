<?php
    class UserController{
        public function getInstance()
        {
            require_once 'C:\xampp\htdocs\web2\MODEL\UserModel.php';
        }
        public function getDataForView(){
                $this->getInstance();
                $usermodel= new UserModel();
                return $usermodel->getAll();
                
        }
        public function getList(){
            $id=$_GET['id'];
            $this->getInstance();
            $usermodel= new UserModel();
            return $usermodel->getListByID($id);
        }
        public function insert(){
            $ten=$_POST['username'];
            $mail=$_POST['email'];
            $phone=$_POST['phone_number'];
            $pass=$_POST['password'];
            if($_POST['cbstate']=='Action'){
                $state=1;
            }
            else
            {
                $state=0;
            }
            $maquyen=$_POST['PhanQuyen'];
            $this->getInstance();
            $usermodel= new UserModel;
            $result= $usermodel->insertUser($ten,$pass,$mail,$phone,$state,$maquyen);
            if($result)
            {
                header('Location: /web2/VIEWS/ADMIN/user/user.php?msg=Thêm thành công!');
            }
            else
            {
                echo "Failed";
            }
        }
        public function update(){
            $id=$_GET['id'];
            $ten=$_POST['username'];
            $mail=$_POST['email'];
            $phone=$_POST['phone_number'];
            $pass=$_POST['password'];
            if($_POST['cbstate']=='Action'){
                $state=1;
            }
            else
            {
                $state=0;
            }
            $maquyen=$_POST['PhanQuyen'];
            $this->getInstance();
            $usermodel= new UserModel;
            $result= $usermodel->updateUser($id,$ten,$mail,$pass,$phone,$state,$maquyen);
            if($result)
            {
                header('Location: /web2/VIEWS/ADMIN/user/user.php?msg=Sửa thành công!');
            }
            else
            {
                echo "Failed";
            }
            
        }
        public function delete(){
            $id=$_GET['id'];
            $this->getInstance();
            $usermodel= new UserModel;
            $result= $usermodel->deleteUser($id);
            if($result)
            {
                header('Location: /web2/VIEWS/ADMIN/user/user.php?msg=Xóa thành công!');
            }
            else
            {
                echo "Failed";
            }
        }
    }
    $userController= new UserController();
    if(isset($_GET['controller'])&&$_GET['controller']=='sua'){
        $userController->update();
    }
    if(isset($_GET['controller'])&&$_GET['controller']=='them'){
        $userController->insert();
    }
    

?>
