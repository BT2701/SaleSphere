function handleKeyPress(event, inputId) {
    // Kiểm tra xem phím được nhấn có phải là phím "Enter" không (mã phím 13)
    if (event.keyCode === 13) {
        // Dựa vào ID của trường <input>, thực hiện hành động tương ứng
        switch(inputId) {
            case 'emailInput':
                sendEmail();
                $('#txtMaXacNhan').focus();
                break;
            case 'Password':
                document.getElementById('ConfirmPassword').focus();
                break;
            case 'ConfirmPassword':
                changePassword();
                break;
            // Thêm các trường hợp khác nếu cần
            default:
                break;
        }
    }
}
function togglePasswordVisibility() {
    var Password = document.getElementById("Password");
    var ConfirmPassword = document.getElementById("ConfirmPassword");
    var checkbox = document.getElementById("showPasswordCheckbox");
    
    if (checkbox.checked) {
        Password.type = "text";
        ConfirmPassword.type = "text";
    } else {
        Password.type = "password";
        ConfirmPassword.type = "password";
    }
}
function sendEmail() {
    // Lấy giá trị của trường nhập liệu email
    var email = document.getElementById('emailInput').value;
    checkEmail(email);
    
}
function SendingEmail(email){
    $('#txtMaXacNhan').prop('disabled', false);
    startCountdown();
    $.ajax({
        url: "/SaleSphere/VIEWS/ForgotPassword/ForgotPasswordRoute.php",
        method: 'POST',
        dataType: 'json',
        data: { action: 'sendConfirmationEmail',email: email},
        success: function(response) {
            if(response==true){
            }
            else alert("Gửi mã xác nhận thất bại");
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi gửi yêu cầu:', error);
        }
    });
}

function startCountdown() {
    var seconds = 70; // Thời gian đếm ngược là 70 giây
    var countdownElement = document.getElementById('countdown');

    // Ẩn liên kết "Gửi mã" sau khi người dùng ấn vào
    var sendEmailLink = document.querySelector('.float-end');
    sendEmailLink.style.display = 'none';

    // Hiển thị thông báo "Gửi lại mã sau: số giây" với màu đen và số giây với màu đỏ
    countdownElement.innerHTML = "<span>Gửi lại mã sau: </span><span id='seconds' style='color: red;'>" + seconds + "</span>";
    
    updateCountdown();

    // Tạo đếm ngược
    var countdownInterval = setInterval(updateCountdown, 1000); // Cập nhật mỗi giây

    function updateCountdown() {
        seconds--;
        var secondsSpan = document.getElementById('seconds');
        secondsSpan.innerText = seconds;

        // Kiểm tra nếu thời gian đếm ngược kết thúc
        if (seconds <= 0) {
            clearInterval(countdownInterval); // Dừng đếm ngược
            countdownElement.innerText = ''; // Xóa hiển thị thời gian đếm ngược
            sendEmailLink.style.display = 'inline'; // Hiển thị lại liên kết "Gửi mã"
        }
    }
}
function checkEmail(email) {
    // Kiểm tra xem trường email có trống không
    if (email.trim() === '') {
        alert("Vui lòng nhập địa chỉ email.");
    }
    else{
        $.ajax({
            url: "/SaleSphere/VIEWS/ForgotPassword/ForgotPasswordRoute.php",
            method: 'POST',
            dataType: 'json',
            data: { action: 'CheckEmail', email: email }, // Gửi dữ liệu email lên server
            success: function(response) {
                if (response==true) {
                    SendingEmail(email);
                } else {
                    alert("Email không tồn tại trong hệ thống");
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi gửi yêu cầu:', error);
                // Xử lý lỗi nếu có
            }
        });
    }
}

function changeEmail(){
    $('#txtMaXacNhan').prop('disabled', true);
    $('#Password').prop('disabled', true);
    $('#ConfirmPassword').prop('disabled', true);
    $('#btnXacNhan').prop('disabled', true);
    document.getElementById('txtMaXacNhan').value = '';
}
function validatePasswordOnChange() {
    var password = document.getElementById('Password').value;
    var isValid = validatePassword(password);
    var errorElement = document.getElementById('passwordError');
    if (!isValid) {
        errorElement.style.display = 'block';
        $('#ConfirmPassword').prop('disabled', true);
    } else {
        errorElement.style.display = 'none';
        $('#ConfirmPassword').prop('disabled', false);
    }
}

function validateMaxacnhan(input) {
    // Loại bỏ mọi ký tự không phải số
    input.value = input.value.replace(/\D/g, '');

    // Giới hạn chiều dài của chuỗi nhập vào là 6 ký tự
    if (input.value.length > 6) {
        input.value = input.value.slice(0, 6);
    }

    var confirmationCode = input.value;
    var isValid = validateConfirmationCode(confirmationCode);
    var errorElement = document.getElementById('maxacnhanError');
    if (!isValid) {
        errorElement.style.display = 'block';
        $('#Password').prop('disabled', true);
    } 
    else {
        errorElement.style.display = 'none';
        $('#Password').prop('disabled', false);

    }
}

function validatePassword(password) {
    // Kiểm tra xem mật khẩu có ít nhất 8 ký tự và bao gồm cả chữ và số không
    var regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    return regex.test(password);
}

function validateConfirmPassword() {
    var password = document.getElementById('Password').value;
    var confirmPassword = document.getElementById('ConfirmPassword').value;
    var errorElement = document.getElementById('confirmPasswordError');

    if (password !== confirmPassword) {
        // Nếu mật khẩu và xác nhận mật khẩu không khớp nhau, hiển thị thông báo lỗi
        errorElement.style.display = 'block';
        $('#btnXacNhan').prop('disabled', true);
        return false;
    } else {
        // Nếu mật khẩu và xác nhận mật khẩu khớp nhau, ẩn thông báo lỗi (nếu có) và trả về true
        errorElement.style.display = 'none';
        $('#btnXacNhan').prop('disabled', false);
        return true;
    }
}



function validateConfirmationCode(code) {
    // Kiểm tra xem mã xác nhận có đúng định dạng hay không (6 chữ số)
    var pattern = /^\d{6}$/;
    return pattern.test(code);
}
function XacNhanDoiMatKhau(){
    // Lấy giá trị email và mã xác nhận từ các thẻ HTML
    var email = document.getElementById('emailInput').value;
    var confirmationCode = document.getElementById('txtMaXacNhan').value;
    $.ajax({
        url: '/SaleSphere/VIEWS/ForgotPassword/XulySession.php',
        method: 'POST',
        data: { action: 'validateSession', email: email, confirmation_code: confirmationCode }, // Thêm action: 'validateSession' vào dữ liệu gửi đi
        success: function(response) {
            if (response =='true') { 
                changePassword();
            } else {
                alert("sai");
                // Email hoặc mã xác nhận không khớp
            }
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi gửi yêu cầu Ajax:', error);
            // Xử lý lỗi nếu có
        }
    });
}

function changePassword() {
    deleteSession();
    var email = document.getElementById('emailInput').value;
    var newPassword = document.getElementById('Password').value;
    $.ajax({
        url: '/SaleSphere/VIEWS/ForgotPassword/ForgotPasswordRoute.php',
        method: 'POST',
        data: { action: 'ChangePassword', email: email, new_password: newPassword },
        success: function(response) {
            console.log("kết quả thay đổi mật khẩu"+response);
            if (response.trim() === 'true'  ) {
                alert("Thay đổi mật khẩu thành công");
                window.location.href = "/SaleSphere/index.php";
                // Thực hiện các hành động tương ứng
            } else {
                alert("Lỗi: Thay đổi mật khẩu không thành công");
                // Xử lý các lỗi khác nếu cần
            }
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi gửi yêu cầu Ajax:', error);
            // Xử lý lỗi nếu có
        }
    });
}

function deleteSession() {
    // Gửi yêu cầu Ajax để xóa session
    $.ajax({
        url: '/SaleSphere/VIEWS/ForgotPassword/XulySession.php', // Đường dẫn đến file PHP xử lý yêu cầu
        method: 'POST',
        data: { action: 'deleteSession' }, // Thêm action: 'deleteSession' vào dữ liệu gửi đi
        success: function(response) {
            console.log("Kết quả xóa session: " + response);
            // Xử lý kết quả trả về nếu cần
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi gửi yêu cầu Ajax:', error);
            // Xử lý lỗi nếu có
        }
    });
}







