<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Giỏ Hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .container {
            max-width: 100%; /* giới hạn chiều rộng của container */
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .row{
            display: flex;
            max-width: 100%;
            justify-content: center;
            width: 100%;
        }

        /* Đảm bảo container không bị nhảy lên khi màn hình nhỏ hơn */
        @media (max-width: 800px) {
            .container {
                max-width: 100%;
            }
        }
    </style>
    <!-- Thêm icon của Font Awesome -->
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <h2>Giỏ Hàng</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên Sản Phẩm</th>
                            <th scope="col">Số Lượng</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Thành Tiền</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Áo Polo</td>
                            <td>
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="button">-</button>
                                    <input type="text" class="form-control" value="2">
                                    <button class="btn btn-outline-secondary" type="button">+</button>
                                </div>
                            </td>
                            <td>$20</td>
                            <td>$40</td>
                            <td><i class="fas fa-times text-danger"></i></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Quần Jean</td>
                            <td>
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="button">-</button>
                                    <input type="text" class="form-control" value="1">
                                    <button class="btn btn-outline-secondary" type="button">+</button>
                                </div>
                            </td>
                            <td>$30</td>
                            <td>$30</td>
                            <td><i class="fas fa-times text-danger"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
        <div class="col-md-4">
                <h3>Tổng thanh toán: $75</h3>

                <button class="btn btn-success">Thanh Toán</button>
                <button class="btn btn-danger float-right">Đóng</button>
            </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
