<?php 
require_once __DIR__.'\..\..\..\CONTROLLER\LoaiSPController.php';
$categoryController = new LoaiSPController();
$categoryList = $categoryController->getCategoryList();

require_once __DIR__.'\..\..\..\CONTROLLER\DonViTinhController.php';
$dvt = new DonViTinhController();
$dvtlist = $dvt->getList();
?>
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
                    <form action="/web2/CONTROLLER/SanPhamController.php" method="post" enctype="multipart/form-data" id="add-form">
                            <div class="form-group">
                                <label for="productName">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="productName" name="productName" placeholder="Nhập tên sản phẩm">
                                <p id="productNameError" style="color: red;"></p>
                            </div>
                            <div class="form-group">
                                <label for="productRoot">Giá nhập</label>
                                <input type="text" class="form-control" id="productRoot" name="productRoot" placeholder="Nhập giá nhập">
                                <p id="productRootError" style="color: red;"></p>
                            </div>
                            <div class="form-group">
                                <label for="productPrice">Giá bán</label>
                                <input type="text" class="form-control" id="productPrice" name="productPrice" placeholder="Nhập giá bán">
                                <p id="productPriceError" style="color: red;"></p>
                            </div>
                            <div class="form-group">
                                <label for="productType">Loại</label>
                                <select class="form-control" id="productType" name="productType">
                                    <?php if (isset($categoryList) && !empty($categoryList)): ?>
                                        <?php foreach ($categoryList as $cate): ?>
                                            <option value="<?php echo $cate['id']; ?>"><?php echo $cate['tenLoaiSP']; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="productUnit">Đơn vị tính</label>
                                <select class="form-control" id="productUnit" name="productUnit">
                                    <?php if (isset($dvtlist) && !empty($dvtlist)): ?>
                                        <?php foreach ($dvtlist as $dv): ?>
                                            <option value="<?php echo $dv['id']; ?>"><?php echo $dv['tenDonViTinh']; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="productDescription">Mô tả</label>
                                <input type="text" class="form-control" id="productDescription" name="productDescription" placeholder="Nhập mô tả sản phẩm">
                                
                            </div>
                            <div class="form-group">
                                <label for="productImage">Chọn ảnh</label>
                                <input type="file" class="form-control-file" id="productImage" name="productImage">
                                <p id="productImageError" style="color: red;"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary" id="saveProductBtn" name="save">Lưu</button>
                            </div>
                        </form>

                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" id="saveProductBtn">Lưu</button>
                    </div> -->
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
  $("#saveProductBtn").click(function (event) {
    event.preventDefault();

    var formData = {
      name: $("#productName").val(),
      root: $("#productRoot").val(),
      price: $("#productPrice").val(),
      image: $("#productImage").val(),
    };
    $.ajax({
      type: "POST",
      url: "/web2/VIEWS/admin/product/validate_add.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (response) {
      if (!response.success) {
        console.log("1");
        if (response.errors.name1) {
          $("#productNameError").text(response.errors.name1);
          
        }
        if (response.errors.root1) {
          $("#productRootError").text(response.errors.root1);
        }
        if (response.errors.price1) {
          $("#productPriceError").text(response.errors.price1);
        }
        if (response.errors.image1) {
          $("#productImageError").text(response.errors.image1);
        }
      } else {
        $("#add-form").submit();
      }
    });
  });
});

        </script>