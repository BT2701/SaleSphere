<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đánh Giá Sản Phẩm</title>
    
    <!-- Custom CSS -->
    <style>
        .custom-star {
            color: #FFD700; /* Màu vàng */
            font-size: 24px; /* Kích thước lớn hơn */
        }
    </style>
</head>
<body class="bg-info vh-100">

<div class="container mt-5 p-4">
    <h1 class="text-center">Đánh Giá Sản Phẩm</h1>

    <!-- First set of product information and image -->
    <div class="row">
        <div class="col-md-2">
            <!-- Product image -->
            <img src="D:\xampp\htdocs\LOGIN_WEB2\image\th.jpg" class="img-fluid" alt="Product Image">
        </div>
        <div class="col-md-6">
            <!-- Product information -->
            <h2>Tên Sản Phẩm</h2>
            <p>Mô tả ngắn về sản phẩm và các thông tin khác.</p>
            <p>Giá: $X.XX</p>
            <!-- Add any other product information here -->
        </div>
    </div>

    <!-- Đánh giá số sao -->
    <div class="mb-3">
        <label for="starRating" class="form-label">Chọn số sao:</label>
        <select class="form-select" id="starRating">
            <option value="5">5 sao <span class="custom-star">&#9733;&#9733;&#9733;&#9733;&#9733;</span></option>
            <option value="1">1 sao <span class="custom-star">&#9733;</span></option>
            <option value="2">2 sao <span class="custom-star">&#9733;&#9733;</span></option>
            <option value="3">3 sao <span class="custom-star">&#9733;&#9733;&#9733;</span></option>
            <option value="4">4 sao <span class="custom-star">&#9733;&#9733;&#9733;&#9733;</span></option>
        </select>
    </div>

    <!-- Hình ảnh đánh giá -->
    <div class="mb-3">
        <label for="reviewImage" class="form-label">Hình ảnh đánh giá:</label>
        <input type="file" class="form-control" id="reviewImage" multiple>
    </div>

    <!-- Ô textbox đánh giá -->
    <div class="mb-3">
        <label for="reviewText" class="form-label">Nhận xét:</label>
        <textarea class="form-control" id="reviewText" rows="4" placeholder="Viết cảm nhận về sản phẩm của bạn vào đây..."></textarea>
    </div>

    <!-- Nút Gửi Đánh Giá -->
    <button type="button" class="btn btn-primary">Gửi Đánh Giá</button>
</div>


</body>
</html>
