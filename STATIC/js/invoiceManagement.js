document.addEventListener("DOMContentLoaded", function() {
  // Lấy ra radio button cần check
  var checkAllRadio = document.getElementById("checkAllRadio");
  // Kiểm tra nếu radio button tồn tại
  if (checkAllRadio) {
      // Gọi hàm onchange khi radio button được tải
      checkAllRadio.checked = true;
      onRadioChange(checkAllRadio);
  }
});

function onRadioChange(radio){
  var dateInput= document.getElementById("Date");
  var checkPeriodLabel= document.getElementById("labelForCheckPeriod");
  var selectedValue= radio.value;
  if( selectedValue === 'checkAll'){

    dateInput.style.display = "none";
    checkPeriodLabel.style.display="inline-block";
      $.ajax({
          url: "/web2/CONTROLLER/InvoiceManagementController.php",
          method: 'POST',
          dataType: 'json',
          data: {
              action: 'checkAll',
              checkAll: 'true'
          },
          success: function(response) {
              // Xử lý phản hồi: cập nhật giao diện người dùng với danh sách hóa đơn
              displayInvoiceList(response);
          },
          error: function(xhr, status, error) {
              alert("Lỗi khi gửi yêu cầu: "+xhr.status);
          }
      });
  }
  else if( selectedValue === 'checkPeriod'){
      // Xử lý khi chọn checkPeriod
      $("#invoiceTable tbody").empty();
      dateInput.style.display = "inline-block";
      checkPeriodLabel.style.display="none";

  }
}
function dateChange(check){
  var checkPeriod= document.getElementById('checkPeriod');
  let startDateElement=document.getElementById("startDate")
  let startDate= startDateElement.value;
  let endDateElement=document.getElementById("endDate")
  let endDate= endDateElement.value;
  if(checkPeriod.checked){
  if(startDate === '' || endDate===''){
    
  }
  else if(startDate > endDate && check==1){
    alert("Thời gian bắt đầu không được lớn hơn thời gian kết thúc!")
    document.getElementById("startDate").value='';
  }
  else if( endDate < startDate && check==2){
    alert("Thời gian kết thúc phải lớn hơn thời gian bắt đầu!")
    document.getElementById("endDate").value='';
  }
  else{
    $.ajax({
      url: "/web2/CONTROLLER/InvoiceManagementController.php",
      method: 'POST',
      dataType: 'json',
      data: {
          action: 'checkPeriod',
          checkPeriod: 'true',
          startDate: startDate,
          endDate: endDate
      },
      success: function(response) {
          // Xử lý phản hồi: cập nhật giao diện người dùng với danh sách hóa đơn
          displayInvoiceList(response);
      },
      error: function(xhr, status, error) {
          alert("Lỗi khi gửi yêu cầu: "+xhr.status);
      }
  });
  }
  
  }
}

function displayInvoiceList(invoiceList) {
  // Xóa bảng cũ (nếu có) để tránh hiển thị trùng lặp
  $("#invoiceTable tbody").empty();

  // Duyệt qua danh sách hóa đơn và thêm chúng vào bảng
  let count=0;
  $.each(invoiceList, function(index, invoice) {
      count++;
      if(invoice.trangThai==1 ){
      var row = "<tr>" +
          "<td>" + count + "</td>" +
          "<td>" + invoice.id + "</td>" +
          "<td>" + invoice.idKhachHang + "</td>" +
          "<td>" + formatDate(invoice.ngayLap) + "</td>" +

          "<td>" + invoice.idNV + "</td>" +

          "<td>" + invoice.trangThai + "</td>" +
          "<td>" + invoice.tongTien + "</td>" +
          "<td class='chucnang'>" +
          "<button type='button' class='btn btn-info btn-sm' style='margin: 0px 10px 0px 15px' onclick='showInvoiceDetails(" + invoice.id + ")'>Chi tiết</button>" +
          "<button type='button' class='btn btn-danger btn-sm' style='margin: 0px 10px 0px 0px' onclick='cancelOrder(this, " + invoice.id + ")'>Hủy</button>" +
          "<button type='button' class='btn btn-success btn-sm' style='margin: 0px 10px 0px 0px' onclick='confirmOrder(this," + invoice.id + ")'>Xác nhận</button>" +
          "</td>" +
          "</tr>";
      $("#invoiceTable tbody").append(row);
      }

      else if(invoice.trangThai==2 ){

        var row = "<tr>" +
          "<td>" + count + "</td>" +
          "<td>" + invoice.id + "</td>" +
          "<td>" + invoice.idKhachHang + "</td>" +
          "<td>" + formatDate(invoice.ngayLap) + "</td>" +

          "<td>" + invoice.idNV + "</td>" +

          "<td>" + invoice.trangThai + "</td>" +
          "<td>" + invoice.tongTien + "</td>" +
          "<td class='chucnang'>" +
          "<button type='button' class='btn btn-info btn-sm' style='margin: 0px 10px 0px 15px' onclick='showInvoiceDetails(" + invoice.id + ")'>Chi tiết</button>" +
          "<button type='button' class='btn btn-danger btn-sm' style='margin: 0px 10px 0px 0px' onclick='cancelOrder(this, " + invoice.id + ")'>Hủy</button>" +
          "</td>" +
          "</tr>";
      $("#invoiceTable tbody").append(row);
      }

      else if( invoice.trangThai==3 ){
        var row = "<tr>" +
          "<td>" + count + "</td>" +
          "<td>" + invoice.id + "</td>" +
          "<td>" + invoice.idKhachHang + "</td>" +
          "<td>" + formatDate(invoice.ngayLap) + "</td>" +
          "<td>" + invoice.idNV + "</td>" +
          "<td>" + invoice.trangThai + "</td>" +
          "<td>" + invoice.tongTien + "</td>" +
          "<td class='chucnang'>" +
          "<button type='button' class='btn btn-info btn-sm' style='margin: 0px 10px 0px 15px' onclick='showInvoiceDetails(" + invoice.id + ")'>Chi tiết</button>" +
          "</td>" +
          "</tr>";
      $("#invoiceTable tbody").append(row);
      }

      else{count--}
  });
}
function formatDate(dateString) {
  // Tách ngày, tháng và năm từ chuỗi ngày ban đầu
  var parts = dateString.split("-");
  var year = parts[0];
  var month = parts[1];
  var day = parts[2];

  // Tạo một chuỗi mới với thứ tự ngày, tháng và năm đã thay đổi
  var formattedDate = day + "-" + month + "-" + year;

  // Trả về chuỗi ngày mới
  return formattedDate;
}

function showInvoiceDetails(invoiceId) {
  // Xử lý hiển thị chi tiết hóa đơn
  // Tạo một request AJAX để lấy thông tin chi tiết của hóa đơn dựa trên invoiceId
  $.ajax({
    url: "/web2/CONTROLLER/InvoiceManagementController.php",
    method: 'POST',
    dataType: 'json',
    data: {
      action: 'getInvoiceDetails',
      invoiceId: invoiceId
    },
    success: function(response) {
      // Xử lý phản hồi: hiển thị cửa sổ chi tiết hóa đơn
      displayInvoiceDetails(response, invoiceId);
    },
    error: function(xhr, status, error) {
      alert("Lỗi khi gửi yêu cầu: " + xhr.status);
    }
  });

  console.log("Hiển thị chi tiết cho hóa đơn có ID: " + invoiceId);
}
function displayInvoiceDetails(details, invoiceId) {
  // Tạo HTML cho bảng chi tiết hóa đơn
  var html = "<table class='table '>" +
    "<thead  style='text-align: center' class='thead table-primary'>" +
    "<tr> " +
      "<th>#</th>" +
      "<th>Sản phẩm</th>" +
      "<th>Số lượng</th>" +

    // "<th>Giá</th>" +

    "</tr>" +
    "</thead>" +
    "<tbody >";

  // Duyệt qua chi tiết hóa đơn và thêm vào bảng
  details.forEach(function(detail, index) {
     if(parseInt(detail.giaTriKhuyenMai) !=0){
      html += "<tr>" +
      "<td>" + (index + 1) + "</td>" +
      "<td><img style='width: 70px; height: 70px' src='" + detail.src + "' alt='" + detail.tenSanPham + "'>" + detail.tenSanPham + "</td>" +
      "<td>" + detail.soLuong + "</td>" +
      // "<td><p style='text-decoration: line-through; color: red;'>" + detail.giaBan + "</p>" +
      // "<p>" + (parseFloat(detail.giaBan) - (parseFloat(detail.giaBan) * parseFloat(detail.giaTriKhuyenMai) / 100)) + "</p></td>" +
      "</tr>";
     }
     else{
      html += "<tr>" +
      "<td>" + (index + 1) + "</td>" +

      "<td><img style='width: 70px; height: 70px; ' src='" + detail.src + "' alt='" + detail.tenSanPham + "'>  " + detail.tenSanPham + "</td>" +

      "<td>" + detail.soLuong + "</td>" +
      // "<td>" + detail.giaBan + "</td>" +
      "</tr>";
     }
    
  });


  html += "</tbody></table>";

  // Hiển thị cửa sổ popup hoặc modal với nội dung HTML đã tạo
  // Ví dụ: sử dụng Bootstrap modal
  $('#invoiceDetailsModal .modal-body').html(html);
  $('#invoiceDetailsModal').modal('show');

  $('.modal-header .close, .modal-footer .btn-primary').click(function() {
    $('#invoiceDetailsModal').modal('hide');
});

  var modalTitle = "Chi tiết của hóa đơn số " + invoiceId;
  $('#invoiceDetailsModalLabel').text(modalTitle);
}

function cancelOrder(btn,invoiceId) {
  // Xử lý hủy đơn hàng
  var row = btn.parentNode.parentNode;
  var confirmDelete = confirm("Có chắc chắn hủy đơn đặt hàng này không?")
  if (confirmDelete) {
  $.ajax({
    url: "/web2/CONTROLLER/InvoiceManagementController.php",
    method: 'POST',
    dataType: 'json',
    data: {
        action: 'cancelOrder',
        cancelOrder: 'true',
        invoiceId: invoiceId
    },
    success: function(response) {
        // displayInvoiceList(response);
        console.log("Xóa thành công");
        row.parentNode.removeChild(row);
    },
    error: function(xhr, status, error) {
        alert("Lỗi khi gửi yêu cầu: "+xhr.status);
    }
  });
  console.log("Hủy đơn hàng có ID: " + invoiceId);
}
}

function confirmOrder(btn,invoiceId) {
  // Xử lý xác nhận đơn hàng

  var row = btn.parentNode.parentNode;

  $.ajax({
    url: "/web2/CONTROLLER/InvoiceManagementController.php",
    method: 'POST',
    dataType: 'json',
    data: {
        action: 'confirmOrder',
        confirmOrder: 'true',
        invoiceId: invoiceId
    },
    success: function(response) {
      // Chỉnh trạng thái sang 3
        $(row).find('td:eq(5)').text('2');
        //Cập nhật mã NV
        $(row).find('td:eq(4)').text(response);
        //Ẩn nút Xác nhận
        $(row).find('.btn-success').hide();

    },
    error: function(xhr, status, error) {
        alert("Lỗi khi gửi yêu cầu: "+xhr.status);
    }
  });
  console.log("Xác nhận đơn hàng có ID: " + invoiceId);

  
}
// ----------------------------------Xử lý tìm kiếm---------------------\
document.addEventListener("DOMContentLoaded", function() {
var searchSelect = document.getElementById("searchSelect");
var searchInput = document.getElementById("searchInput");
var searchButton = document.getElementById("searchButton");
// Đặt sự kiện click cho nút tìm kiếm

searchSelect.addEventListener('change', function(){
  searchInput.value='';
  var rows = document.querySelectorAll("#invoiceTable tbody tr");
  rows.forEach(function(row){
    row.style.display = "";
  })
});
searchButton.addEventListener('click', function() {

    var searchText = searchInput.value.trim(); 
    if (searchText === '') {
        alert('Chưa nhập nội dung tìm kiếm! Thực hiện tìm kiếm tất cả!');
        return;
    }
    else{
    // Lấy tất cả các dòng trong bảng
    var rows = document.querySelectorAll("#invoiceTable tbody tr");
      
    // Lặp qua từng dòng và ẩn các dòng không khớp với nội dung tìm kiếm
    rows.forEach(function(row) {
      if(searchSelect.value=== 'maHoaDon'){
        var cellValue = row.cells[1].innerText.trim(); 
      }
      else if(searchSelect.value=== 'maKhachHang'){
        var cellValue = row.cells[2].innerText.trim(); 
      }
      else if(searchSelect.value=== 'maNhanVien'){
        var cellValue = row.cells[4].innerText.trim(); 
      }
      else if(searchSelect.value=== 'tinhTrangDonHang'){
        var cellValue = row.cells[5].innerText.trim(); 
        }
      if (cellValue === searchText) {
            row.style.display = ""; // Hiển thị dòng nếu giá trị trùng khớp
        } else {
            row.style.display = "none"; // Ẩn dòng nếu không khớp
        }

    });
  }
});

// Đặt sự kiện nhập cho ô nhập liệu
  searchInput.addEventListener('input', function() {
      var inputValue = this.value;

      // Nếu giá trị được chọn là "Mã hóa đơn"
      if (searchSelect.value === 'maHoaDon'|| searchSelect.value=== 'maKhachHang'||searchSelect.value=== 'maNhanVien') {
          // Kiểm tra xem giá trị nhập vào có chứa kí tự không phải số hoặc là số âm không
          if (isNaN(inputValue) || parseInt(inputValue) <= 0) {
              alert('Vui lòng chỉ nhập số dương');
              this.value = ''; 
          }
      }
      else if(searchSelect.value=== 'tinhTrangDonHang'){
        if (isNaN(inputValue) ) {
          alert('Vui lòng chỉ nhập số');
          this.value = ''; 
        }
        else if( parseInt(inputValue)<1 || parseInt(inputValue)>4){
          alert('Tình trạng đơn hàng chỉ có giá trị từ 1 đến 4!');
          this.value = ''; 
        }
      }
  });
  searchInput.addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {

        searchButton.click();
    }
  });
});