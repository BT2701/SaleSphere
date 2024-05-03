<?php require_once 'C:\xampp\htdocs\web2\CONTROLLER\SanPhamController.php';
    require_once 'C:\xampp\htdocs\web2\CONTROLLER\NhapHangController.php';
    
    $listDetail=$nhapHangController->layDsChiTietPhieuNhap();
    
?>
<div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Chi tiết phiếu nhập</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row" style="max-width: 100%; width: 100%; margin:0;">
                    <div class="table-wrapper">

                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Tên Sản Phẩm</th>
                                    <th scope="col">Số lượng</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listDetail as $item){?>
                                <form action="/web2/CONTROLLER/NhapHangController.php" method="post" id="myForm">
                                    <tr>
                                        <td>
                                            <img src="<?php echo $controller->getById($item['idSanPham'])['src']; ?>" id="product-image" alt="">
                                        </td>
                                        <td>

                                        <?php echo $controller->getById($item['idSanPham'])['tenSanPham']; ?>
                                        </td>
                                        <td>
                                            <?php echo $item['soLuong']; ?>
                                        </td>



                                    </tr>
                                </form>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Đóng</button>

            </div>
        </div>
    </div>
</div>