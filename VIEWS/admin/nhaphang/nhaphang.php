<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/web2/STATIC/css/category.css">
    <title>Quản lý nhập hàng</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS để tùy chỉnh một số phần trên trang -->
    <style>
        .product-image{
            width: 100%;
            max-width: 50px;
            max-height: 50px;
            border-radius: 20%;
        }
        .table-wrapper {
            max-height: 60vh; /* Chiều cao cố định */
            overflow-y: auto; /* Hiển thị thanh cuộn dọc khi bảng tràn ra ngoài */
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
</head>
<body>
    <?php require_once 'C:\xampp\htdocs\web2\CONTROLLER\SanPhamController.php'; 
        $products = $controller->getList(PHP_INT_MAX);?>
    <div class="container mt-5">
        <!-- Form for adding a new product -->
        
        <!-- Table to display products -->
        <h2 class="mt-5">Nhập hàng</h2>
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
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Add to Cart</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><img src="<?php echo $product['src']; ?>" alt="Product Image" class="product-image"></td>
                        <td><?php echo $product['tenSanPham']; ?></td>
                        <td><?php echo $product['giaBan']; ?></td>
                        <td><?php echo $controller->quantityProduct($product['id']); ?></td>
                        <td><button type="button" class="btn btn-success add-to-cart-btn">+</button></td>
                    </tr>
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
</body>
</html>
