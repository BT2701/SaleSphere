<?php
    session_start();
    require_once 'C:\xampp\htdocs\web2\CONTROLLER\ProfileController.php';
    $profileController= new ProfileController();
    $profileList = $profileController->getDataForView();

    $user="";
    $id=1;
    if(isset($_SESSION['login_name'])&&$_SESSION['login_name']!=''){
        $user=$_SESSION['login_name'];
    }
    if(isset($_SESSION['id'])&&$_SESSION['id']!=''){
        $id=$_SESSION['id'];
    }
    if($user!=""){
        $taikhoan='<li><a href="/web2/VIEWS/profile/profile.php">Tài khoản</a></li>';
        $changepass='';
        $logout=' <li><a href="/web2/VIEWS/sign_up/logout.php">Đăng xuất</a></li>';
    }
    else{
        $taikhoan='<li><a href="/web2/VIEWS/profile/profile.php">Tài khoản</a></li>';
        $changepass='<li><a href="/web2/VIEWS/profile/change_password.php">Đổi mật khẩu</a></li>';
        $logout=' <li><a href="/web2/VIEWS/sign_up/logout.php">Đăng xuất</a></li>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/web2/STATIC/css/profile.css">
    <title>Document</title>
</head>
<body>
    <div class="main">
        <div class="header">
            <div class="MyLogo">
              <a class="LinkTrangChu" href="/web2/index.php">
              <img src="/web2/STATIC/assets/banner.jpg" class="img-fluid" style="width: 150px;">
              </a>
              <div class="namepage" style="font-size: 1.5rem; padding: 15px; font-family: 'Roboto'; font-size: 30px;">SHOPPEE</div>
            </div>
            <div class="navbar">
                <ul style="font-size: 20px;">
                    <li>
                        <a href="#"><i class="fa-solid fa-earth-americas"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa-solid fa-message"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa-regular fa-bell"></i></a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-regular fa-user"></i>
                        </a>
                        <ul class="subnav">
                            <?=$taikhoan?>
                            <?=$changepass?>
                            <?=$logout?>
                        </ul>
                    </li>
                </ul>
            </div>
          </div>
          <div class="mid">
            <h1>Tài khoản của tôi</h1>
            <p class="inf">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
            <hr>
            <div class="content">
            <?php if(isset($profileList)&&!empty($profileList)) ?>
             <?php foreach($profileList as $profile): ?>
                <div class="left_box">
                        <div class="content_img" style="display: flex; flex-direction: column;">
                            <img class="img_avatar" style="border-radius: 100%;" src="<?php if($profile['src']=='0'||$profile['src']==''){echo '/web2/STATIC/assets/default_avatar_1.jpg';} else {echo $profile['src'];} ?>" alt="">
                        </div>
                </div>
                <div class="right_box">
                <form action="/web2/CONTROLLER/ProfileController1.php" method="post" name="MyForm" id="myform">
                        <table>
                            <tr>
                                <td class="row_lbusername">
                                    <label class="lbusername">Tên đăng nhập</label>
                                </td>
                                <td class="row_txtusername">
                                    <div class="txtusername">
                                        <?php echo $profile['ten']; ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="row_lbemail">
                                    <label class="lbemail">Email</label>
                                </td>
                                <td class="row_txtemail">
                                    <div class="txtemail">
                                    <?php if($profile['email']=='0') {echo "Chưa cập nhật";} else {echo $profile['email'];}  ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="row_lbnumber">
                                    <label class="lbnumber">Số điện thoại</label>
                                </td>
                                <td class="row_txtnumber">
                                    <div class="txtnumber">
                                    <?php if($profile['sdt']=='0'){echo "Chưa cập nhật";} else {echo $profile['sdt'];} ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="row_lbgender">
                                    <label class="lbgender">Giới tính</label>
                                </td>
                                <td class="row_cbgender">
                                    <div class="cbmale">
                                    <?php echo $profile['gender']; ?>
                                    </div>
                                    <!-- <div class="cbfemale">
                                        Nữ
                                    </div> -->
                                </td>
                            </tr>
                            <tr>
                                <td class="row_lbdob">
                                    <label class="lbdob">Ngày sinh</label>
                                </td>
                                <td class="row_txtdob">
                                    <div class="txtdob">
                                    <?php if(date("d/m/Y",strtotime($profile['dob']))=='01/01/1970'||date("d/m/Y",strtotime($profile['dob']))=='30/11/-0001'||date("d/m/Y",strtotime($profile['dob']))=='00/00/0000'){echo "Chưa cập nhật";} else{ echo date("d/m/Y",strtotime($profile['dob']));} ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="row_lbaddress">
                                    <label class="lbaddress">Địa chỉ</label>
                                </td>
                                <td class="row_txtaddress">
                                    <div class="txtaddress">
                                    <?php if($profile['diachi']=='0') {echo "Chưa cập nhật";} else {echo $profile['diachi'];} ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="noname"></td>
                                <td class="row_btnluu">
                                <input type="submit" id="submit1" class="btnluu btn btn-primary" value="Sửa"></input>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </table>
                    </form>
                </div>
            </div>
            <h1 style="padding: 0 0 40px;"></h1>
          </div>
          <div class="footer">
            <div class="container">
              <div class="row">
                  <div class="col-md text-center mt-3 mb-4 footer_follow">
                      <h5 class="footer_follow-title">Follow Us</h5>
                      <ul class="list-unstyled d-flex justify-content-center mb-0 footer_follow-list">
                          <li class="me-3 footer_follow-list-item">
                              <a href="#" class="text-dark">
                                  <i class="fab fa-facebook"></i>
                              </a>
                          </li >
                          <li class="me-3 footer_follow-list-item">
                              <a href="#" class="text-dark">
                                  <i class="fab fa-instagram"></i>
                              </a>
                          </li>
                          <li class="me-3 footer_follow-list-item">
                              <a href="#" class="text-dark">
                                  <i class="fab fa-telegram"></i>
                              </a>
                          </li>
                          <li class="footer_follow-list-item">
                              <a href="#" class="text-dark">
                                  <i class="fab fa-youtube"></i>
                              </a>
                          </li>
                      </ul>
                  </div>
      
                  <hr class="d-md-none " style="width: 30%; margin: 0 auto">
      
                   <div class="col-md text-center mt-md-3 mt-3 mb-4 footer_contact">
                      <h5 class="footer_contact-title">Contact Us</h5>
                      <ul class="list-unstyled mb-0 footer_contact-list">
                          <li class="footer_contact-list-item"><i class="fa-solid fa-phone"></i>0379614995</li>
                          <li class="footer_contact-list-item">
                              <i class="fa-regular fa-envelope"></i>
                              Luxeloom@gmail.com
                          </li> 
                      </ul>
                  </div>
      
      
                  <hr class="d-md-none" style="width: 30%; margin: 0 auto">
      
                  <div class="col-md text-center mt-md-3 mt-3 mb-4 footer_explore">
                      <h5 class="footer_explore-title">Explore</h5>
                      <ul class="list-unstyled mb-0 footer_explore-list">
                          <li class="footer_explore-list-item"><a href="#">Home</a></li>
                          <li class="footer_explore-list-item"><a href="#">Products</a></li>
                          <li class="footer_explore-list-item"><a href="#">Services</a></li>
                      </ul>
                  </div>
              </div>
          </div>
          </div>
    </div>
</body>
</html>