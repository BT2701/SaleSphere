<?php
    class PhanQuyenController{
        public function getInstance(){
            require_once __DIR__.'\..\MODEL\PhanQuyenModel.php';
        }
        public function getList(){
            $id=$_GET['id'];
            $this->getInstance();
            $phanquyenModel= new PhanQuyenModel();
            return $phanquyenModel->getChiTietQuyenById($id);
        }
        public function getListTenQuyen(){
            $this->getInstance();
            $phanquyenModel= new PhanQuyenModel();
            return $phanquyenModel->getTenQuyen();
        }
        public function getTenQuyenByid(){
            $id=$_GET['id'];
            $this->getInstance();
            $phanquyenModel= new PhanQuyenModel();
            return $phanquyenModel->getTenQuyenByID($id);
        }
        public function getListChucNang(){
            $this->getInstance();
            $phanquyenModel= new PhanQuyenModel();
            return $phanquyenModel->getlistChucnang();
        }
        public function delete(){
            $id=$_GET['id'];
            $this->getInstance();
            $phanquyenModel = new PhanQuyenModel();
            $phanquyenList= $phanquyenModel->getlistChucnang();
            if(isset($phanquyenList)&&!empty($phanquyenList))
                foreach($phanquyenList as $user1){
                    $phanquyenModel->deleteChiTietQuyen($phanquyenModel->getIdByHanhdong('T',$user1['id'],$id),$id,$user1['id']);
                    $phanquyenModel->deleteChiTietQuyen($phanquyenModel->getIdByHanhdong('S',$user1['id'],$id),$id,$user1['id']);
                    $phanquyenModel->deleteChiTietQuyen($phanquyenModel->getIdByHanhdong('X',$user1['id'],$id),$id,$user1['id']);
                }
            $result=$phanquyenModel->deleteQuyen($id);
            if($result)
            {
                echo "<script>window.location.href='/web2/VIEWS/admin/admin_home.php?page=quanLyPhanQuyen&msg=Xóa thành công!';</script>";
            }
        }
    }
    //$phanquyenController = new PhanQuyenController();
    if(isset($_GET['controller'])&&$_GET['controller']=='sua'){
    $id=$_POST['phanloai'];
    require_once __DIR__.'\..\MODEL\PhanQuyenModel.php';
    $phanquyenModel = new PhanQuyenModel();
    $phanquyenController= new PhanQuyenController();
    $phanquyenList=$phanquyenController->getListChucNang();
    if($phanquyenModel->checkIdtontai($id)==true){
        if(isset($phanquyenList)&&!empty($phanquyenList))
            foreach($phanquyenList as $user1){
                $id1=$phanquyenModel->GetIdmoinhat();
                $phanquyenModel->insertPhanQuyenvoiTinhTrang($id1,$id,$user1['id'],'T',0);
                $id1=$phanquyenModel->GetIdmoinhat();
                $phanquyenModel->insertPhanQuyenvoiTinhTrang($id1,$id,$user1['id'],'S',0);
                $id1=$phanquyenModel->GetIdmoinhat();
                $phanquyenModel->insertPhanQuyenvoiTinhTrang($id1,$id,$user1['id'],'X',0);
            }
        header("Location: /web2/VIEWS/admin/admin_home.php?page=quanLyPhanQuyen&chon=sua&&id=$id");
    }else
    {
        header("Location: /web2/VIEWS/admin/admin_home.php?page=quanLyPhanQuyen&chon=sua&&id=$id");
    }
    }
    if(isset($_GET['controller'])&&$_GET['controller']=='them'){
        $username=$_POST['username'];
        require_once __DIR__.'\..\MODEL\PhanQuyenModel.php';
        $phanquyenModel = new PhanQuyenModel();
        $result= $phanquyenModel->insesrtQuyen($username);
        if($result){
            header("Location: /web2/VIEWS/admin/admin_home.php?page=quanLyPhanQuyen&msg=Thêm quyền thành công!");
        }
    }
    if(isset($_GET['controller'])&&$_GET['controller']=='suaDetail'){
        $username=$_POST['username'];
        $phanquyenController= new PhanQuyenController();
        $phanquyenList=$phanquyenController->getListChucNang();
        
        require_once __DIR__.'\..\MODEL\PhanQuyenModel.php';
        $phanquyenModel= new  PhanQuyenModel();
        $phanquyenModel->updateTenQuyenById($_GET['id'],$username);
        if(isset($phanquyenList)&&!empty($phanquyenList))
        foreach($phanquyenList as $user1){
        if(isset($_POST['hanhdong'.$user1['id']])){
        $mang=$_POST["hanhdong".$user1['id']];
            if($mang==['S','X'])
                {
                    $result=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('T',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],0);
                    $result1=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('S',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],1);
                    $result2=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('X',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],1);
                    if($result&&$result1&&$result2)
                    {
                        header("Location: /web2/VIEWS/admin/admin_home.php?page=quanLyPhanQuyen&msg=Sửa thành công!");
                    }
                }  
                if($mang==['T','X'])
                {
                    $result=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('T',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],1);
                    $result1=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('S',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],0);
                    $result2=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('X',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],1);
                    if($result&&$result1&&$result2)
                    {
                        header("Location: /web2/VIEWS/admin/admin_home.php?page=quanLyPhanQuyen&msg=Sửa thành công!");
                    }
                }  
                if($mang==['S','X'])
                {
                    $result=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('T',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],0);
                    $result1=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('S',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],1);
                    $result2=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('X',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],1);
                    if($result&&$result1&&$result2)
                    {
                        header("Location: /web2/VIEWS/admin/admin_home.php?page=quanLyPhanQuyen&msg=Sửa thành công!");
                    }
                }  
                if($mang==['T','S','X'])
                {
                    $result=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('T',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],1);
                    $result1=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('S',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],1);
                    $result2=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('X',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],1);
                    if($result&&$result1&&$result2)
                    {
                        header("Location: /web2/VIEWS/admin/admin_home.php?page=quanLyPhanQuyen&msg=Sửa thành công!");
                    }
                }  
                if($mang==['T'])
                {
                    $result=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('T',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],1);
                    $result1=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('S',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],0);
                    $result2=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('X',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],0);
                    if($result&&$result1&&$result2)
                    {
                        header("Location: /web2/VIEWS/admin/admin_home.php?page=quanLyPhanQuyen&msg=Sửa thành công!");
                    }
                }  
                if($mang==['S'])
                {
                    $result=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('T',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],0);
                    $result1=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('S',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],1);
                    $result2=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('X',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],0);
                    if($result&&$result1&&$result2)
                    {
                        header("Location: /web2/VIEWS/admin/admin_home.php?page=quanLyPhanQuyen&msg=Sửa thành công!");
                    }
                }  
                if($mang==['X'])
                {
                    $result=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('T',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],0);
                    $result1=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('S',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],0);
                    $result2=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('X',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],1);
                    if($result&&$result1&&$result2)
                    {
                        header("Location: /web2/VIEWS/admin/admin_home.php?page=quanLyPhanQuyen&msg=Sửa thành công!");
                    }
                }  
        }
        else
        {
            $mang=[0,0,0];
            $result=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('T',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],0);
            $result1=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('S',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],0);
            $result2=$phanquyenModel->updatePhanQuyenvoiTinhtrangHanhdongThem($phanquyenModel->getIdByHanhdong('X',$user1['id'],$_GET['id']),$user1['id'],$_GET['id'],0);
            if($result&&$result1&&$result2)
            {
                header("Location: /web2/VIEWS/admin/admin_home.php?page=quanLyPhanQuyen&msg=Sửa thành công!");
            }
        }
    }
    }
?>