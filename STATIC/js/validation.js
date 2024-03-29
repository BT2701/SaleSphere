$(document).ready(function() {
    $('#submit1').click(function(event) {
        event.preventDefault();

    // Lấy dữ liệu từ form
    var formData = {
        'Username': $('#username').val(),
        'Password': $('input[name=Password]').val(),
        'cPassword': $('input[name=cPassword]').val()
    };

    // Sử dụng Ajax để gửi dữ liệu đến file validate.php
    $.ajax({
        type: 'POST',
        url: '/web2/VIEWS/sign_up/validate.php',
        data: formData,
        dataType: 'json',
        encode: true
    })
    .done(function(response) {
        // Xử lý kết quả trả về từ validate.php
        if (!response.success) {
            // Hiển thị thông báo lỗi nếu validation không thành công
            if (response.errors.username) {
                $('#errorUsername').text(response.errors.username);
            }
            else {
                if(response.errors.username0)
                {
                    $('#errorUsername').text(response.errors.username0);
                }
                else
                {
                    if(response.errors.username3)
                    {
                        $('#errorUsername').text(response.errors.username3);
                    }
                    else
                    {
                        if(response.errors.username1)
                    {
                        $('#errorUsername').text(response.errors.username1);
                    }
                        else
                        {
                            if(response.errors.username2)
                        {
                                $('#errorUsername').text(response.errors.username2);
                            }
                                else
                                $('#errorUsername').text('');
                            }
                    }
                }
            }
            if (response.errors.password) {
                $('#errorPassword').text(response.errors.password);
            } else {
                if(response.errors.password2)
                {
                    $('#errorPassword').text(response.errors.password2);
                }
                else{
                    if(response.errors.password1)
                    {
                        $('#errorPassword').text(response.errors.password1);
                    }
                    else
                    $('#errorPassword').text('');
                }
                
            }
            if (response.errors.cPassword) {
                $('#errorcPassword').text(response.errors.cPassword);
            } else {
                $('#errorcPassword').text('');
            }
            
        } else {
            // Nếu validation thành công, submit form
            $('#MyForm').submit();
        }
        });
    });
});
