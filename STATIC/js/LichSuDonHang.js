
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

function formatTrangThai(trangthai) {
    switch (trangthai){
        case '1':
            return "<span style='color: black;'>Đã đặt hàng</span>"
        case '2':
            return "<span style='color: orange;'>Đang giao hàng</span>"
        case '3':
            return "<span style='color: green;'>Đã nhận hàng</span>"
        case '4':
            return "<span style='color: red;'>Đã Hủy</span>";

    }
}

function displayOrders(orders) {
    var ButtonDanhanduochang='';
    if (orders.length > 0) {
        // Xóa sự kiện click trước khi đính kèm sự kiện mới
        $('#orderHistory').off('click', '.view-details');

        orders.forEach(function(order) {
            if(order.trangThai==2){
                ButtonDanhanduochang='<button class="btn btn-success float-end view-details me-2" type="button"data-action="received" data-idkhachhang=' + order.idKhachHang + '" data-iddonhang="' + order.id +'">Đã nhận được hàng</button>' ;
            }
            else ButtonDanhanduochang='';
            var orderItem = $('<div class="col-md-12 order-item">' +
                '<div class="d-flex">' +
                '<img src="' + order.src + '" alt="Product Image" class="imageProduct">' +
                '<div class="d-flex" style="width:90%;">' +
                '<div class="product-name w-80">' + order.tenSanPham + '</div>' +
                '</div>' +
                '</div>' +
                '<div>' +
                '<p class="fw-bold text-center " style="border: 1px solid rgb(228, 227, 227);">Trạng thái: ' + formatTrangThai(order.trangThai) + '</p>' +
                '<p class="fw-bold text-end" style="font-size: larger;">Thành tiền: ' +'<span style="color: red;">'+formatPrice(order.tongTien)+'</span></p>' +
                '<p class="fw-bold text-end">Mã đơn hàng: ' + order.id + '</p>' +
                '<button class="btn btn-primary float-end view-details" type="button" data-action="view" data-idkhachhang=' + order.idKhachHang + '" data-iddonhang="' + order.id +'" data-trangthaidonhang="' + order.trangThai + '">Xem chi tiết</button>' +
                ButtonDanhanduochang+
                '</div>' +
                '</div>');

            $('#orderHistory').append(orderItem);
        });

        // Đính kèm sự kiện click một lần cho mỗi nút "Xem chi tiết"
        $('.view-details').click(function() {
            var action=$(this).data('action');

            switch (action) {
                case 'view':
                    // Xử lý khi nút "Xem chi tiết" được nhấn
                    var idKhachHang = $(this).data('idkhachhang');
                    var idDonHang = $(this).data('iddonhang');
                    var TrangThai = $(this).data('trangthaidonhang');

                    var form = $('<form action="ChiTietDonHang.php" method="post">' +
                    '<input type="hidden" name="idkhachhang" value="' + idKhachHang + '">' +
                    '<input type="hidden" name="iddonhang" value="' + idDonHang + '">' +
                    '<input type="hidden" name="trangthai" value="' + TrangThai + '">' +
                    '</form>');

                    $('body').append(form);
                    form.submit();
                    break;
                case 'received':
                    var idDonHang = $(this).data('iddonhang');
                    var idKhachHang = $(this).data('idkhachhang');
                    // Hiển thị hộp thoại xác nhận
                    var confirmation = confirm("Bạn có chắc chắn muốn xác nhận đã nhận được hàng không?");
                    
                    // Kiểm tra xem người dùng đã xác nhận hay không
                    if (confirmation) {
                        // Nếu người dùng đã xác nhận, thực hiện hành động "Đã nhận được hàng"
                        daNhanDuocHang(idKhachHang, idDonHang);
                    }
                    // Xử lý khi nút "Đã nhận được hàng" được nhấn
                    break;
                default:
                    // Xử lý khi không có hành động nào khớp
                    break;
            }
        });
    } else {
        $('#orderHistory').append('<p>Không có đơn hàng nào.</p>');
    }
}
function daNhanDuocHang(CustomerID,idHoaDon) {
    $.ajax({
        url: "/web2/CONTROLLER/OderController.php",
        method: 'POST',
        dataType: 'json',
        data: { action:'daNhanDuocHang',idhoadon:idHoaDon},
        success: function(response) {
            if(response=='true'){
                alert("Xác nhận hoàn thành đơn hàng thành công");
                var form = $('<form action="OrderHistory.php" method="post">' +
                '<input type="hidden" name="customerId" value="' + CustomerID + '">' +
                '</form>');
                // Thêm form vào trang hiện tại
                $('body').append(form);
                // Gửi form đi
                form.submit();
            }
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi gửi yêu cầu:', error);
        }
    });
}
