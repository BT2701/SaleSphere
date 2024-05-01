<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/web2/STATIC/css/category.css">
    <link rel="stylesheet" href="/web2/STATIC/css/nhaphang.css">
    <title>Quản lý nhập hàng</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS để tùy chỉnh một số phần trên trang -->
</head>
<body>
    <?php 
        if(isset($_GET['luachon'])&&$_GET['luachon']=='giohang'){
            include 'giohang.php';
        }
        else{

        
    ?>

    <?php require_once 'C:\xampp\htdocs\web2\CONTROLLER\SanPhamController.php';
        require_once 'C:\xampp\htdocs\web2\CONTROLLER\NhapHangController.php'; 
        $products = $controller->getList(PHP_INT_MAX);
        $count=$nhapHangController->countGioHangNhap();
    ?>
    <div class="container mt-5">
        <!-- Form for adding a new product -->
        
        <!-- Table to display products -->
        <div class="main">
            <h2 class="mt-5">Nhập hàng</h2>
            <div class="main-detail">
                <div class="cart-icon">
                    <a href="/web2/VIEWS/admin/admin_home.php?page=quanLyNhapHang&&luachon=giohang" id="cart"><i class="fa-solid fa-cart-shopping" style="font-size:30px;"></i></a>
                    <span class="item-count"><?php echo $count; ?></span> <!-- Số lượng hiển thị -->
                    
                </div>
                <div class="details">
                    <a href="#" id="history"><i class="fa-solid fa-list" style="font-size:30px;"></i></a>
                </div>
            </div>
        </div>
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
            <div class="table-wrapper">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>id</th>
                    <th>Hình ảnh</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá nhập</th>
                    <th>Giá bán</th>
                    <th>Tồn kho</th>
                    <th>Thêm vào giỏ</th>
                </tr>
            </thead>
            <tbody>
                
                <?php foreach ($products as $product): ?>
                    <form action="\web2\CONTROLLER\NhapHangController.php" method="post" enctype="multipart/form-data">
                    <tr>
                        <td>
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <?php echo $product['id']; ?>
                        </td>
                        <td><img src="<?php echo $product['src']; ?>" alt="Product Image" class="product-image"></td>
                        <td><?php echo $product['tenSanPham']; ?></td>
                        <td><?php echo $product['giaNhap']; ?></td>
                        <td><?php echo $product['giaBan']; ?></td>
                        <td><?php echo $controller->quantityProduct($product['id']); ?></td>
                        <td>
                            <button type="submit" name="themgiohangnhap" class="btn btn-success add-to-cart-btn">+</button>
                        </td>
                    </tr>
                    </form>
                <?php endforeach; ?>
                
            </tbody>
        </table>
        </div>
    </div>
    <!-- Bootstrap JS and jQuery -->
    <script src="/web2/STATIC/js/category.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php } ?>
</body>
</html>
