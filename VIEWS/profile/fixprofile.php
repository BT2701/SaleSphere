<?php
    session_start();
    require_once 'C:\xampp\htdocs\web2\CONTROLLER\ProfileController.php';
    $profileController = new ProfileController();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/web2/STATIC/css/fixprofile.css">
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
                <?php if (isset($profileList) && !empty($profileList)) ?>
                <?php foreach ($profileList as $profile) : ?>
                    <form action="/web2/CONTROLLER/FixProfileController.php" method="post" name="MyForm" id="MyForm" enctype="multipart/form-data">
                    <div class="left_box">
                        <div class="content_img" style="display: block;" >
                            <img  style="border-radius: 100%; width: 150px;" src="<?php if($profile['src']=='0'||$profile['src']==''){echo '/web2/STATIC/assets/default_avatar_1.png';} else {echo $profile['src'];} ?>" alt="">
                            <input style="margin-top: 20px; width: 200% !important;" type="file" name="anh" id="anh">
                            <div class="warning" style="width: 200px; margin-left: -20px; padding-top: 20px;">
                            <p>Dung lượng file tối đa 1MB</p>
                            <p>Định dạng: .JPEG, .PNG</p>
                            </div>
                        </div>
                    </div>
                    <div class="right_box">
                    
                            <input type="hidden" id="IdProfile1" name="IdProfile" value="<?php echo $profile['id']; ?>"/>
                            <table>
                                <tr>
                                    <td class="row_lbusername">
                                        <label class="lbusername">Tên đăng nhập</label>
                                    </td>
                                    <td class="row_txtusername">
                                        <input type="text" class="txtusername" name="username" value="<?php echo $profile['ten']; ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="row_lbemail">
                                        <label class="lbemail">Email</label>
                                    </td>
                                    <td class="row_txtemail">
                                        <input type="text" class="txtemail" name="email" id="Email"  value="<?php if($profile['email']=='0') {echo "";} else {echo $profile['email'];}  ?>" />
                                        <p id="errorEmail" style="font-size: 15px; color:red; padding-left: 5px; padding-top: 5px;"></p>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td class="row_lbnumber">
                                        <label class="lbnumber">Số điện thoại</label>
                                    </td>
                                    <td class="row_txtnumber">
                                        <input type="text" class="txtnumber" name="phone_number" id="Phone_Number" value="<?php if($profile['sdt']=='0'){echo "";} else {echo $profile['sdt'];} ?>" />
                                        <p id="errorPhoneNumber" style="font-size: 15px; color:red; padding-left: 5px; padding-top: 5px;"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="row_lbgender">
                                        <label class="lbgender">Giới tính</label>
                                    </td>
                                    <td class="row_cbgender">
                                        <?php if ($profile['gender'] == 'Nam') { ?>
                                            <div class="cbmale">
                                                <input type="radio" name="cbgender" id="male" value="Male" checked />
                                                <label>Nam</label>
                                            </div>
                                            <div class="cbfemale">
                                                <input type="radio" name="cbgender" id="female" value="Female" />
                                                <label>Nữ</label>
                                            </div>
                                        <?php } else { ?>
                                            <div class="cbmale">
                                                <input type="radio" name="cbgender" id="male" value="Male" />
                                                <label>Nam</label>
                                            </div>
                                            <div class="cbfemale">
                                                <input type="radio" name="cbgender" id="female" value="Female" checked />
                                                <label>Nữ</label>
                                            </div>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="row_lbdob">
                                        <label class="lbdob">Ngày sinh</label>
                                    </td>
                                    <td class="row_txtdob">
                                        <input style="width: 230px;" type="date" class="txtdob" name="dob" value="<?php echo $profile['dob']; ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="row_lbdiachi">
                                        <label class="lbdiachi">Địa chỉ</label>
                                    </td>
                                    <td class="row_txtdiachi">
                                        <input style="width: 230px;" type="text" class="txtdiachi" name="diachi" value="<?php if($profile['diachi']=='0') {echo "";} else {echo $profile['diachi'];} ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="noname"></td>
                                    <td class="row_btnluu">
                                        <input type="submit" id="submit1" class="btnluu btn btn-primary" value="Lưu"></input>
                                    </td>
                                </tr>
                            </table>
                        <?php endforeach; ?>
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
                            </li>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="/web2/STATIC/js/validation_fixprofile.js"></script>
</body>

</html>