<?php
    require_once __DIR__.'\..\..\CONTROLLER\ProfileController.php';
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
        $taikhoan='<li><a href="/SaleSphere/VIEWS/profile/profile.php">Tài khoản</a></li>';
        $changepass='';
        $logout=' <li><a href="/SaleSphere/VIEWS/sign_up/logout.php">Đăng xuất</a></li>';
    }
    else{
        $taikhoan='<li><a href="/SaleSphere/VIEWS/profile/profile.php">Tài khoản</a></li>';
        $changepass='<li><a href="/SaleSphere/VIEWS/profile/change_password.php">Đổi mật khẩu</a></li>';
        $logout=' <li><a href="/SaleSphere/VIEWS/sign_up/logout.php">Đăng xuất</a></li>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/SaleSphere/STATIC/css/change_password.css">
   
    <title>Đổi mật khẩu</title>
</head>
<body>
      <div class="header">
            <div class="MyLogo">
                <a class="LinkTrangChu" href="/SaleSphere/index.php">
                    <img src="/SaleSphere/STATIC/assets/banner.jpg" class="img-fluid" style="width: 150px;">
                </a>
                <div class="namepage" style="font-size: 1.5rem; padding: 15px; font-family: 'Roboto'; font-size: 30px;">Đổi mật khẩu</div>
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
      <div class="container d-flex justify-content-center align-items-center">
       <div class="col-md-6">
          <div class="row align-items-center">
                <div class="header-text mb-4">
                     <h2 style="text-align: center; font-size: 40px;">Đổi mật khẩu</h2>
                </div>
                <?php if (isset($profileList) && !empty($profileList)) ?>
                <?php foreach ($profileList as $profile) : ?>
                <form action="/SaleSphere/CONTROLLER/ChangePasswordController.php"method="post" name="MyForm1" id="MyForm">
                <input type="hidden" id="IdProfile1" name="IdProfile" value="<?php echo $profile['id']; ?>"/>
                <div class="input-group mb-3">
                    <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Mật khẩu hiện tại" id="oldpass" name="Oldpass">
                </div>
                <p id="errorOldpass" style="font-size: 12px; color:red; padding-left: 15px;"></p>
                <div class="input-group mb-3">
                    <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Mật khẩu mới" id="newpass" name="Newpass">
                </div> 
                <p id="errorNewpass" style="font-size: 12px; color:red; padding-left: 15px;"></p>
                <div class="input-group mb-3">
                  <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Nhắc lại mật khẩu mới" id="cnewpass" name="cNewpass">
              </div> 
              <p id="errorcNewpass" style="font-size: 12px; color:red; padding-left: 15px;"></p>
                <div class="input-group mb-3">
                     <input id="submit1"  name="submit1" type="submit" class="btn btn-lg btn-primary w-100 fs-6"; value="ĐỔI"></input>
                </div>   
                </form>
                <?php endforeach; ?>
          </div>
       </div> 
    </div>
    <div class="footer">
      <div class="container">
        <div class="row">
            <!-- Left Section - Social Media Icons -->
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="/SaleSphere/STATIC/js/validation_changepass.js"></script>
    </body>    
</html>