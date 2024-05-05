<?php
    session_start();
    session_regenerate_id(true);
    require 'C:\xampp\htdocs\web2\MODEL\Database.php';
    require_once 'google-api/vendor/autoload.php';
    require_once __DIR__.'\..\..\CONTROLLER\ProfileController.php';
    $profileController= new ProfileController();
    $client= new Google_Client();
    $client->setClientId('738185340571-n1nhvd916p7boq245k5bubcol4tbksg9.apps.googleusercontent.com');
    $client->setClientSecret('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');
    $client->setRedirectUri('http://localhost/web2/VIEWS/sign_up/sign_up.php');
    $client->addScope("email");
    $client->addScope("profile");
    if(isset($_GET['code'])){
        $token= $client->fetchAccessTokenWithAuthCode($_GET['code']);
        if(!isset($token['error'])){
            $client->setAccessToken($token['access_token']);
            $google_oauth= new Google_Service_Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get();
            $db = new Database();
            $conn = $db->getConnection();

            $id = mysqli_real_escape_string($conn,$google_account_info->id);
            $full_name= mysqli_real_escape_string($conn,trim($google_account_info->name));
            $email= mysqli_real_escape_string($conn,$google_account_info->email);
            $profile_pic= mysqli_real_escape_string($conn,$google_account_info->picture);
            
            $get_user = mysqli_query($conn, "SELECT `google_id` FROM `users` WHERE `google_id`='$id'");
            
            if(mysqli_num_rows($get_user) > 0){
                $get_tinhtrang=$profileController->getTinhTrang_google($id);
                if($get_tinhtrang==0){
                    header('Location: /web2/VIEWS/sign_up/404.php');
                }else{
                $get_id= $profileController->getID_google($id);
                $_SESSION['id'] = $get_id; 
                $_SESSION['login_name'] = $full_name; 
                header('Location: /web2/index.php');
                exit;
                }
            }
            else
            {
                $insert=mysqli_query($conn, "INSERT INTO `users`(`google_id`,`ten`,`email`,`src`,`usertype`) VALUES('$id','$full_name','$email','$profile_pic','khachhang')");
                $insert1=mysqli_query($conn, "INSERT INTO `taikhoan`(`tenTaiKhoan`,`maQuyen`,`TinhTrang`) VALUES('$full_name','2','1')");
                if($insert&&$insert1)
                {   
                    $get_new_id= $profileController->getID_google($id);
                    $_SESSION['id'] = $get_new_id; 
                    $_SESSION['login_name'] = $full_name; 
                    header('Location: /web2/index.php');
                    exit;
                }
                else
                {
                    echo "Sign up failed!(Something went wrong).";
                }
            }
            
        }
        else{
            header('Location: signup.php');
            exit;
        }
    }
?>
<?php
    require_once 'Facebook/autoload.php';
    $FBOject = new \Facebook\Facebook([
        'app_id' =>'827729482526836',
        'app_secret' => '970d19a8df54b866f087029a193df2dc',
        'default_app_vesion' => 'v19.0'
    ]);
    $handler = $FBOject -> getRedirectLoginHelper();
    

    $redirectTo = "http://localhost/web2/VIEWS/sign_up/callback.php";
    $data= ['email'];
    $fullUrl= $handler->getLoginUrl($redirectTo,$data);
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
    <link rel="stylesheet" href="/web2/STATIC/css/sign_up.css">
    
    
    <title>Đăng ký</title>
</head>
<body>
      <div class="header">
        <div class="MyLogo">
          <a class="LinkTrangChu" href="/web2/index.php">
          <img src="/web2/STATIC/assets/banner.jpg" class="img-fluid" style="width: 150px;">
          </a>
          <div class="namepage" style="font-size: 1.5rem; padding: 15px; font-family: 'Roboto'; font-size: 30px;">Đăng ký</div>
        </div>
      </div>
      <div class="container d-flex justify-content-center align-items-center min-vh-100">

       <div class="row border rounded-5 p-3 bg-white shadow box-area">


       <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #80d8ff;">
           <div class="featured-image mb-3">
            <img src="/web2/STATIC/assets/banner.jpg" class="img-fluid" style="width: 250px;">
           </div>
           <p class="text-black fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">SHOPPEE</p>
           <small class="text-black text-wrap text-center" style="width: 17rem;font-family: 'Roboto'">Bạn của mọi nhà</small>
       </div> 
        
       <div class="col-md-6 right-box">
          <div class="row align-items-center">
                <div class="header-text mb-4">
                     <h2 style="text-align: center; font-size: 40px;">Đăng ký</h2>
                </div>
                <form action="/web2/CONTROLLER/SignUpController.php"method="post" name="MyForm" id="MyForm">
                <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-lg bg-light fs-6" name="Username" placeholder="Tên đăng nhập" id="username">
                </div>
                <p id="errorUsername" style="font-size: 12px; color:red; padding-left: 15px;"></p>
                <div class="input-group mb-3">
                    <input type="password" class="form-control form-control-lg bg-light fs-6" name="Password" placeholder="Mật khẩu" id="password" >
                </div> 
                <p id="errorPassword" style="font-size: 12px; color:red;padding-left: 15px;"></p>
                <div class="input-group mb-3">
                  <input type="password" class="form-control form-control-lg bg-light fs-6" name="cPassword" placeholder="Nhắc lại mật khẩu" id="cpassword">
              </div> 
                <p id="errorcPassword" style="font-size: 12px; color:red;padding-left: 15px;"></p>
                <div class="input-group mb-3"> 
                    <input id="submit1"  name="submit1" type="submit" class="btn btn-lg btn-primary w-100 fs-6"; value="ĐĂNG KÝ"></input>
                </div>
                </form>
                <div class="underline_or" style="padding-bottom: 14px; display: flex; align-items: center;">
                    <div class="line" style="height: 2px; width: 100%; background-color: #dbdbdb;"></div>
                    <span class="or" style="font-weight: bold;">hoặc</span>
                    <div class="line" style="height: 2px; width: 100%; background-color: #dbdbdb;"></div>
                </div>      
                <div class="d-grid gap-2">
                    <button class="btn btn-light" onclick="window.location='<?php echo $fullUrl ?>'"><img src="/web2/STATIC/assets/facebook_icon.webp" style="width: 25px;" alt="Ảnh"><a style="text-decoration: none; color: #000;">&nbsp; Facebook</a></button>

                    <button class="btn btn-light" type="submit"><img src="/web2/STATIC/assets/google_icon.png" style="width: 25px;" alt="Ảnh"><a style="text-decoration: none; color: #000;" href="<?php echo $client->createAuthUrl(); ?>">&nbsp; Google</a></button>
                </div>
                <div class="row">
                    <small style="text-align: center;">Bạn đã có tài khoản? &nbsp;<a href="#">Đăng nhập</a></small>
                </div>
          </div>
       </div> 

      </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="/web2/STATIC/js/validation.js"></script>
</body>
</html>
