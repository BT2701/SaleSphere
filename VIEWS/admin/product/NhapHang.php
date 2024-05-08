<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
</head>
<body>
    

<div class="modal fade" id="importProductModal" tabindex="-1" role="dialog" aria-labelledby="importProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importProductModalLabel">Nhập hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Số lượng còn lại</th>
                            <th scope="col">Nhập số lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dữ liệu sản phẩm và số lượng còn lại sẽ được thêm vào đây -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="importProductBtn">Nhập hàng</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>