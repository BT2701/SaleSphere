$(document).ready(function () {
  $("#tinh").click(function (event) {
    event.preventDefault();

    var formData = {
      username: $("#Username").val(),
      email: $("#Email").val(),
      phone_number: $("#Phone_number").val(),
      password: $("#Password").val(),
    };
    $.ajax({
      type: "POST",
      url: "/web2/VIEWS/admin/user/validation_add.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (response) {
      if (!response.success) {
        if (response.errors.email10) {
          $("#erroremail").text(response.errors.email10);
        } else $("#erroremail").text("");
        if (response.errors.phone_number10) {
          $("#errorphone_number").text(response.errors.phone_number10);
        } else $("#errorphone_number").text("");
        if (response.errors.username) {
          $("#errorusername").text(response.errors.username);
        } else {
          if (response.errors.username0) {
            $("#errorusername").text(response.errors.username0);
          } else {
            if (response.errors.username3) {
              $("#errorusername").text(response.errors.username3);
            } else {
              if (response.errors.username1) {
                $("#errorusername").text(response.errors.username1);
              } else {
                if (response.errors.username2) {
                  $("#errorusername").text(response.errors.username2);
                } else $("#errorusername").text("");
              }
            }
          }
        }
        if (response.errors.password) {
          $("#errorpassword").text(response.errors.password);
        } else {
          if (response.errors.password2) {
            $("#errorpassword").text(response.errors.password2);
          } else {
            if (response.errors.password1) {
              $("#errorpassword").text(response.errors.password1);
            } else $("#errorpassword").text("");
          }
        }
      } else {
        $("#Form1").submit();
      }
    });
  });
});
