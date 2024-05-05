google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(function() {
    // Gọi hàm drawLineChart ở đây
    // drawLineChart(data);
});
var currentMonth;
var currentYear;
var TinhTrangLoaiThongKe='Thang';
window.onload = function() {
    FirstLoad();
};
function FirstLoad(){
    var currentDate = new Date();
     currentYear = currentDate.getFullYear();
     currentMonth = currentDate.getMonth() +1;
    createYearOptions();
    createMonthOptions(1,currentMonth);
    LoadHeaderBox(currentMonth,currentYear);
    LoaddataChart(currentMonth,currentYear);
    GetAllLoaiSanPham(currentMonth,currentYear);
    GetTopSellingProducts(currentMonth, currentYear, 'all');
}
function changeLoaiThongKe() {
    var selectLoaisanpham = document.getElementById('idLoaiThongKe');
    var Datepicker=document.getElementById('idDatePicker');
    var comboboxMonthYear = document.getElementById('idComboboxMonthYear');
    var linechart = document.getElementById('linechart'); // Thay 'idLineChart' bằng id thực của phần tử 'linechart'

    if (selectLoaisanpham.value === 'Thang') {
        FirstLoad();
        comboboxMonthYear.style.display = 'flex'; // Hiển thị combobox tháng và năm
        linechart.style.display='flex';
        Datepicker.style.display='none';
        TinhTrangLoaiThongKe='Thang';
    } else if (selectLoaisanpham.value === 'time') {
        SetKhoangThoiGian();
        // Gọi hàm thống kê theo khoảng thời gian
        comboboxMonthYear.style.display = 'none'; // Ẩn combobox tháng và năm
        linechart.style.display='none';
        Datepicker.style.display='flex';
        TinhTrangLoaiThongKe='time';

    }
}
function SetKhoangThoiGian(){
    // Thiết lập giá trị cho input fromDate và toDate
    
    document.getElementById('fromDate').value = formatDate(getFirstDayOfMonth());
    document.getElementById('toDate').value = formatDate(new Date());
    var fromDate=document.getElementById('fromDate').value;
    var toDate= document.getElementById('toDate').value;
    GetThongTinHeaderByDateRange(fromDate,toDate);
    GetAllLoaiSanPhamByDateRange(fromDate,toDate);
    GetTopSellingProductsByDateRange(fromDate,toDate, 'all');
}

// Hàm để lấy ngày đầu tiên của tháng
function getFirstDayOfMonth() {
    var today = new Date();
    var firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
    return firstDay;
}

// Hàm để định dạng ngày dưới dạng YYYY-MM-DD
function formatDate(date) {
    var year = date.getFullYear();
    var month = (date.getMonth() + 1).toString().padStart(2, '0');
    var day = date.getDate().toString().padStart(2, '0');
    return year + '-' + month + '-' + day;
}

function createMonthOptions(setDefault,currentMonth1) {

    var selectMonth = document.getElementById("month");


    selectMonth.innerHTML = ''; // Xóa tất cả các tùy chọn hiện có trong combobox tháng

    // Xóa tất cả các tùy chọn hiện có trong combobox tháng
    var selectedYear = document.getElementById("year").value; // Lấy giá trị của năm được chọn từ thẻ <select> năm
    var endMonth = (selectedYear == currentYear) ? currentMonth : 12; // Nếu là năm hiện tại, chỉ hiển thị đến tháng hiện tại
    for (var i = 1; i <= endMonth; i++) {
        var option = document.createElement("option");
        option.text = "Tháng " + i;
        option.value = i;
        selectMonth.appendChild(option); // Thêm tùy chọn vào combobox tháng
    }
    if(setDefault==1){
    selectMonth.value = currentMonth; // Đặt giá trị mặc định cho combobox tháng
    }
    else     selectMonth.value = currentMonth1; // Đặt giá trị mặc định cho combobox tháng
}

function createYearOptions() {
    var selectYear = document.getElementById("year");

    selectYear.innerHTML = ''; // Xóa tất cả các tùy chọn hiện có trong combobox năm

    for (var i = currentYear; i >= currentYear - 5; i--) {
        var option = document.createElement("option");
        option.text = i;
        option.value = i;
        selectYear.appendChild(option); // Thêm tùy chọn vào combobox năm
    }
    selectYear.value = currentYear; // Đặt giá trị mặc định cho combobox năm
}
function onchangeMonth(){
    var currentMonth=document.getElementById("month").value;
    var currentYear=document.getElementById("year").value;
    LoadHeaderBox(currentMonth,currentYear);
    LoaddataChart(currentMonth,currentYear);
    GetAllLoaiSanPham(currentMonth,currentYear);
}
function onchangeYear(){
    var currentMonth=document.getElementById("month").value;
    // Lấy phần tử combobox tháng
    var selectMonth = document.getElementById("month");
    // Xóa tất cả các tùy chọn tháng hiện có
    while (selectMonth.options.length > 0) {
        selectMonth.remove(0);
    }
    createMonthOptions(0,currentMonth);
    var currentYear=document.getElementById("year").value;
    LoadHeaderBox(currentMonth,currentYear);
    LoaddataChart(currentMonth,currentYear);
    GetAllLoaiSanPham(currentMonth,currentYear);
}
function LoadHeaderBox(currentMonth,currentYear){
        $.ajax({
            url: "/web2/CONTROLLER/ThongKeController.php",
            method: 'POST',
            dataType: 'json',
            data: { action:'GetThongTinHeader',Month:currentMonth, Year:currentYear},
            success: function(response) {
                displayHeaderBoxThongKe(response);
                console.log(response);
                
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi gửi yêu cầu:', error);
            }
        });
    
}


function displayHeaderBoxThongKe(response){
    if (Object.keys(response).length > 0) {
        // Sử dụng innerHTML để thêm mã HTML vào một phần tử với id là "container"
        document.getElementById("TongSoDonHang").innerHTML = response.total_orders;
        document.getElementById("TongSoSanPham").innerHTML = response.total_products_sold;
        document.getElementById("TongSoDoanhThu").innerHTML = formatPrice(parseInt(response.total_revenue));
        document.getElementById("DanhGiaTichCuc").innerHTML = response.total_good_reviews ;
        if(response.total_products_sold==null)
            document.getElementById("TongSoSanPham").innerHTML = "0";
        if(response.total_revenue==null)
            document.getElementById("TongSoDoanhThu").innerHTML = "0";

    }
    else {
}

}
function LoaddataChart(currentMonth, currentYear) {
    $.ajax({
        url: "/web2/CONTROLLER/ThongKeController.php",
        method: 'POST',
        dataType: 'json',
        data: { action:'GetDailyRevenueData',Month:currentMonth, Year:currentYear},
        success: function(response) {
            var newData = addMissingDays(response, currentYear, currentMonth);

            console.log(response);
            drawLineChart(newData);
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi gửi yêu cầu:', error);
        }
    });
}
// Hàm thêm các ngày không có doanh thu vào dữ liệu
function addMissingDays(data, year, month) {
    var newData = [];

    // Tạo một đối tượng Date để lặp qua từng ngày trong tháng
    var startDate = new Date(year, month - 1, 1);
    var endDate = new Date(year, month, 0); // Lấy ngày cuối cùng của tháng

    // Lặp qua từng ngày trong tháng
    for (var d = new Date(startDate); d <= endDate; d.setDate(d.getDate() + 1)) {
        // Kiểm tra xem ngày hiện tại có trong dữ liệu không
        var found = false;
        for (var i = 0; i < data.length; i++) {
            var dateParts = data[i].ngayLap.split('-');
            var dataDate = new Date(parseInt(dateParts[0]), parseInt(dateParts[1]) - 1, parseInt(dateParts[2]));
            if (d.getTime() === dataDate.getTime()) {
                newData.push(data[i]);
                found = true;
                break;
            }
        }
        // Nếu không tìm thấy, thêm một bản ghi với doanh thu là 0
        if (!found) {
            newData.push({ ngayLap: formatDate(d), revenue: 0 });
        }
    }

    return newData;
}

// Hàm chuyển đổi đối tượng Date thành chuỗi ngày tháng (YYYY-MM-DD)
function formatDate(date) {
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    if (month < 10) {
        month = '0' + month;
    }
    var day = date.getDate();
    if (day < 10) {
        day = '0' + day;
    }
    return year + '-' + month + '-' + day;
}
// Hàm vẽ biểu đồ đường
function drawLineChart(data) {
    // Tạo đối tượng DataTable
    var dataTable = new google.visualization.DataTable();

    // Thêm cột ngày (date) và doanh thu (number) vào DataTable
    dataTable.addColumn('date', 'Ngày');
    dataTable.addColumn('number', 'Doanh thu');

    // Lặp qua mảng dữ liệu và thêm từng hàng vào DataTable
    data.forEach(function(item) {
        // Chuyển đổi chuỗi ngày thành đối tượng Date
        var dateParts = item.ngayLap.split('-');
        var year = parseInt(dateParts[0]);
        var month = parseInt(dateParts[1]) - 1; // Tháng trong JavaScript bắt đầu từ 0
        var day = parseInt(dateParts[2]);
        var date = new Date(year, month, day);

        // Thêm hàng vào DataTable
        dataTable.addRow([date, parseInt(item.revenue)]);
    });
    // Cài đặt các tùy chọn cho biểu đồ đường
    var options = {
        title: 'Biểu đồ doanh thu theo ngày',
        lineWidth: 2, // Đặt độ rộng của đường nối
        legend: { position: 'bottom' },
        colors: ['coral'], // Đổi màu của đường và dấu chấm
        pointSize: 8, // Làm cho dấu chấm lớn hơn
        pointShape: { type: 'star', sides: 8, rotation: 45 }, // Sử dụng hình sao cho dấu chấm
        vAxis: { 
            format: 'decimal',
            viewWindow: { min: 0 } // Đặt giá trị tối thiểu của trục y là 0
        },
        hAxis: { 
            format: 'd',
            gridlines: { count: 31 }
        }
    };
    // Vẽ biểu đồ đường
    var chart = new google.visualization.LineChart(document.getElementById('linechart'));
    chart.draw(dataTable, options);
}
function formatPrice(price) {
    // Định dạng số tiền thành chuỗi với dấu phân cách hàng nghìn
    var formattedPrice = price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    // Thêm đơn vị tiền tệ (VND) vào sau giá tiền
    return formattedPrice ;
}
function GetAllLoaiSanPham(currentMonth, currentYear) {
    $.ajax({
        url: "/web2/CONTROLLER/ThongKeController.php",
        method: 'POST',
        dataType: 'json',
        data: { action: 'GetAllLoaiSanPham', Month: currentMonth, Year: currentYear },
        success: function(response) {
            // Xử lý dữ liệu phản hồi ở đây
            console.log(response);
            // Ví dụ: Hiển thị các loại sản phẩm trong dropdown
            displayProductTypes(response);
            currentMonth=document.getElementById("month").value;
            currentYear=document.getElementById("year").value;
            GetTopSellingProducts(currentMonth, currentYear, 'all')
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi gửi yêu cầu:', error);
        }
    });
}

function GetThongTinHeaderByDateRange(fromDate,toDate){
    $.ajax({
        url: "/web2/CONTROLLER/ThongKeController.php",
        method: 'POST',
        dataType: 'json',
        data: { action:'GetThongTinHeaderByDateRange',fromDate:fromDate, toDate:toDate},
        success: function(response) {
            displayHeaderBoxThongKe(response);
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi gửi yêu cầu:', error);
        }
    });

}
function GetAllLoaiSanPhamByDateRange(fromDate,toDate) {
    $.ajax({
        url: "/web2/CONTROLLER/ThongKeController.php",
        method: 'POST',
        dataType: 'json',
        data: { action: 'GetAllLoaiSanPhamByDateRange', fromDate: fromDate, toDate: toDate },
        success: function(response) {
            // Xử lý dữ liệu phản hồi ở đây
            console.log(response);
            displayProductTypes(response);
            var fromDate=document.getElementById('fromDate').value;
            var toDate= document.getElementById('toDate').value;
            GetTopSellingProductsByDateRange(fromDate, toDate, 'all')
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi gửi yêu cầu:', error);
        }
    });
}

function GetTopSellingProductsByDateRange(fromDate,toDate, productType) {
    $.ajax({
        url: "/web2/CONTROLLER/ThongKeController.php",
        method: 'POST',
        dataType: 'json',
        data: {
            action: 'GetTopSellingProductsByDateRange', 
            fromDate: fromDate,
            toDate: toDate,
            productType: productType
        },
        success: function(response) {
            // Process top selling products response here
            console.log(response);
            // Example: Display top selling products data
            displayTopSellingProducts(response);
        },
        error: function(xhr, status, error) {
            console.error('Error when sending request:', error);
        }
    });
}
function displayProductTypes(productTypes) {
    // Xóa tất cả các option hiện có trong dropdown
    $('#productType').empty();

    // Thêm option "Tất cả sản phẩm" vào đầu danh sách
    $('#productType').append($('<option>', {
        value: 'all',
        text: 'Tất cả sản phẩm'
    }));
    
    // Thêm các loại sản phẩm vào dropdown
    $.each(productTypes, function(index, productType) {
        $('#productType').append($('<option>', {
            value: productType.id, // Sử dụng id làm giá trị của option
            text: productType.tenLoaiSP // Sử dụng tên loại sản phẩm làm nội dung của option
        }));
    });
}
// Function to get top selling products
function GetTopSellingProducts(currentMonth, currentYear, productType) {
    $.ajax({
        url: "/web2/CONTROLLER/ThongKeController.php",
        method: 'POST',
        dataType: 'json',
        data: {
            action: 'GetTopSellingProducts', 
            Month: currentMonth, 
            Year: currentYear, 
            productType: productType
        },
        success: function(response) {
            // Process top selling products response here
            console.log(response);
            // Example: Display top selling products data
            displayTopSellingProducts(response);
        },
        error: function(xhr, status, error) {
            console.error('Error when sending request:', error);
        }
    });
}
// Function to display top selling products in table
function displayTopSellingProducts(products) {
    var tableBody = $('#topProductsTable tbody');
    tableBody.empty();

    $.each(products, function(index, product) {
        var row = $('<tr>');
        row.append('<td>' + product.tenSanPham + '</td>');
        row.append('<td>' + formatPrice(parseInt(product.giaBan)) + '</td>');
        row.append('<td>' + product.total_sold + '</td>');
        row.append('<td><a href="chi-tiet-san-pham.php?product=' + encodeURIComponent(product.tenSanPham) + '" class="btn btn-primary">Xem chi tiết</a></td>');
        tableBody.append(row);
    });
}
function OnchangeLoaiSP(){
    switch (TinhTrangLoaiThongKe) {
        case 'Thang':
            var selectedProductType = document.getElementById('productType').value;
            var currentMonth = document.getElementById("month").value;
            var currentYear = document.getElementById("year").value;
            GetTopSellingProducts(currentMonth, currentYear, selectedProductType);
            break;
        case 'time':
            var selectedProductType = document.getElementById('productType').value;
            var fromDate=document.getElementById('fromDate').value;
            var toDate= document.getElementById('toDate').value;
            GetTopSellingProductsByDateRange(fromDate, toDate, selectedProductType);
            break;
        // Thêm các trường hợp khác nếu cần
        default:
            // Xử lý khi không khớp với bất kỳ trường hợp nào
    }
    
}



function changeFromDate(){
    if(validateFromDate()){
        var fromDate=document.getElementById('fromDate').value;
        var toDate= document.getElementById('toDate').value;
        GetThongTinHeaderByDateRange(fromDate,toDate);
        GetAllLoaiSanPhamByDateRange(fromDate,toDate);
        GetTopSellingProductsByDateRange(fromDate,toDate, 'all');
    }
}

function changeToDate(){
    if(validateToDate()){
        var fromDate=document.getElementById('fromDate').value;
        var toDate= document.getElementById('toDate').value;
        GetThongTinHeaderByDateRange(fromDate,toDate);
        GetAllLoaiSanPhamByDateRange(fromDate,toDate);
        GetTopSellingProductsByDateRange(fromDate,toDate, 'all');
    }
}
// Hàm kiểm tra khi người dùng thay đổi ngày "fromDate"
function validateFromDate() {
    var fromDateInput = document.getElementById('fromDate');
    var toDateInput = document.getElementById('toDate');
    var currentDate = new Date();

    // Chuyển đổi giá trị ngày nhập thành đối tượng Date
    var fromDate = new Date(fromDateInput.value);
    var toDate = new Date(toDateInput.value);

    // Biến để lưu kết quả kiểm tra
    var isValid = true;

    // Kiểm tra xem fromDate có lớn hơn toDate không
    if (fromDate > toDate) {
        fromDateInput.value = toDateInput.value; // Đặt lại giá trị fromDate thành giá trị của toDate
        alert("Ngày bắt đầu không thể lớn hơn ngày kết thúc.");
        isValid = false;
    }

    // Kiểm tra xem toDate có lớn hơn ngày hiện tại không
    if (toDate > currentDate) {
        toDateInput.value = formatDate(currentDate); // Đặt lại giá trị toDate thành ngày hiện tại
        alert("Ngày kết thúc không thể lớn hơn ngày hiện tại.");
        isValid = false;
    }

    return isValid;
}

// Hàm kiểm tra khi người dùng thay đổi ngày "toDate"
function validateToDate() {
    var fromDateInput = document.getElementById('fromDate');
    var toDateInput = document.getElementById('toDate');
    var currentDate = new Date();

    // Chuyển đổi giá trị ngày nhập thành đối tượng Date
    var fromDate = new Date(fromDateInput.value);
    var toDate = new Date(toDateInput.value);

    // Biến để lưu kết quả kiểm tra
    var isValid = true;

    // Kiểm tra xem toDate có nhỏ hơn fromDate không
    if (toDate < fromDate) {
        toDateInput.value = fromDateInput.value; // Đặt lại giá trị toDate thành giá trị của fromDate
        alert("Ngày kết thúc không thể nhỏ hơn ngày bắt đầu.");
        isValid = false;
    }

    // Kiểm tra xem toDate có lớn hơn ngày hiện tại không
    if (toDate > currentDate) {
        toDateInput.value = formatDate(currentDate);
        alert("Ngày kết thúc không thể lớn hơn ngày hiện tại.");
        isValid = false;
    }

    return isValid;
}





