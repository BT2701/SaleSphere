
var isLoading = false; // Biến để kiểm tra xem có đang tải dữ liệu không
var page = 1; // Biến lưu trữ trang hiện tại
var limit = 10; // Số lượng đơn hàng muốn tải trong mỗi lần gọi
var endPage = false; // Biến để kiểm tra xem đã tải hết tất cả các trang dữ liệu hay không
var customerID;
    $(window).scroll(function() {
        // Tính toán vị trí cần cuộn để kích hoạt sự kiện load dữ liệu
        var triggerPosition = $(document).height() - $(window).height() - 50;

        // Nếu người dùng cuộn tới vị trí cần cuộn để kích hoạt load
        if ($(window).scrollTop() >= triggerPosition) {
            if (!isLoading && endPage==false){
                alert("load thêm dữ liệu");
                // Gọi hàm để load thêm dữ liệu
                loadOrderHistory(customerID);
            }
        }
    });
function FirstLoad(CustomerID){
    customerID=CustomerID;
    loadOrderHistory(customerID);
}
    // Sự kiện cuộn trang
function loadOrderHistory(CustomerID) {
    customerID=CustomerID;
    if (!isLoading && endPage==false) {
        isLoading = true;
        $.ajax({
            url: "/web2/CONTROLLER/OderController.php",
            method: 'POST',
            dataType: 'json',
            data: { action:'getOrderHistory',page:page, limit:limit,CustomerID:CustomerID},
            success: function(response) {
                if(response.length != limit ){
                    endPage = true; 
                }
                if (response.length > 0 ) {
                    page++; // Tăng số trang sau mỗi lần tải dữ liệu
                    displayOrders(response);
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

function displayOrders(orders) {
    if (orders.length > 0) {
        // Xóa sự kiện click trước khi đính kèm sự kiện mới
        $('#orderHistory').off('click', '.view-details');

        orders.forEach(function(order) {
            var orderItem = $('<div class="col-md-12 order-item">' +
                '<div class="d-flex">' +
                '<img src="' + order.src + '" alt="Product Image" class="imageProduct">' +
                '<div class="d-flex" style="width:90%;">' +
                '<div class="product-name w-80">' + order.tenSanPham + '</div>' +
                // '<div class="product-price">' + formatPrice(order.giaBan) + '</div>' +
                '</div>' +
                '</div>' +
                '<div>' +
                '<p class="fw-bold text-center ">Trạng thái: ' + order.trangThai + '</p>' +
                '<p class="fw-bold text-end" style="color: #c70039; font-size: larger;">Thành tiền: ' + formatPrice(order.tongTien) + '</p>' +
                '<p class="fw-bold text-end">MAHOADON: ' + order.id + '</p>' +
                '<button class="btn btn-primary float-end view-details" type="button" data-idkhachhang=' + order.idKhachHang + '" data-iddonhang="' + order.id + '">Xem chi tiết</button>' +
                '</div>' +
                '</div>');

            $('#orderHistory').append(orderItem);
        });

        // Đính kèm sự kiện click một lần cho mỗi nút "Xem chi tiết"
        $('.view-details').click(function() {
            var idKhachHang = $(this).data('idkhachhang');
            var idDonHang = $(this).data('iddonhang');

            var form = $('<form action="ChiTietDonHang.php" method="post">' +
            '<input type="hidden" name="idkhachhang" value="' + idKhachHang + '">' +
            '<input type="hidden" name="iddonhang" value="' + idDonHang + '">' +
            '</form>');

            $('body').append(form);
            form.submit();
        });
    } else {
        $('#orderHistory').append('<p>Không có đơn hàng nào.</p>');
    }
}

