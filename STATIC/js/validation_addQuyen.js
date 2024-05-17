$(document).ready(function () {
  $("#tinh").click(function (event) {
    event.preventDefault();

    var formData = {
      username: $("#Username").val(),
    };
    $.ajax({
      type: "POST",
      url: "/SaleSphere/VIEWS/admin/phanquyen/validation_addQuyen.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (response) {
      if (!response.success) {
        if (response.errors.username) {
          $("#errorusername").text(response.errors.username);
        } else {
          if (response.errors.username1) {
            $("#errorusername").text(response.errors.username1);
          } else $("#errorusername").text("");
        }
      } else {
        $("#Form1").submit();
      }
    });
  });
});
