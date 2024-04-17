<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <style>
        /* CSS cho đánh giá sao */
        .star-rating {
            font-size: 1.5em;
        }

        .fa-star {
            color: #ffc107; /* Màu sao rỗng */
        }

        .checked {
            color: #ff9800; /* Màu sao được đánh dấu */
        }

    </style>
    <div class="container mt-5">
        <h1>Quản lý sản phẩm</h1>
        <hr>

        <!-- Nút thêm sản phẩm -->
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addProductModal">Thêm sản phẩm</button>

        <!-- Modal thêm sản phẩm -->
        <?php include 'AddProduct.php'; ?>

        <!-- Modal nhập hàng -->
        <?php include 'NhapHang.php'; ?>

        <!-- Model đánh giá -->
        <?php include 'DanhGia.php';?>

        <!-- Bảng hiển thị danh sách sản phẩm -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Giá bán</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Dữ liệu sản phẩm
                    $products = array(
                        array("https://via.placeholder.com/100", "Product 1", "$100"),
                        // Thêm dữ liệu sản phẩm khác vào đây
                    );

                    // Hiển thị sản phẩm trong bảng
                    foreach ($products as $product) {
                        echo "<tr>";
                        echo "<td><img src='" . $product[0] . "' alt='Product Image'></td>";
                        echo "<td>" . $product[1] . "</td>";
                        echo "<td>" . $product[2] . "</td>";
                        echo "<td>";
                        echo "<button type='button' class='btn btn-danger btn-sm mr-2'>Xóa</button>";
                        echo "<button type='button' class='btn btn-primary btn-sm'>Sửa</button>";
                        echo "<button type='button' class='btn btn-primary btn-sm mr-1 btn-show-overview' style='margin-left: 10px;'>Tổng quan đánh giá</button>";

                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>

        <!-- Nút nhập hàng -->
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#importProductModal">Nhập hàng</button>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Xử lý khi nhấn nút "Lưu" trong modal
            $('#saveProductBtn').click(function() {
                // Lấy giá trị từ các input
                var productName = $('#productName').val();
                var productPrice = $('#productPrice').val();
                var productType = $('#productType').val();
                var productUnit = $('#productUnit').val();
                var productDescription = $('#productDescription').val();
                var productImage = $('#productImage').val();

                // Hiển thị thông tin sản phẩm trong console (hoặc lưu vào cơ sở dữ liệu)
                console.log('Tên sản phẩm: ' + productName);
                console.log('Giá bán: ' + productPrice);
                console.log('Loại: ' + productType);
                console.log('Đơn vị tính: ' + productUnit);
                console.log('Mô tả: ' + productDescription);
                console.log('Đường dẫn hình ảnh: ' + productImage);

                // Đóng modal
                $('#addProductModal').modal('hide');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Xử lý khi nhấn nút "Nhập hàng"
            $('#importProductModal').on('show.bs.modal', function (event) {
                var modal = $(this);
                modal.find('.modal-body').empty(); // Xóa nội dung modal cũ trước khi thêm mới

                // Dữ liệu sản phẩm (hình ảnh, tên, số lượng còn lại)
                var products = [
                    { image: 'https://via.placeholder.com/100', name: 'Product 1', quantity: 10 },
                    // Thêm dữ liệu sản phẩm khác vào đây
                ];

                // Thêm dữ liệu sản phẩm vào modal
                $.each(products, function(index, product) {
                    var row = '<tr>';
                    row += '<td><img src="' + product.image + '" alt="Product Image"></td>';
                    row += '<td>' + product.name + '</td>';
                    row += '<td>' + product.quantity + '</td>';
                    row += '<td>';
                    row += '<div class="input-group">';
                    row += '<div class="input-group-prepend">';
                    row += '<button class="btn btn-outline-secondary decrement-btn" type="button">-</button>';
                    row += '</div>';
                    row += '<input type="text" class="form-control quantity-input" value="0">';
                    row += '<div class="input-group-append">';
                    row += '<button class="btn btn-outline-secondary increment-btn" type="button">+</button>';
                    row += '</div>';
                    row += '</div>';
                    row += '</td>';
                    row += '</tr>';
                    modal.find('.modal-body').append(row);
                });

                // Xử lý khi nhấn nút cộng và trừ
                modal.find('.increment-btn').click(function() {
                    var input = $(this).closest('.input-group').find('.quantity-input');
                    var value = parseInt(input.val(), 10);
                    input.val(value + 1);
                });

                modal.find('.decrement-btn').click(function() {
                    var input = $(this).closest('.input-group').find('.quantity-input');
                    var value = parseInt(input.val(), 10);
                    if (value > 0) {
                        input.val(value - 1);
                    }
                });
            });

            // Xử lý khi nhấn nút "Nhập hàng"
            $('#importProductBtn').click(function() {
                // Lấy giá trị số lượng nhập vào từ modal
                $('.quantity-input').each(function() {
                    var quantity = parseInt($(this).val(), 10);
                    console.log('Số lượng nhập vào: ' + quantity);
                    // Viết mã xử lý nhập hàng ở đây
                });

                // Đóng modal
                $('#importProductModal').modal('hide');
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            // Sử dụng sự kiện click để hiển thị modal khi nút được nhấn
            $(".btn-show-overview").click(function(){
            $("#productOverviewModal").modal('show');
            });
        });
    </script>

</body>
</html>
