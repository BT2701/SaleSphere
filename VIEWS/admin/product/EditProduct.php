<?php 
require_once 'C:\xampp\htdocs\web2\CONTROLLER\LoaiSPController.php';
$categoryController = new LoaiSPController();
$categoryList = $categoryController->getCategoryList();

require_once 'C:\xampp\htdocs\web2\CONTROLLER\DonViTinhController.php';
$dvt = new DonViTinhController();
$dvtlist = $dvt->getList();

// Lấy thông tin sản phẩm chỉnh sửa từ phương thức loadEditInfor
require_once 'C:\xampp\htdocs\web2\CONTROLLER\SanPhamController.php';
$detail=$controller->loadEditInfor();
?>

<!-- Modal sửa sản phẩm -->
<div class="container-edit" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Cập nhật thông tin sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="eproductId" name="productId" value="<?php echo $detail['id']; ?>"> <!-- Input ẩn để lưu id sản phẩm -->

                    <div class="form-group">
                        <label for="eproductName">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="eproductName" name="productName" placeholder="Nhập tên sản phẩm" value="<?php echo $detail['tenSanPham']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="eproductPrice">Giá bán</label>
                        <input type="text" class="form-control" id="eproductPrice" name="productPrice" placeholder="Nhập giá bán" value="<?php echo $detail['giaBan']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="eproductType">Loại</label>
                        <select class="form-control" id="eproductType" name="productType">
                            <?php foreach ($categoryList as $cate): ?>
                                <?php $selected = ($cate['id'] == $detail['idLoaiSP']) ? 'selected' : ''; ?>
                                <option value="<?php echo $cate['id']; ?>" <?php echo $selected; ?>><?php echo $cate['tenLoaiSP']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="eproductUnit">Đơn vị tính</label>
                        <select class="form-control" id="eproductUnit" name="productUnit">
                            <?php foreach ($dvtlist as $dv): ?>
                                <?php $selected = ($dv['id'] == $detail['maDVT']) ? 'selected' : ''; ?>
                                <option value="<?php echo $dv['id']; ?>" <?php echo $selected; ?>><?php echo $dv['tenDonViTinh']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="eproductDescription">Mô tả</label>
                        <input type="text" class="form-control" id="eproductDescription" name="productDescription" placeholder="Nhập mô tả sản phẩm" value="<?php echo $detail['moTa']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="eproductImage">Chọn ảnh</label>
                        <input type="file" class="form-control-file" id="eproductImage" name="productImage">
                    </div>
                    <div class="modal-footer">
                        <a href="/web2/VIEWS/admin/admin_home.php?page=quanLySanPham"><button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button></a>
                        <button type="submit" class="btn btn-primary" id="esaveProductBtn" name="update">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
