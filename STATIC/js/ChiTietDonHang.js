var isLoading = false; // Biến để kiểm tra xem có đang tải dữ liệu không
var page = 1; // Biến lưu trữ trang hiện tại
var limit = 10; // Số lượng đơn hàng muốn tải trong mỗi lần gọi
var endPage = false; // Biến để kiểm tra xem đã tải hết tất cả các trang dữ liệu hay không
var customerID;
var IDDonHang;
var IDSanPham;
function FirstLoad(CustomerID,idDonHang,trangthai){
    customerID=CustomerID;
    IDDonHang=idDonHang;
    LoadThongTinDonHang(customerID,idDonHang,trangthai);
}
    // Sự kiện cuộn trang
function LoadThongTinDonHang(CustomerID,idDonHang,trangthai) {
    customerID=CustomerID;
    IDDonHang=idDonHang;
    if (!isLoading && endPage==false) {
        isLoading = true;
        $.ajax({
            url: "/SaleSphere/CONTROLLER/ChiTietDonHangController.php",
            method: 'POST',
            dataType: 'json',
            data: { action:'laychitietdonhang',page:page, limit:limit,CustomerID:CustomerID,IdDonHang:IDDonHang},
            success: function(response) {
                if(response.length != limit ){
                    endPage = true; 
                }
                if (response.length > 0 ) {
                    page++; // Tăng số trang sau mỗi lần tải dữ liệu
                    displayOrders(response,trangthai);
                    isLoading = false;
                } else {
                    endPage = true; // Đánh dấu là đã tải hết tất cả các trang dữ liệu
                }
                isLoading = false;
                
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi gửi yêu cầu:', error);
                isLoading = false;
            }
        });
    }
}
function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);
}


function displayOrders(orders,trangthai) {
    if (orders.length > 0) {
        // Xóa sự kiện click trước khi đính kèm sự kiện mới
        $('#ChiTietDonHang').off('click', '.view-details');

        orders.forEach(function(order) {
            IDSanPham=order.id;
            if(trangthai==3){
                checkIfEvaluated(customerID, IDDonHang, IDSanPham); // Kiểm tra và hiển thị/ẩn button
            }
            var orderItem = $('<div class="col-md-12 order-item">' +
                '<div class="d-flex">' +
                '<img src="' + order.src + '" alt="Product Image" class="imageProduct">' +
                '<div class="d-flex" style="width:90%;">' +
                '<div class="product-name w-80">' + order.tenSanPham + '</div>' +
                '</div>' +
                '</div>' +
                '<div>' +
                '<p class=" text-end " style="color: #c70039;  font-size: 20px; ">' + formatPrice(order.giaBan) + '</p>' +
                '<p class="fw-bold text-center ">Số Lượng: ' + order.soLuong + '</p>' +
                '<button class="btn btn-primary float-end view-details" style="display: none;" type="button" data-idkhachhang=' + customerID + '" data-iddonhang="' + IDDonHang +'" data-idsanpham="' + order.id+ '">Đánh Giá Sản Phẩm</button>' +
                '<p class="label-success text-end fw-bold" data-idsanpham="' + order.id + '" style="display: none;">Đã đánh giá</p>' +
                '</div>' +
                '</div>');

            $('#ChiTietDonHang').append(orderItem);
        });

        $('.view-details').click(function() {
            var idKhachHang = $(this).data('idkhachhang');
            var idDonHang = $(this).data('iddonhang');
            var idSanpham = $(this).data('idsanpham');

            var form = $('<form action="/SaleSphere/VIEWS/evaluate/evaluate.php" method="post">' +
            '<input type="hidden" name="idkhachhang" value="' + idKhachHang + '">' +
            '<input type="hidden" name="iddonhang" value="' + idDonHang + '">' +
            '<input type="hidden" name="idsanpham" value="' + idSanpham + '">' +
            '</form>');
            $('body').append(form);
            form.submit();
        });
    } else {
        $('#orderHistory').append('<p>Không có đơn hàng nào.</p>');
    }
}
function checkIfEvaluated(CustomerID, idDonHang, idSanPham) {
    $.ajax({
        url: "/SaleSphere/CONTROLLER/ChiTietDonHangController.php",
        method: 'POST',
        data: { 
            action: 'checkEvaluate',
            idKhachHang: CustomerID,
            idDonHang: idDonHang,
            idSanPham: idSanPham
        },
        success: function(response) {
            // Xử lý kết quả kiểm tra ở đây
            if (response === 'true') {
                // Đã tồn tại đánh giá, ẩn nút "Đánh Giá Sản Phẩm" và hiển thị label "Đã đánh giá"
                $('.view-details[data-idsanpham="' + idSanPham + '"]').hide(); // Ẩn nút
                $('.label-success[data-idsanpham="' + idSanPham + '"]').show(); // Hiển thị label
            } else {
                // Chưa tồn tại đánh giá, hiển thị nút "Đánh Giá Sản Phẩm" và ẩn label "Đã đánh giá"
                $('.view-details[data-idsanpham="' + idSanPham + '"]').show(); // Hiển thị nút
                $('.label-success[data-idsanpham="' + idSanPham + '"]').hide(); // Ẩn label
            }
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi gửi yêu cầu:', error);
        }
    });
}





