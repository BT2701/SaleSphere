<!-- Modal thêm sản phẩm -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Thêm sản phẩm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="productName">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="productName" placeholder="Nhập tên sản phẩm">
                            </div>
                            <div class="form-group">
                                <label for="productPrice">Giá bán</label>
                                <input type="text" class="form-control" id="productPrice" placeholder="Nhập giá bán">
                            </div>
                            <div class="form-group">
                                <label for="productType">Loại</label>
                                <select class="form-control" id="productType">
                                    <option value="1">Loại 1</option>
                                    <option value="2">Loại 2</option>
                                    <option value="3">Loại 3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="productUnit">Đơn vị tính</label>
                                <select class="form-control" id="productUnit">
                                    <option value="kg">Kilogram (kg)</option>
                                    <option value="g">Gram (g)</option>
                                    <option value="unit">Unit</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="productDescription">Mô tả</label>
                                <input type="text" class="form-control" id="productDescription" placeholder="Nhập mô tả sản phẩm">
                            </div>
                            <div class="form-group">
                                <label for="productImage">Chọn ảnh</label>
                                <input type="file" class="form-control-file" id="productImage">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary" id="saveProductBtn">Lưu</button>
                    </div>
                </div>
            </div>
        </div>