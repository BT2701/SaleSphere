<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="/SaleSphere/STATIC/css/category.css">
    <link rel="stylesheet" href="/SaleSphere/STATIC/css/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php require_once __DIR__.'\..\..\..\CONTROLLER\SanPhamController.php'; 
    require_once __DIR__.'\..\..\..\MODEL\PhanQuyenModel.php'; 

    if(isset($_SESSION['id'])&&$_SESSION['id']!="")
    {
        $id=$_SESSION['id'];
    }
    $phanquyenmodel= new PhanQuyenModel();
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
            width: 100%;
            max-width: 50px;
            max-height: 50px;
            border-radius: 20%;
        }
        .table-wrapper {
            max-height: 60vh; /* Chiều cao cố định */
            overflow-y: auto; /* Hiển thị thanh cuộn dọc khi bảng tràn ra ngoài */
        }
        th{
            background-color: #48dbfb;
        }
        #image-selected{
            width: 100%;
            max-width: 40px;
            max-height: 40px;
            border-radius: 20%;
        }
        .image-selection{
            display: flex;
            align-items: center;
        }
    </style>
    <div class="container mt-5">
        <h1>Quản lý sản phẩm</h1>
        <hr>
        <!-- tùy chọn -->
        <?php 
            if(isset($_GET['luachon'])&&$_GET['luachon']=='sua'){
                include 'EditProduct.php';
            }
        ?>
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

        <!-- Modal thành công -->
        <?php include 'thanhcong.php';?>

        <!-- Modal đánh giá -->
        <?php include 'DanhGia.php';?>


        

        
        <?php if($phanquyenmodel->getTinhTrang('T',$phanquyenmodel->getIdChucnangbyTenChucnang("Quản lý sản phẩm"),$phanquyenmodel->getmaQuyenbyId($id))){ ?>
        <!-- Nút thêm sản phẩm -->
        <button type="button" style="margin-top: 30px;"  class="btn btn-primary mb-3" data-toggle="modal" data-target="#addProductModal">Thêm sản phẩm</button>
        <?php } else {} ?>
        <!-- Bảng hiển thị danh sách sản phẩm -->
        <div class="table-wrapper">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Mã SP</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Giá nhập</th>
                    <th scope="col">Giá bán</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
            <?php
                    // Hiển thị sản phẩm trong bảng
                    if(isset($sanphamList) && !empty($sanphamList)) {?>
                        <?php foreach ($sanphamList as $product): ?>
                            <form method="POST" action="/SaleSphere/CONTROLLER/SanPhamController.php">
                                <tr>
                                    <td><?php echo $product['id']; ?></td>
                                    <td><img class="imageproduct" src="<?php echo $product['src']; ?>" alt="Product Image"></td>
                                    <td><?php echo $product['tenSanPham']; ?></td>
                                    <td><?php echo $product['giaNhap']; ?></td>
                                    <td><?php echo $product['giaBan']; ?></td>
                                    <td>
                                        
                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                        <?php if($phanquyenmodel->getTinhTrang('X',$phanquyenmodel->getIdChucnangbyTenChucnang("Quản lý sản phẩm"),$phanquyenmodel->getmaQuyenbyId($id))){ ?>
                                        <a href="" ><button type="submit" name="delete" class="btn btn-danger btn-sm" style="margin-right: 10px;"><i class="fa-solid fa-trash fs-5"></i></button></a>
                                        <?php } else {} ?>
                                        <!-- Đổi type của button 'Sửa' từ 'submit' thành 'button' -->
                                        <?php if($phanquyenmodel->getTinhTrang('S',$phanquyenmodel->getIdChucnangbyTenChucnang("Quản lý sản phẩm"),$phanquyenmodel->getmaQuyenbyId($id))){ ?>
                                        <a href="/SaleSphere/VIEWS/admin/admin_home.php?page=quanLySanPham&&luachon=sua&&product_id=<?php echo $product['id']?>" class="link-dark btn btn-success" style="text-align: center; height: 32.5px;" ><i class="fa-solid fa-pen-to-square fs-5"></i></a>
                                        <?php } else {} ?>
                                    </td>
                                </tr>
                            </form>
                        <?php endforeach; ?>
                        
                  <?php  } else {
                        echo "Không có sản phẩm nào";
                    }
                ?>

            </tbody>
        </table>
        </div>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/SaleSphere/STATIC/js/category.js"></script>



</body>
</html>
