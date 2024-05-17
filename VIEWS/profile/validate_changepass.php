<?php
    require __DIR__.'\..\..\MODEL\Database.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id1=$_POST['IdProfile'];
        $passhientai=$_POST['Oldpass'];
        $passmoi=$_POST['Newpass'];
        $cpassmoi=$_POST['cNewpass'];

        $errors=array();
        if (empty($passhientai)) {
            $errors['username6'] = 'Mật khẩu hiện tại không được để trống';
        }
        if (!preg_match("/^.*(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&*()-]).*$/", $passmoi)) {
            $errors['password7'] = 'Mật khẩu mới phải chứa ít nhất 1 chữ thường, 1 chữ hoa, 1 ký tự đặc biệt (@#$%^&*()-), 1 chữ số';
        }
        if (strlen($passmoi) <= 12) {
            $errors['password8'] = 'Mật khẩu mới ít nhất phải có 12 kí tự';
        }
        if (empty($passmoi)) {
            $errors['password9'] = 'Mật khẩu mới không được để trống';
        }
        if ($passmoi != $cpassmoi) {
            $errors['cPassword10'] = 'Mật khẩu không khớp';
        }
        $sql = "Select matKhau from taikhoan where id='$id1'";
        $db = new Database();
        $conn = $db->getConnection();
        $result = mysqli_query($conn, $sql);

       if($result&&mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            if ($passhientai!=$row['matKhau']) {
                $errors['username5'] = 'Mật khẩu hiện tại không khớp. VUI LÒNG THỬ LẠI!';
            }
        }
    
        if(empty($errors)){
            $response= array(
                'success'=> true
            );
        } else{
            $response = array(
                'success' => false,
                'errors' => $errors
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

   
?>