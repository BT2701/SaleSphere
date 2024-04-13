<!DOCTYPE html>
<html lang="en">

<head?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="STATIC/css/product-detailStyle.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    </head>

    <body>
        <!-- ------------------------Du------------------ -->
        <?php
        require_once ("./CONTROLLER/SanPhamController.php");
        // require_once ("./CONTROLLER/DanhGiaController.php");
        require_once ("./HELPER/BaseFunction.php");
        $idUser = 1;
        if (isset($_GET['id'])) {
            $sanphamController = new SanPhamController();
            $idSanPham = $_GET['id'];
            $chiTietSanPham = $sanphamController->detailProduct($idSanPham);
            $tenSanPham = $chiTietSanPham['tenSanPham'];
            $giaGoc = $chiTietSanPham['giaBan'];
            $moTaSanPham = $chiTietSanPham['moTa'];
            $donViTinh = $chiTietSanPham['tenDonViTinh'];
            $giaTriKhuyenMai = $sanphamController->sumOfValueDiscount($idSanPham);
            $giaKhuyenMai = $giaGoc - $giaGoc * ($giaTriKhuyenMai / 100);
            $soLuongSanPham = $sanphamController->quantityProduct($idSanPham);
            $soLuongDaBan = $sanphamController->quantityOfProductsSold($idSanPham);
            $soLuongDanhGiaTatCa = $sanphamController->countOfEvaluate($idSanPham, "_");
            $soLuongDanhGia5Sao = $sanphamController->countOfEvaluate($idSanPham, "5");
            $soLuongDanhGia4Sao = $sanphamController->countOfEvaluate($idSanPham, "4");
            $soLuongDanhGia3Sao = $sanphamController->countOfEvaluate($idSanPham, "3");
            $soLuongDanhGia2Sao = $sanphamController->countOfEvaluate($idSanPham, "2");
            $soLuongDanhGia1Sao = $sanphamController->countOfEvaluate($idSanPham, "1");
            $danhGiaTrungBinh = $sanphamController->avgOfStarEvaluate($idSanPham);
        }
        ?>
        <!-- ------------------------Du------------------ -->
        <section class="product-detail_wraper">
            <div class="container">
                <div class="row pb-5 pt-3">
                    <div class="col-lg-5 col-12">
                        <img src="<?php echo $chiTietSanPham['src'] ?>" class="product-detail_image"
                            alt="product image for detail">
                        <!-- <div class="product-detail_list-image ">
                        <div class="image-item image-item1"
                            onmouseover="show_product_detail('image-item1','STATIC/assets/flower1.jpg')" style="">
                            <img src="STATIC/assets/flower1.jpg" alt="">
                        </div>
                        <div class="image-item image-item2"
                            onmouseover="show_product_detail('image-item2','STATIC/assets/flower2.jpg')" style="">
                            <img src="STATIC/assets/flower2.jpg" alt="">
                        </div>
                        <div class="image-item image-item3"
                            onmouseover="show_product_detail('image-item3','STATIC/assets/flower3.jpg')" style="">
                            <img src="STATIC/assets/flower3.jpg" alt="">
                        </div>
                        <div class="image-item image-item4"
                            onmouseover="show_product_detail('image-item4','STATIC/assets/flower4.jpg')" style="">
                            <img src="STATIC/assets/flower4.jpg" alt="">
                        </div>
                    </div> -->
                    </div>
                    <div class="col-lg-7 col-12 mt-5 mt-lg-0 product-detail">
                        <span class="product-name">
                            <?php echo $tenSanPham ?>
                        </span>
                        <div class="product-info">
                            <div class="rating-info">
                                <a href="#user-evaluate-container" class="number-rating">
                                    <?php echo roundToNearestTenth($danhGiaTrungBinh) ?>
                                </a>
                                <div class="avarage-star-container"></div>
                            </div>
                            <span class="sperate"></span>
                            <div class="feedback">
                                <a href="#user-evaluate-container" class="number-feedback">
                                    <?php echo $soLuongDanhGiaTatCa ?>
                                </a>
                                Đánh giá
                            </div>
                            <span class="sperate"></span>
                            <div class="sold">
                                <?php echo $soLuongDaBan ?> Đã bán
                            </div>
                        </div>
                        <div class="product-price">
                            <!-- case has giaTriKhuyenMai  -->
                            <div class="has-discount">
                                <div class="original-price">
                                    <?php
                                    if ($giaTriKhuyenMai == 0) {
                                        echo "";
                                    } else {
                                        echo (formatMoney($giaGoc) . "đ");
                                    }
                                    ?>
                                </div>
                                <div class="discount-price">
                                    <?php
                                    echo formatMoney($giaKhuyenMai) . "đ";
                                    ?>
                                </div>
                                <div class="percent-discount">
                                    <?php
                                    if ($giaTriKhuyenMai == 0) {
                                        echo "";
                                    } else {
                                        echo $giaTriKhuyenMai . "% GIẢM";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="product-discription">
                            <?php echo $moTaSanPham ?>
                        </div>


                        <div class="case-has-quantity">
                            <div class="quantity">
                                <label for="quantity" class="quantity-title">Số lượng</label>
                                <button class="quantity-btn" onclick="decreaseQuantity()">-</button>
                                <input class="quantity-input" type="number" id="quantityInput" name="quantityInput"
                                    value="1" min="1" max="<?php echo $soLuongSanPham ?>"
                                    oninput="validity.valid||(value='');">
                                <button class="quantity-btn"
                                    onclick="increaseQuantity(<?php echo $soLuongSanPham ?>)">+</button>
                                <label for="" class="quantity-current">Còn
                                    <?php echo $soLuongSanPham . " " . $donViTinh ?>
                                </label>
                            </div>

                            <button class="btn-add-product"
                                onclick="AddProductToCart(<?php echo $idSanPham ?>,<?php echo $idUser ?>,<?php echo $soLuongSanPham ?>)">
                                <i class="fa-solid fa-cart-plus"></i>
                                Thêm vào giỏ hàng
                            </button>

                            <button class="btn-add-product">
                                Mua ngay
                            </button>
                        </div>

                        <div class="case-none-quantity">
                            <div class="alert alert-info mt-3" role="alert">
                                Sản phẩm đã hết hàng !
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="product-evaluation">
            <div class="container">
                <h2 class="mt-5 mb-4">Đánh giá sản phẩm</h2>

                <!-- Average star rating and filter buttons -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="average-rating">
                        <strong>
                            <?php echo roundToNearestTenth($danhGiaTrungBinh) . " trên 5" ?>
                        </strong>
                        <div class="avarage-star-container"></div>
                    </div>

                    <!-- Filter buttons as dropdown on small screens -->
                    <div class="filter-buttons d-none d-md-block">
                        <button type="button" class="btn btn-primary"
                            onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'_',<?php echo $soLuongDanhGiaTatCa ?>, 5)">Tất
                            cả</button>
                        <button type="button" class="btn btn-primary"
                            onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'5',<?php echo $soLuongDanhGia5Sao ?>, 5)">5
                            sao</button>
                        <button type="button" class="btn btn-primary"
                            onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'4',<?php echo $soLuongDanhGia4Sao ?>, 5)">4
                            sao</button>
                        <button type="button" class="btn btn-primary"
                            onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'3',<?php echo $soLuongDanhGia3Sao ?>, 5)">3
                            sao</button>
                        <button type="button" class="btn btn-primary"
                            onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'2',<?php echo $soLuongDanhGia2Sao ?>, 5)">2
                            sao</button>
                        <button type="button" class="btn btn-primary"
                            onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'1',<?php echo $soLuongDanhGia1Sao ?>, 5)">1
                            sao</button>
                    </div>
                    <!-- Filter buttons as dropdown on small screens -->
                    <!--  -->
                    <div class="dropdown  d-md-none ">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Filter
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><button class="dropdown-item" onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'_',<?php echo $soLuongDanhGiaTatCa ?>, 5)">Tất cả</button></li>
                            <li><button class="dropdown-item"
                                    onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'5',<?php echo $soLuongDanhGia5Sao ?>, 5)">5
                                    sao</button>
                            </li>

                            <li><button class="dropdown-item"
                                    onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'4',<?php echo $soLuongDanhGia4Sao ?>, 5)">4
                                    sao</button>
                            </li>
                            <li><button class="dropdown-item"
                                    onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'3',<?php echo $soLuongDanhGia3Sao ?>, 5)">3
                                    sao</button>
                            </li>
                            <li><button class="dropdown-item"
                                    onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'2',<?php echo $soLuongDanhGia2Sao ?>, 5)">2
                                    sao</button>
                            </li>
                            <li><button class="dropdown-item"
                                    onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'1',<?php echo $soLuongDanhGia1Sao ?>, 5)">1
                                    sao</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col user-evaluate-container" id="user-evaluate-container">
                        <div class="case-none-evaluate text-center">

                        </div>
                        <div class="case-has-evaluate">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Phân trang  -->
            <div class="container">
                <nav aria-label="Page navigation -flex">
                    <ul class="pagination justify-content-center"></ul>
                </nav>
            </div>
        </section>
    </body>


    <script src="STATIC/js/productdetail.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", xuLyPhanTrang(<?php echo $idSanPham ?>, "_", <?php echo $soLuongDanhGiaTatCa ?>, 5), checkQuantity(<?php echo $soLuongSanPham ?>));
        hienthisaotrungbinh(<?php echo roundToNearestTenth($danhGiaTrungBinh) ?>);
    </script>
</html>