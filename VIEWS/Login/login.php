<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/SaleSphere/STATIC/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <title>Login</title>
</head>

<body>
    
        <div class="background-container">
            <div class="col-md-4 offset-md-4 background-login">
                <div class="logoLogin">
                    <img src="https://th.bing.com/th/id/OIP.t3vk4vt-Sf78NAVX0lPqQAEsCJ?rs=1&pid=ImgDetMain" class="imglogo">
                </div>
                <div class="container-formLogin">
                    <div class="textDangNhap">Đăng Nhập</div>
                    <div class="TenDangNhap_Pass mb-3 mx-3">
                        <input type="text" placeholder="Email/Số Điện Thoại/Tên Đăng Nhập" class="form-control cssTxtTenDangNhap" id="txtUsername" style="margin-bottom: 0px;" oninput="changeUsername()">
                        <div id="usernameError" class="error-message float-end" style="color: red; margin-bottom: 3%;" ></div>
                    </div>
                    <div class="TenDangNhap_Pass mb-3 mx-3">
                        <input type="password" placeholder="Mật khẩu" class="form-control cssTxtTenDangNhap" id="txtPassword" style="margin-bottom: 2%;" oninput="changePassword()">
                        <input type="checkbox" id="showPasswordCheckbox"  onchange="togglePasswordVisibility()">
                        <label style="font-weight: bold;">Hiện mật khẩu</label>
                        <div id="passwordError" class="error-message float-end" style="color: red; margin-bottom: 3%;" ></div>

                    </div>
                    <button class="btn btn-primary ButtonDangNhap" id="btnlogin" onclick="Login()">Đăng Nhập</button>
                    <a href="../ForgotPassword/ForgotPassword.php" class="Quenmatkhau ">Quên mật khẩu</a>
                    <button class="btn btn-primary ButtonFacebook "><i class="fab fa-facebook"></i> FaceBook</button>
                    <button class="btn btn-danger ButtonEmail "><i class="fab fa-google"></i> Google</button>
                    <div class="container-dangky">
                        <span class="container-dangky">Bạn mới biết đến Shopee?</span>
                        <a href="/SaleSphere/VIEWS/sign_up/sign_up.php" class="hrefDangky">Đăng ký</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/SaleSphere/STATIC/js/Login.js"></script>

</body>

</html>
