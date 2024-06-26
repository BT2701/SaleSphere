<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/SaleSphere/STATIC/css/index.css">
    <link rel="stylesheet" href="/SaleSphere/STATIC/css/category.css">
    <title>G1's Shop</title>
</head>

<body>
    <?php
    require_once __DIR__.'\..\..\CONTROLLER\SanPhamController.php';
    $sanphamList = $controller->getDataForView();

    require_once __DIR__.'\..\..\CONTROLLER\LoaiSPController.php';
    $categoryController = new LoaiSPController();
    $categoryList = $categoryController->getCategoryList();
    ?>
    <!-- category -->
    <section class="category">
        <div class="container">
            
        </div>
        <div class="category-right">
            <div class="category-right-top-items">
                <p id="category-tittle">DANH MỤC SẢN PHẨM</p>
            </div>
            
            <div class="input-group" style="max-width: 250px; max-height: 50px;">
                <input type="text" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="searchButton" id="searchInput">
                <button class="btn btn-outline-secondary bg-dark" type="button" id="searchButton">
                    <i class="fas fa-search"></i>
                </button>

                    </div>
            <div class="category-right-top-items">
                
                <select name="" id="" onchange="loadProducts(this.value)">
                    <option value="Tất cả sản phẩm">Tất cả sản phẩm</option>
                    <?php if (isset($categoryList) && !empty($categoryList)): ?>
                                <?php foreach ($categoryList as $cate): ?>
                                    <option value="<?php echo $cate['id']; ?>" ><?php echo $cate['tenLoaiSP']; ?></option>
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
        <div class="product-gallery-content-product" id="productList">
        <?php if(isset($sanphamList) && !empty($sanphamList)) {?>
            <?php foreach ($sanphamList as $sanpham): ?>
                <div class="product-gallery-content-product-item" onclick="test(<?php echo $sanpham['id']; ?>)">
                <div class="split-img">
                <img src="<?php echo $sanpham['src']; ?>" alt="" class="image-product-vip">
                </div>
                <div class="product-gallery-content-product-text" >
                <?php if ($sanpham['tenKhuyenMai']!=null && (strtotime($sanpham['hansudung'])>time() || strtotime($sanpham['hansudung'])==null)){ ?>
                    <?php if ($sanpham['background']!=null){ ?>
                    <li style="background-color:<?php echo  $sanpham['background'];  }?>;"><img src="/SaleSphere/STATIC/assets/icon-percent.webp" alt="">
                        <p><?php 
                            echo $sanpham['tenKhuyenMai'];
                            ?></p>
                    </li>
                    <?php }
                    else{
                        echo '<li style="background-color: #fcfcfc;"></li>';
                    }?>
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
                        if ($sanpham['TrungBinhStar']!=null){
                            for ($i=0;$i<$sanpham['TrungBinhStar'];$i++){
                                echo '<i class="fa-solid fa-star" style="color: #FB6E2E;"></i>';
                            }
                        }
                        ?>
                    </li>
                    <li>
                        
                        <p style="color: gray;">Đã bán <?php if($sanpham['TongSoLuongBanDuoc']!=null){echo$sanpham['TongSoLuongBanDuoc'];}
                        else{
                            echo "0";
                        }?></p>
                    </li>
                </div>
            </div>
            <?php endforeach; ?>
            <?php }else{
                echo "không có sản phẩm nào";
            } ?>
                </div>
        <div class="category-bottom">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center" id="pagination" >
                    
                </ul>
            </nav>
        </div>
    </section>

    <script>
        var soLuongSpDB=<?php echo $controller->getSoLuongSP(); ?>;
    </script>
    <script src="/SaleSphere/STATIC/js/category.js"></script>
    <script src="/SaleSphere/STATIC/js/index.js"></script>
    <script>

        //FUNCTION REPLACE URL VÀ RELOAD
        function test(idProduct){
            // location.assign("http://localhost/SaleSphere/index.php?page=productdetail");
            window.location.replace(`http://localhost/SaleSphere/index.php?page=productdetail&id=${idProduct}`);
        }
    </script>
</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
</html>