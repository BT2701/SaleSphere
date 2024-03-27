<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/web2/STATIC/css/product-detailStyle.css">
    <title>Document</title>
</head>
<body>
<section class="product-detail_wraper">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-12">
                <img src="/web2/STATIC/assets/product3.png.png" class="product-detail_image" alt="product image for detail">
                <div class="product-detail_list-image ">
                    <div class="image-item image-item1" onmouseover="show_product_detail('image-item1','/web2/STATIC/assets/product3.png')" style="">
                        <img src="/web2/STATIC/assets/product3.png" alt="">
                    </div>
                    <div class="image-item image-item2" onmouseover="show_product_detail('image-item2','/web2/STATIC/assets/product3.png.png')" style="">
                        <img src="/web2/STATIC/assets/product3.png.png" alt="">
                    </div>
                    <div class="image-item image-item3" onmouseover="show_product_detail('image-item3','/web2/STATIC/assets/flower3.jpg')" style="">
                        <img src="/web2/STATIC/assets/flower3.jpg" alt="">
                    </div>
                    <div class="image-item image-item4" onmouseover="show_product_detail('image-item4','/web2/STATIC/assets/flower4.jpg')" style="">
                        <img src="/web2/STATIC/assets/flower4.jpg" alt="">
                    </div>

                </div>
            </div>
            <div class="col-lg-7 col-12 mt-5 mt-lg-0 product-detail">
                <span class="product-name">New All about cocoa chocolate bouquet</span>
                <div class="product-info">
                    <div class="ranting">
                        <a href="#" class="number-rating" >4.9</a>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>

                    <span class="sperate"></span>

                    <div class="feedback">
                        <a href="#" class="number-feedback">200</a>
                        Đánh giá
                    </div>

                    <span class="sperate"></span>

                    <div class="sold">331 Đã bán</div>
                </div>
                <div class="product-price">
                    <!-- case none discount -->
                    <!-- <div class="none-discount">
                        <div class="original-price">$20</div>
                    </div> -->
                    
                    <!-- case has discount  -->
                    <div class="has-discount">
                        <div class="original-price">100.000 đ</div>
                        <div class="discount-price">70.000 đ</div>
                        <div class="percent-discount">30% GIẢM</div>
                    </div>
                </div>

                <div class="product-discription">
                    A Ferrero Rocher bouquet wrapped alongside baby breath and limonium in a luxurious gold wrapping.
                </div>

                
                <div class="quantity">
                    <label for="quantity" class="quantity-title">Số lượng</label>
                    <button class="quantity-btn" onclick="decreaseQuantity()">-</button>
                    <input class="quantity-input"  type="number" id="quantityInput" name="quantityInput" value="1" min="1" oninput="validity.valid||(value='');">
                    <button class="quantity-btn" onclick="increaseQuantity(10)">+</button>
                    <!-- <label for="" class="quantity-current">còn 10 sản phẩm</label> -->
                </div>
                
                <button class="btn-add-product">
                    <i class="fa-solid fa-cart-plus"></i>
                    Thêm vào giỏ hàng
                </button>

                <button class="btn-add-product">
                    Đánh giá sản phẩm
                </button>
            </div>
        </div>
    </div>
</section>
</body>
</html>