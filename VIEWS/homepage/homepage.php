<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/web2/STATIC/css/index.css">
    <title>G1's Shop</title>
</head>

<body>
<?php
    require_once 'C:\xampp\htdocs\web2\CONTROLLER\SanPhamController.php';
    $sanphamController = new SanPhamController();
    $sanphamList = $sanphamController->getDataForView();
    $sanphamListnoibac = $sanphamController->getDataForViewNoiBac();
    ?>
    <section id="slider">
        <div class="aspect-ratio-169">
            <img src="/web2/STATIC/assets/poster.png">
            <img src="/web2/STATIC/assets/poster2.png">
            <img src="/web2/STATIC/assets/poster3.png">
            <img src="/web2/STATIC/assets/poster4.png">
        </div>
        <div class="dot-container">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </section>

    <!-- slider-product -->

    <section class="first-slider-product">
        <div class="product-container">
            <div class="content">
                <div class="title">
                    <h2 id="title-slider-product">
                        Săn sale online mỗi ngày
                    </h2>
                </div>

                <!-- khu vực đẩy sản phẩm mà trong bảng chi tiết sản phâm có giảm giá -->
                <div class="slider-product-container">
                    <div class="slider-product-items-parent">
                        <div class="slider-product-items">
                            
                        <?php if(isset($sanphamListnoibac) && !empty($sanphamListnoibac)) {?>
            <?php foreach ($sanphamListnoibac as $sanpham): ?>
                <div class="slider-product-item">
                <img src="<?php echo $sanpham['src']; ?>" alt="">
                
                <div class="slider-product-text" >
                <?php if ($sanpham['tenKhuyenMai']!=null){ ?>
                    <?php if ($sanpham['background']!=null){ ?>
                    <li style="background-color:<?php echo  $sanpham['background'];  }?>;"><img src="/web2/STATIC/assets/icon-percent.webp" alt="">
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
                        if ($sanpham['star']!=null){
                            for ($i=0;$i<$sanpham['star'];$i++){
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
                            <div class="slider-product-item">
                                <img src="/web2/STATIC/assets/product3.png" alt="">
                                <div class="slider-product-text">
                                    <li><img src="/web2/STATIC/assets/icon-percent.webp" alt="">
                                        <p>Trợ giá mùa dịch</p>
                                    </li>
                                    <li>Áo Blazer nam form tiêu chuẩn</li>
                                    <li>Online giá rẻ</li>
                                    <li><a href="">169.000 <sup>đ</sup></a><span>-6%</span></li>
                                    <li>150.000 <sup>đ</sup></li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                </div>
                            </div>
                            <div class="slider-product-item">
                                <img src="/web2/STATIC/assets/product3.png" alt="">
                                <div class="slider-product-text">
                                    <li><img src="/web2/STATIC/assets/icon-percent.webp" alt="">
                                        <p>Trợ giá mùa dịch</p>
                                    </li>
                                    <li>Áo Blazer nam form tiêu chuẩn</li>
                                    <li>Online giá rẻ</li>
                                    <li><a href="">169.000 <sup>đ</sup></a><span>-6%</span></li>
                                    <li>150.000 <sup>đ</sup></li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                </div>
                            </div>
                            <div class="slider-product-item">
                                <img src="/web2/STATIC/assets/product3.png" alt="">
                                <div class="slider-product-text">
                                    <li><img src="/web2/STATIC/assets/icon-percent.webp" alt="">
                                        <p>Trợ giá mùa dịch</p>
                                    </li>
                                    <li>Áo Blazer nam form tiêu chuẩn</li>
                                    <li>Online giá rẻ</li>
                                    <li><a href="">169.000 <sup>đ</sup></a><span>-6%</span></li>
                                    <li>150.000 <sup>đ</sup></li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                </div>
                            </div>
                            <div class="slider-product-item">
                                <img src="/web2/STATIC/assets/product3.png" alt="">
                                <div class="slider-product-text">
                                    <li><img src="/web2/STATIC/assets/icon-percent.webp" alt="">
                                        <p>Trợ giá mùa dịch</p>
                                    </li>
                                    <li>Áo Blazer nam form tiêu chuẩn</li>
                                    <li>Online giá rẻ</li>
                                    <li><a href="">169.000 <sup>đ</sup></a><span>-6%</span></li>
                                    <li>150.000 <sup>đ</sup></li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                </div>
                            </div>
                        </div>
                        <div class="slider-product-items">
                            <div class="slider-product-item">
                                <img src="/web2/STATIC/assets/product3.png" alt="">
                                <div class="slider-product-text">
                                    <li><img src="/web2/STATIC/assets/icon-percent.webp" alt="">
                                        <p>Trợ giá mùa dịch</p>
                                    </li>
                                    <li>Áo Blazer nam form tiêu chuẩn</li>
                                    <li>Online giá rẻ</li>
                                    <li><a href="">169.000 <sup>đ</sup></a><span>-6%</span></li>
                                    <li>150.000 <sup>đ</sup></li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                </div>
                            </div>
                            <div class="slider-product-item">
                                <img src="/web2/STATIC/assets/product3.png" alt="">
                                <div class="slider-product-text">
                                    <li><img src="/web2/STATIC/assets/icon-percent.webp" alt="">
                                        <p>Trợ giá mùa dịch</p>
                                    </li>
                                    <li>Áo Blazer nam form tiêu chuẩn</li>
                                    <li>Online giá rẻ</li>
                                    <li><a href="">169.000 <sup>đ</sup></a><span>-6%</span></li>
                                    <li>150.000 <sup>đ</sup></li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                </div>
                            </div>
                            <div class="slider-product-item">
                                <img src="/web2/STATIC/assets/product3.png" alt="">
                                <div class="slider-product-text">
                                    <li><img src="/web2/STATIC/assets/icon-percent.webp" alt="">
                                        <p>Trợ giá mùa dịch</p>
                                    </li>
                                    <li>Áo Blazer nam form tiêu chuẩn</li>
                                    <li>Online giá rẻ</li>
                                    <li><a href="">169.000 <sup>đ</sup></a><span>-6%</span></li>
                                    <li>150.000 <sup>đ</sup></li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                </div>
                            </div>
                            <div class="slider-product-item">
                                <img src="/web2/STATIC/assets/product3.png" alt="">
                                <div class="slider-product-text">
                                    <li><img src="/web2/STATIC/assets/icon-percent.webp" alt="">
                                        <p>Trợ giá mùa dịch</p>
                                    </li>
                                    <li>Áo Blazer nam form tiêu chuẩn</li>
                                    <li>Online giá rẻ</li>
                                    <li><a href="">169.000 <sup>đ</sup></a><span>-6%</span></li>
                                    <li>150.000 <sup>đ</sup></li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                </div>
                            </div>
                            <div class="slider-product-item">
                                <img src="/web2/STATIC/assets/product3.png" alt="">
                                <div class="slider-product-text">
                                    <li><img src="/web2/STATIC/assets/icon-percent.webp" alt="">
                                        <p>Trợ giá mùa dịch</p>
                                    </li>
                                    <li>Áo Blazer nam form tiêu chuẩn</li>
                                    <li>Online giá rẻ</li>
                                    <li><a href="">169.000 <sup>đ</sup></a><span>-6%</span></li>
                                    <li>150.000 <sup>đ</sup></li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                </div>
                            </div>
                        </div>
                        <div class="slider-product-items">
                            <div class="slider-product-item">
                                <img src="/web2/STATIC/assets/product3.png" alt="">
                                <div class="slider-product-text">
                                    <li><img src="/web2/STATIC/assets/icon-percent.webp" alt="">
                                        <p>Trợ giá mùa dịch</p>
                                    </li>
                                    <li>Áo Blazer nam form tiêu chuẩn</li>
                                    <li>Online giá rẻ</li>
                                    <li><a href="">169.000 <sup>đ</sup></a><span>-6%</span></li>
                                    <li>150.000 <sup>đ</sup></li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                </div>
                            </div>
                            <div class="slider-product-item">
                                <img src="/web2/STATIC/assets/product3.png" alt="">
                                <div class="slider-product-text">
                                    <li><img src="/web2/STATIC/assets/icon-percent.webp" alt="">
                                        <p>Trợ giá mùa dịch</p>
                                    </li>
                                    <li>Áo Blazer nam form tiêu chuẩn</li>
                                    <li>Online giá rẻ</li>
                                    <li><a href="">169.000 <sup>đ</sup></a><span>-6%</span></li>
                                    <li>150.000 <sup>đ</sup></li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                </div>
                            </div>
                            <div class="slider-product-item">
                                <img src="/web2/STATIC/assets/product3.png" alt="">
                                <div class="slider-product-text">
                                    <li><img src="/web2/STATIC/assets/icon-percent.webp" alt="">
                                        <p>Trợ giá mùa dịch</p>
                                    </li>
                                    <li>Áo Blazer nam form tiêu chuẩn</li>
                                    <li>Online giá rẻ</li>
                                    <li><a href="">169.000 <sup>đ</sup></a><span>-6%</span></li>
                                    <li>150.000 <sup>đ</sup></li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                </div>
                            </div>
                            <div class="slider-product-item">
                                <img src="/web2/STATIC/assets/product3.png" alt="">
                                <div class="slider-product-text">
                                    <li><img src="/web2/STATIC/assets/icon-percent.webp" alt="">
                                        <p>Trợ giá mùa dịch</p>
                                    </li>
                                    <li>Áo Blazer nam form tiêu chuẩn</li>
                                    <li>Online giá rẻ</li>
                                    <li><a href="">169.000 <sup>đ</sup></a><span>-6%</span></li>
                                    <li>150.000 <sup>đ</sup></li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                </div>
                            </div>
                            <div class="slider-product-item">
                                <img src="/web2/STATIC/assets/product3.png" alt="">
                                <div class="slider-product-text">
                                    <li><img src="/web2/STATIC/assets/icon-percent.webp" alt="">
                                        <p>Trợ giá mùa dịch</p>
                                    </li>
                                    <li>Áo Blazer nam form tiêu chuẩn</li>
                                    <li>Online giá rẻ</li>
                                    <li><a href="">169.000 <sup>đ</sup></a><span>-6%</span></li>
                                    <li>150.000 <sup>đ</sup></li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slider-product-btn">
                        <i class="fas fa-chevron-left"></i>
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- product gallery -->


    <!-- khu vực đẩy 5 sản phẩm có lượt bán cao nhất trong hóa đơn  -->
    <section class="product-gallery-one">
        <div class="container">
            <div class="product-gallery-content">
                <div class="product-gallery-tittle">
                    <h2>SẢN PHẨM NỔI BẬT NHẤT</h2>
                    <ul>
                        <li><a href="">Catgories</a></li>
                        <li><a href="">Catgories</a></li>
                        <li><a href="">Tất cả</a></li>
                    </ul>
                </div>
                <div class="product-gallery-content-product">
                <?php if(isset($sanphamListnoibac) && !empty($sanphamListnoibac)) {?>
            <?php foreach ($sanphamListnoibac as $sanpham): ?>
                <div class="product-gallery-content-product-item">
                <img src="<?php echo $sanpham['src']; ?>" alt="">
                
                <div class="product-gallery-content-product-text" >
                <?php if ($sanpham['tenKhuyenMai']!=null){ ?>
                    <?php if ($sanpham['background']!=null){ ?>
                    <li style="background-color:<?php echo  $sanpham['background'];  }?>;"><img src="/web2/STATIC/assets/icon-percent.webp" alt="">
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
                        if ($sanpham['star']!=null){
                            for ($i=0;$i<$sanpham['star'];$i++){
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
            </div>
        </div>
    </section>


    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
    const imgPosition = document.querySelectorAll(".aspect-ratio-169 img")
    const imgContainer = document.querySelector('.aspect-ratio-169')
    const dotItem = document.querySelectorAll(".dot")
    const header = document.querySelector(".header-style")
    let imgNumber = imgPosition.length
    let index = 0
    imgPosition.forEach(function (image, index) {
        image.style.left = index * 100 + "%"
        dotItem[index].addEventListener("click", function () {
            slider(index)
        })
    })
    function imgSlide() {
        index++;
        if (index >= imgNumber) {
            index = 0;
        }
        slider(index)

    }
    function slider(index) {
        imgContainer.style.left = "-" + index * 100 + "%"
        const dotActive = document.querySelector(".active")
        dotActive.classList.remove("active")
        dotItem[index].classList.add("active")
    }
    setInterval(imgSlide, 3000)
    window.addEventListener("scroll", function () {
        x = window.pageYOffset
        if (x > 0) {
            header.classList.add("sticky")
        }
        else {
            header.classList.remove("sticky")
        }
    })

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<script src="/web2/STATIC/js/index.js"></script>

</html>