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
        require_once ("./HELPER/BaseFunction.php");
        ?>
        <!-- ------------------------Du------------------ -->
        <section class="product-detail_wraper">
            <div class="container">
                <div class="row pb-5 pt-3">
                    <div class="col-lg-5 col-12">
                        <img src="<?php echo $detailProduct['infoProduct']['src'] ?>" class="product-detail_image"
                            alt="product image for detail">
                    </div>
                    <div class="col-lg-7 col-12 mt-5 mt-lg-0 product-detail">
                        <span class="product-name">
                            <?php echo $detailProduct['infoProduct']['tenSanPham'] ?>
                        </span>
                        <div class="product-info">
                            <div class="rating-info">
                                <a href="#user-evaluate-container" class="number-rating">
                                    <?php echo roundToNearestTenth($detailProduct['avgEvaluate']) ?>
                                </a>
                                <div class="avarage-star-container"></div>
                            </div>
                            <span class="sperate"></span>
                            <div class="feedback">
                                <a href="#user-evaluate-container" class="number-feedback">
                                    <?php echo $detailProduct['quantityEvaluateAll']?>
                                </a>
                                Đánh giá
                            </div>
                            <span class="sperate"></span>
                            <div class="sold">
                                <?php echo $detailProduct['quantityEvaluateAll'] ?> Đã bán
                            </div>
                        </div>
                        <div class="product-price">
                            <!-- case has giaTriKhuyenMai  -->
                            <div class="has-discount">
                                <div class="original-price">
                                    <?php
                                    if ($detailProduct['valueDiscount']  == 0) {
                                        echo "";
                                    } else {
                                        echo (formatMoney($detailProduct['infoProduct']['giaBan']) . "đ");
                                    }
                                    ?>
                                </div>
                                <div class="discount-price">
                                    <?php
                                    echo formatMoney($detailProduct['discountPrice']) . "đ";
                                    ?>
                                </div>
                                <div class="percent-discount">
                                    <?php
                                    if ($detailProduct['valueDiscount'] == 0) {
                                        echo "";
                                    } else {
                                        echo $detailProduct['valueDiscount'] . "% GIẢM";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="product-discription">
                            <?php echo $detailProduct['infoProduct']['moTa'] ?>
                        </div>


                        <div class="case-has-quantity">
                            <div class="quantity">
                                <label for="quantity" class="quantity-title" >Số lượng</label>
                                <button class="quantity-btn" id="quantity-btn-decrease" onclick="decreaseQuantity()">-</button>
                                <input class="quantity-input"  type="number" id="quantityInput" name="quantityInput"
                                    value="1" min="1" max= <?php echo $detailProduct['quantityProductBaseOnUserID'] ?>
                                    oninput="validity.valid||(value='');">
                                <button class="quantity-btn" id="quantity-btn-increase"
                                    onclick="increaseQuantity(<?php echo $detailProduct['quantityProductBaseOnUserID'] ?>)">+</button>
                                <label for="" class="quantity-current">Còn
                                    <?php echo $detailProduct['quantityProductInStore'] . " " . $detailProduct['infoProduct']['tenDonViTinh'] ?>
                                </label>
                            </div>

                            <button class="btn-add-product" id="btn-add-product"
                                onclick="AddProductToCart(<?php echo $idSanPham ?>,<?php echo $idUser ?>, <?php echo $detailProduct['quantityProductBaseOnUserID'] ?>)">
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
                            <?php echo roundToNearestTenth($detailProduct['avgEvaluate']) . " trên 5" ?>
                        </strong>
                        <div class="avarage-star-container"></div>
                    </div>

                    <!-- Filter buttons as dropdown on small screens -->
                    <div class="filter-buttons d-none d-md-block">
                        <button type="button" class="btn btn-primary"
                            onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'_',<?php echo $detailProduct['quantityEvaluateAll'] ?>, 5)">Tất
                            cả</button>
                        <button type="button" class="btn btn-primary"
                            onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'5',<?php echo $detailProduct['quantityEvaluate5Star'] ?>, 5)">5
                            sao</button>
                        <button type="button" class="btn btn-primary"
                            onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'4',<?php echo $detailProduct['quantityEvaluate4Star'] ?>, 5)">4
                            sao</button>
                        <button type="button" class="btn btn-primary"
                            onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'3',<?php echo $detailProduct['quantityEvaluate3Star'] ?>, 5)">3
                            sao</button>
                        <button type="button" class="btn btn-primary"
                            onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'2',<?php echo $detailProduct['quantityEvaluate2Star'] ?>, 5)">2
                            sao</button>
                        <button type="button" class="btn btn-primary"
                            onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'1',<?php echo $detailProduct['quantityEvaluate1Star'] ?>, 5)">1
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
                            <li><button class="dropdown-item" onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'_',<?php echo $detailProduct['quantityEvaluateAll'] ?>, 5)">Tất cả</button></li>
                            <li><button class="dropdown-item"
                                    onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'5',<?php echo $detailProduct['quantityEvaluate5Star'] ?>, 5)">5
                                    sao</button>
                            </li>
                            <li><button class="dropdown-item"
                                    onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'4',<?php echo $detailProduct['quantityEvaluate4Star'] ?>, 5)">4
                                    sao</button>
                            </li>
                            <li><button class="dropdown-item"
                                    onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'3',<?php echo $detailProduct['quantityEvaluate3Star'] ?>, 5)">3
                                    sao</button>
                            </li>
                            <li><button class="dropdown-item"
                                    onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'2',<?php echo $detailProduct['quantityEvaluate2Star'] ?>, 5)">2
                                    sao</button>
                            </li>
                            <li><button class="dropdown-item"
                                    onclick="xuLyPhanTrang(<?php echo $idSanPham ?>,'1',<?php echo $detailProduct['quantityEvaluate1Star'] ?>, 5)">1
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
        document.addEventListener("DOMContentLoaded", xuLyPhanTrang(<?php echo $idSanPham ?>, "_", <?php echo $detailProduct['quantityEvaluateAll'] ?>, 5), checkQuantity(<?php echo $detailProduct['quantityProductInStore']  ?>));
        hienthisaotrungbinh(<?php echo roundToNearestTenth($detailProduct['avgEvaluate']) ?>);
    </script>
</html>