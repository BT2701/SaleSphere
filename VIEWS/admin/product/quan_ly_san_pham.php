<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="/web2/STATIC/css/category.css">
    <link rel="stylesheet" href="/web2/STATIC/css/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php require_once 'C:\xampp\htdocs\web2\CONTROLLER\SanPhamController.php'; 
    $sanphamList = $controller->getList(PHP_INT_MAX);?>
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
        .imageproduct{
            
            max-width: 100px;
            max-height: auto;
        }
        .table-wrapper {
            max-height: 60vh; /* Chiều cao cố định */
            overflow-y: auto; /* Hiển thị thanh cuộn dọc khi bảng tràn ra ngoài */
        }

    </style>
    <div class="container mt-5">
        <h1>Quản lý sản phẩm</h1>
        <hr>
        <!-- khu vực phân loại tìm kiếm -->
        <div class="category-right">
            <div class="input-group" style="max-width: 250px; max-height: 50px;">
                    <input type="text" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="searchButton" id="searchInput">
                    <button class="btn btn-outline-secondary bg-dark" type="button" id="searchButton" style="max-height: 50px">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <div class="category-right-top-items">
                    
                    <select name="" id="" onchange="loadProducts(this.value)">
                        <option value="Tất cả sản phẩm">Tất cả sản phẩm</option>
                        <?php if (isset($categoryList) && !empty($categoryList)): ?>
                                    <?php foreach ($categoryList as $cate): ?>
                                        <option value="<?php echo $cate['tenLoaiSP']; ?>" ><?php echo $cate['tenLoaiSP']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                        
                    </select>
                </div>
                <div class="category-right-top-items">
                    <select name="" id="" onchange="loadProductsTheoKhoangGia(this.value)">
                        <option value="Tất cả mệnh giá">Tất cả mệnh giá</option>
                        <option value="From 0 to 100000">0 đến 100.000</option>
                        <option value="From 100000 to 200000">100.000 đến 200.000</option>
                        <option value="From 200000 to 500000">200.000 đến 500.000</option>
                        <option value="From 500000 to 2147483647">500.000 đến ...</option>
                    </select>
                </div>
            </div>
        

        <!-- Modal thêm sản phẩm -->
        <?php include 'AddProduct.php'; ?>

        <!-- Model thành công -->
        <?php include 'thanhcong.php';?>

        <!-- Model đánh giá -->
        <?php include 'DanhGia.php';?>

        

        <!-- Bảng hiển thị danh sách sản phẩm -->
        <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Mã SP</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Giá bán</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Dữ liệu sản phẩm
                    

                    // Hiển thị sản phẩm trong bảng
                    
                        if(isset($sanphamList) && !empty($sanphamList)) {
                            foreach ($sanphamList as $product):
                                echo "<tr>";
                                echo "<td>" . $product['id'] . "</td>";
                                echo "<td><img class='imageproduct' src='" . $product['src'] . "' alt='Product Image'></td>";
                                echo "<td>" . $product['tenSanPham'] . "</td>";
                                echo "<td>" . $product['giaBan'] . "</td>";
                                echo "<td>";
                                echo "<button type='button' class='btn btn-danger btn-sm mr-2'>Xóa</button>";
                                echo "<button type='button' class='btn btn-primary btn-sm'>Sửa</button>";
                                echo "<button type='button' class='btn btn-primary btn-sm mr-1 btn-show-overview' style='margin-left: 10px;'>Tổng quan đánh giá</button>";

                                echo "</td>";
                                echo "</tr>";
                            endforeach;}
                            else{
                                echo "không có sản phẩm nào";
                            }
                    
                ?>
            </tbody>
        </table>
        </div>
        <!-- Nút thêm sản phẩm -->
        <button type="button" style="margin-top: 30px;"  class="btn btn-primary mb-3" data-toggle="modal" data-target="#addProductModal">Thêm sản phẩm</button>
        
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
    <script src="/web2/STATIC/js/category.js"></script>

</body>
</html>
