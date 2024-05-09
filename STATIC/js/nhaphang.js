$(document).ready(function(){
    // Xử lý sự kiện khi thay đổi select
    $("#selection").change(function(){
    // Lấy giá trị của select
    var selectedOption = $(this).val();

    // Hiển thị hoặc giấu đi các div tương ứng bằng CSS display
    if(selectedOption == "nhanvien") {
        $(".search-by-nhanvien").css("display", "block");
        $(".search-by-thoigian").css("display", "none");
    } else if(selectedOption == "thoigian") {
        $(".search-by-nhanvien").css("display", "none");
        $(".search-by-thoigian").css("display", "flex");
    }
    });
});
$(document).ready(function(){
    // Sử dụng sự kiện click để hiển thị modal khi nút được nhấn
    $(".view-detail").click(function(){
        var id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "/web2/CONTROLLER/NhapHangController.php",
            data: { idPhieuNhap: id },
            success: function(response) {
                // Hiển thị kết quả từ server trong modal
                $("#detail-content").html(response);
                // Hiển thị modal
                $("#detail-modal").modal('show');
            }
        });
    });
    $("#close").click(function(){
        $("#detail-modal").modal('hide');
    })
});
function timKiemTheoTen() {
// Get the search input value
var searchText = document.getElementById("searchInput").value.toLowerCase();

// Get the table body element
var tableBody = document.getElementById("tableData");

// Loop through each row in the table body
var rows = tableBody.getElementsByTagName("tr");
var listHTML='';
listHTML+='<?php foreach($list as $item){?>';

for (var i = 0; i < rows.length; i++) {
    var row = rows[i];

    // Get the employee name cell
    var employeeNameCell = document.getElementById("employeeName" + row.cells[2].textContent);

    // Check if the employee name contains the search text
    if (employeeNameCell && employeeNameCell.textContent.toLowerCase().includes(searchText)) {
    listHTML+= '<form action="/web2/CONTROLLER/NhapHangController.php" method="post" id="myForm">';
    listHTML+= '<tr>';
    listHTML+='<td>'+row.cells[0].textContent+'</td>'
    listHTML+='<td>'+row.cells[1].textContent+'</td>'
    listHTML+='<td id="employeeName'+row.cells[2].textContent+'">'+row.cells[2].textContent+'</td>';
    listHTML+='<td>'+row.cells[3].textContent+'</td>';
    listHTML+='<?php if($phanquyenmodel->getTinhTrang("L",$phanquyenmodel->getIdChucnangbyTenChucnang("Quản lý nhập hàng"),$phanquyenmodel->getmaQuyenbyId($id))){ ?>';
    listHTML+='         <td><button type="button" name="view-detail" class="btn btn-success btn-sm view-detail"  data-id="'+row.cells[0].textContent+'"><i class="fa-solid fa-list" style="font-size:20px;"></i></button></td>';
    listHTML+='                     <?php } else {} ?>';
    listHTML+='              </tr>';
    listHTML+='</form>';
    } 
}
listHTML+='<?php } ?>';
$('#tableData').html(listHTML);
}
function timKiemTheoThoiGian() {
// Get the start date
var startDate = new Date(document.getElementById("startDate").value);

// Get the end date
var endDate = new Date(document.getElementById("toDate").value);

// Add a day to the end date to include the entire day
endDate.setDate(endDate.getDate() + 1);

// Get the table body element
var tableBody = document.getElementById("tableData");

// Loop through each row in the table body
var rows = tableBody.getElementsByTagName("tr");
for (var i = 0; i < rows.length; i++) {
    var row = rows[i];

    // Get the date cell
    var dateCell = row.cells[1];

// Get the date as a Date object
}
}
