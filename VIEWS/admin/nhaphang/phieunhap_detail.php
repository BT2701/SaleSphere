<?php require_once __DIR__.'\..\..\..\CONTROLLER\SanPhamController.php';
    require_once __DIR__.'\..\..\..\CONTROLLER\NhapHangController.php';
    
    // $listDetail=$nhapHangController->layDsChiTietPhieuNhap();
    $controller = new NhapHangController();
    
?>
<div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Chi tiết phiếu nhập</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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
                            <tbody id="containdetailphieunhap"">
                               
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>

            </div>
        </div>
    </div>
</div>
<script src="../../STATIC/js/nhaphang.js"></script>