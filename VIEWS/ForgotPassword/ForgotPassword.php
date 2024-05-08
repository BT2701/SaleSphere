<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/web2/STATIC/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <title>Quên Mật Khẩu</title>
</head>

<body>
    
    <div class="background-container">
        <div class="col-md-4 offset-md-4 background-login">
            <div class="logoLogin">
                <img src="https://th.bing.com/th/id/OIP.t3vk4vt-Sf78NAVX0lPqQAEsCJ?rs=1&pid=ImgDetMain" class="imglogo">
            </div>
            <div class="container-formLogin">
                <div class="textDangNhap">Quên Mật Khẩu</div>
                <div class="TenDangNhap_Pass mb-3 mx-3">
                    <input type="text" id="emailInput" placeholder="Nhập Email để nhận mã xác nhận" class="form-control cssTxtTenDangNhap" style="margin-bottom: 0px;" oninput="changeEmail()" onkeypress="handleKeyPress(event, 'emailInput')">
                    <a href="#" onclick="sendEmail();" class="float-end" style="margin-bottom: 2%;">Gửi mã</span></a>
                    <!-- Thêm một thẻ <span> với ID 'countdown' -->
                    <span id="countdown" class="float-end" style="margin-bottom: 2%;"></span>
                </div>
                <div class="TenDangNhap_Pass mb-3 mx-3">
                    <input type="text" id="txtMaXacNhan" placeholder="Nhập mã xác nhận(6 số)" class="form-control cssTxtTenDangNhap mb-1" style="margin-top: 0px;" maxlength="6" oninput="validateMaxacnhan(this)"onkeypress="handleKeyPress(event, 'Password')" disabled>
                    <div id="maxacnhanError" style="color: red; display: none;">Mã xác nhận phải có 6 số</div>

                </div>
                <div class="TenDangNhap_Pass mb-3 mx-3">
                    <input type="password" id="Password" placeholder="Nhập mật khẩu mới" class="form-control cssTxtTenDangNhap mb-1" oninput="validatePasswordOnChange()" disabled>
                    <div id="passwordError" style="color: red; display: none;">Mật khẩu phải có ít nhất 8 ký tự và bao gồm cả chữ và số.</div>
                </div>
                <div class="TenDangNhap_Pass mb-3 mx-3">
                    <input type="password" id="ConfirmPassword" placeholder="Xác nhận mật khẩu mới " class="form-control cssTxtTenDangNhap mb-1" oninput="validateConfirmPassword()" onkeypress="handleKeyPress(event, 'ConfirmPassword')" disabled>
                    <input type="checkbox" id="showPasswordCheckbox"  onchange="togglePasswordVisibility()">
                    <label style="font-weight: bold;">Hiện mật khẩu</label>
                    <div id="confirmPasswordError" style="color: red; display: none;">Mật khẩu và xác nhận mật khẩu không khớp nhau.</div>
                </div>
                <button class="btn btn-primary ButtonDangNhap " id ="btnXacNhan"style="margin-bottom: 20px;" onclick="XacNhanDoiMatKhau()" disabled>Xác Nhận</button>
                <!-- <button class="btn btn-primary ButtonFacebook "><i class="fab fa-facebook"></i> FaceBook</button>
                <button class="btn btn-danger ButtonEmail "><i class="fab fa-google"></i> Google</button> -->
                <div class="container-dangky" style="margin-bottom: 20px;">
                    <span class="container-dangky">Bạn muốn đăng nhập?</span>
                    <a href="#" class="hrefDangky">Đăng nhập</a>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <?php 
    

        session_start();

        // Kiểm tra xem session có tồn tại hay không
        if (isset($_SESSION['confirmation_code']) && isset($_SESSION['email'])) {
            // Nếu có, trả về một mảng JSON chứa các giá trị từ session
            echo json_encode([
                'confirmation_code' => $_SESSION['confirmation_code'],
                'email' => $_SESSION['email']
            ]);
        } else {
            // Nếu không có session, trả về một thông báo lỗi
            echo json_encode(['error' => 'Session not found']);
        }
    ?>

    <!-- Bootstrap JavaScript và các thư viện liên quan -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="/web2/STATIC/js/forgotPassword.js"></script>

</body>

</html>
