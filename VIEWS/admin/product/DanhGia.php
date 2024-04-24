<!-- Modal -->
<div class="modal fade" id="productOverviewModal" tabindex="-1" role="dialog"
    aria-labelledby="productOverviewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productOverviewModalLabel">Tổng quan đánh giá sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Đánh giá sao:</h5>
                <!-- Hiển thị sao đánh giá -->
                <div class="star-rating">
                    <!-- Đánh giá sao được đặt dựa vào dữ liệu từ PHP -->
                    <?php
                        $rating = 4; // Đánh giá sao mẫu, bạn có thể thay đổi này bằng dữ liệu thực tế
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $rating) {
                                echo '<span class="fa fa-star checked"></span>';
                            } else {
                                echo '<span class="fa fa-star"></span>';
                            }
                        }
                    ?>
                </div>
                <p>Số lượt mua: <span>
                        <?php echo $soLuotMua; ?>
                    </span></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>