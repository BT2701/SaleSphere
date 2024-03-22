<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/web2/STATIC/css/index.css">
    <link rel="stylesheet" href="/web2/STATIC/css/category.css">
    <title>G1's Shop</title>
</head>

<body>
    <?php
    require_once 'C:\xampp\htdocs\web2\CONTROLLER\SanPhamController.php';
    $sanphamController = new SanPhamController();
    $sanphamList = $sanphamController->getDataForView();
    ?>
    <!-- category -->
    <section class="category">
        <div class="container">
            <div class="category-top">
                <a href="/web2/index.php"><i class="fa-solid fa-arrow-left"></i>Trang chủ</a>
            </div>
        </div>
        <div class="category-right">
            <div class="category-right-top-items">
                <p id="category-tittle">DANH MỤC SẢN PHẨM</p>
            </div>
            <div class="category-right-top-items">
                <button><span>Bộ lọc</span><i class="fa-solid fa-sort-down"></i></button>
            </div>
            <div class="category-right-top-items">
                <select name="" id="">
                    <option value="">Sắp xếp</option>
                    <option value="">Giá cao đến thấp</option>
                    <option value="">Giá thấp đến cao</option>
                </select>
            </div>
        </div>
        <div class="product-gallery-content-product">
           <?php if(isset($sanphamList) && !empty($sanphamList)) {?>
            <?php foreach ($sanphamList as $sanpham): ?>
                <div class="product-gallery-content-product-item">
                <img src="<?php echo $sanpham['src']; ?>" alt="">
                <div class="product-gallery-content-product-text">
                    <li><img src="/web2/STATIC/assets/icon-percent.webp" alt="">
                        <p>Trợ giá mùa dịch</p>
                    </li>
                    <li><?php echo $sanpham['tenSanPham']; ?></li>
                    <li>Online giá rẻ</li>
                    <li><a href=""><?php echo $sanpham['giaBan']; ?> <sup>đ</sup></a><span>-<?php if($sanpham['giaTri']!=null){echo $sanpham['giaTri'];}else{echo "0";} ?>%</span></li>
                    <li><?php if($sanpham['giaTri']!=null){
                        $value=$sanpham['giaBan'];
                        $khuyenmai=$sanpham['giaTri'];
                        $giaban= $value - $value *$khuyenmai/100;
                        echo $giaban;}else{echo $sanpham['giaBan'];} ?> <sup>đ</sup></li>
                    <li>
                        <?php
                        if ($sanpham['star']!=null){
                            for ($i=0;$i<$sanpham['star'];$i++){
                                echo '<i class="fa-solid fa-star"></i>';
                            }
                        }
                        ?>
                    </li>
                </div>
            </div>
            <?php endforeach; ?>
            <?php }else{
                echo "không có sản phẩm nào";
            } ?>
        </div>
        <div class="category-bottom">
            <div class="category-bottom-items">
                <p>Hiển thị 2 <span>|</span>4 Sản phẩm</p>
            </div>
            <div class="category-bottom-items">
                <p><span>&#171;</span>1 2 3 4 5 <span>&#187;	</span>Trang cuối</p>
            </div>
        </div>
    </section>

    
</body>
<script src="/web2/STATIC/js/category.js"></script>
<script src="/web2/STATIC/js/index.js"></script>
</html>