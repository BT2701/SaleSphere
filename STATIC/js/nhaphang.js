$(document).ready(function () {
  // Xử lý sự kiện khi thay đổi select
  $("#selection").change(function () {
    // Lấy giá trị của select
    var selectedOption = $(this).val();

    // Hiển thị hoặc giấu đi các div tương ứng bằng CSS display
    if (selectedOption == "nhanvien") {
      $(".search-by-nhanvien").css("display", "block");
      $(".search-by-thoigian").css("display", "none");

      document.getElementById("searchInput").value = "";

      var tableRows = document.querySelectorAll("#tableData tr");
      tableRows.forEach(function (row) {
        row.style.display = ""; // Hiển thị dòng dữ liệu
      });
    } else if (selectedOption == "thoigian") {
      $(".search-by-nhanvien").css("display", "none");
      $(".search-by-thoigian").css("display", "flex");
      document.getElementById("searchInput").value = "";

      var tableRows = document.querySelectorAll("#tableData tr");
      tableRows.forEach(function (row) {
        row.style.display = ""; // Hiển thị dòng dữ liệu
      });
    }
  });
});
$(document).ready(function () {
  // Sử dụng sự kiện click để hiển thị modal khi nút được nhấn
  $(".view-detail").click(function () {
    var id = $(this).data("id");
    $.ajax({
      type: "POST",
      url: "/web2/CONTROLLER/NhapHangController.php",
      data: { idPhieuNhap: id },
      success: function (response) {
        // Hiển thị kết quả từ server trong modal
        $("#detail-content").html(response);
        // Hiển thị modal
        $("#detail-modal").modal("show");
      },
    });
  });
  $("#close").click(function () {
    $("#detail-modal").modal("hide");
  });
});
function timKiemTheoTen() {
  // Get the search input value
  var searchText = document.getElementById("searchInput").value.toLowerCase();

  // Get the table body element
  var tableBody = document.getElementById("tableData");

  // Loop through each row in the table body
  var rows = tableBody.getElementsByTagName("tr");
  for (var i = 0; i < rows.length; i++) {
    var row = rows[i];

    // Get the employee name cell
    var employeeNameCell = document.getElementById(
      "employeeName" + row.cells[2].textContent
    );

    // Check if the employee name contains the search text
    if (
      employeeNameCell &&
      employeeNameCell.textContent.toLowerCase().includes(searchText)
    ) {
      row.style.display = ""; // Show the row if it matches the search
    } else {
      row.style.display = "none"; // Hide the row if it doesn't match the search
    }
  }
}
function timKiemTheoKhoangThoiGian() {
  var startDate = document.getElementById("startDate").value;
  var toDate = document.getElementById("toDate").value;
  var tableRows = document
    .getElementById("tableData")
    .getElementsByTagName("tr");

  for (var i = 0; i < tableRows.length; i++) {
    var row = tableRows[i];
    var ngayNhap = row.getElementsByTagName("td")[1].textContent;

    if (ngayNhap >= startDate && ngayNhap <= toDate) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  }
}

document
  .getElementById("startDate")
  .addEventListener("change", timKiemTheoKhoangThoiGian);
document
  .getElementById("toDate")
  .addEventListener("change", timKiemTheoKhoangThoiGian);
