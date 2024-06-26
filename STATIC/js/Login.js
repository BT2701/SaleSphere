// Lắng nghe sự kiện keydown trên trường nhập liệu mật khẩu
document
  .getElementById("txtPassword")
  .addEventListener("keydown", function (event) {
    // Kiểm tra nếu phím nhấn là "Enter" và không có phím môdifer nào được nhấn (Ctrl, Alt, Shift...)
    if (
      event.key === "Enter" &&
      !event.ctrlKey &&
      !event.altKey &&
      !event.shiftKey
    ) {
      // Ngăn chặn hành động mặc định của phím Enter
      event.preventDefault();

      // Gọi hàm đăng nhập
      Login();
    }
  });
function togglePasswordVisibility() {
  var passwordInput = document.getElementById("txtPassword");
  var checkbox = document.getElementById("showPasswordCheckbox");

  if (checkbox.checked) {
    passwordInput.type = "text";
  } else {
    passwordInput.type = "password";
  }
}

// Gọi hàm validateLoginForm khi người dùng nhấn nút Đăng Nhập
function Login() {
  var username = document.getElementById("txtUsername").value;
  var password = document.getElementById("txtPassword").value;
  validateLoginForm(username, password);
}

// Kiểm tra và hiển thị lỗi khi người dùng thay đổi giá trị trong các ô nhập liệu
function validateLoginForm(username, password) {
  if (username.trim() === "") {
    document.getElementById("usernameError").innerHTML =
      "TÊN ĐĂNG NHẬP không được để trống!";
  } else {
    document.getElementById("usernameError").innerHTML = "";
  }

  if (password.trim() === "") {
    document.getElementById("passwordError").innerHTML =
      "MẬT KHẨU không được để trống!";
  } else {
    document.getElementById("passwordError").innerHTML = "";
  }

  if (username.trim() !== "" && password.trim() !== "") {
    checkLogin(username, password);
  }
}

// Gọi hàm changeUsername khi người dùng thay đổi giá trị trong ô nhập liệu username
function changeUsername() {
  document.getElementById("usernameError").innerHTML = "";
}

// Gọi hàm changePassword khi người dùng thay đổi giá trị trong ô nhập liệu password
function changePassword() {
  document.getElementById("passwordError").innerHTML = "";
}

function checkLogin(username, password) {
  $.ajax({
    url: "/SaleSphere/CONTROLLER/LoginController.php",
    method: "POST",
    dataType: "json",
    data: { action: "Login", username: username, password: password },
    success: function (response) {
      console.log(response);
      if (response != false) {
        if ("maQuyen" in response && "TinhTrang" in response) {
          if (response.maQuyen == 2 && response.TinhTrang == 1) {
            window.location.href = "/SaleSphere/index.php?page=homepage";
          } else {
            if (response.maQuyen != 2 && response.TinhTrang == 1) {
              window.location.href = "/SaleSphere/VIEWS/admin/admin_home.php";
            } else {
              window.location.href = "/SaleSphere/VIEWS/sign_up/404.php";
            }
          }
        } else {
          console.error("Thuộc tính 'maQuyen' không tồn tại trong phản hồi.");
        }
      }
      if (response == false) {
        alert("Sai tên đăng nhập hoặc mật khẩu");
      }
    },
    error: function (xhr, status, error) {
      console.error("Lỗi khi gửi yêu cầu:", error);
    },
  });
}
