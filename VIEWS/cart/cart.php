<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  <link rel="stylesheet" href="../../STATIC/css/cart.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="/web2/STATIC/js/cart.js"></script>
  <title>Cart</title>

</head>

<body>

  <?php
    // session_start();
    if (isset($_SESSION['id']) && $_SESSION['id'] != "") {
        $userid = $_SESSION['id'];
    }
    else{
        $userid = 0;
    }
    require_once __DIR__.'\..\..\CONTROLLER\CartController.php';
    $cartController=new CartController();
    $cartList= $cartController->getCartList($userid);
  ?>
  <div class="container-md ">
    <table id="chooseProduct" class="table table-hover table-borderless custom-table " style="margin-top: 20px; ">
      <thead>
        <tr class="thead table-primary "> 
          <th class="text-center col-1"></th>

          <th class="col-6">Sản Phẩm</th>
          <th class="col-1">Số Lượng</th>
          <th class="col-3">Giá</th>
          <th class="col-1">Thao Tác</th>
        </tr>
      </thead>
      <tbody>
        <!------------------- list_item ----------------->
        
          <?php if(isset($cartList) && !empty($cartList)) {?>
            <?php foreach ($cartList as $row): ?>
        
        <div id="item-cart" class="item-cart" data-user-id=  "<?php echo $userid  ?>">
          <tr data-product-id= "<?php echo $row['id']  ?>"  data-user-id=  "<?php echo $userid  ?>" >
            <td class="text-center align-middle ">
              <input title="Chọn sản phẩm"  class="check-box chooseProduct" style="cursor: pointer;"
               type="checkbox" > 
            </td>

            <td>
              <a class="link " title="<?php echo $row['tenSanPham']; ?>" href="<?php echo $row['moTa']; ?>">
                <!--//Chỗ này cần lưu link tới trang sản phẩm -->
                    <img class="rounded-2" style="margin-left: 30px;" width="80px" height="80px"
                      src="<?php echo $row['src']; ?>">
                  </a>
                  <a class="link text-dark" style="margin-left: 8px;" href="<?php echo $row['moTa']; ?>">
                    <!--//Chỗ này cần lưu link tới trang sản phẩm -->
                    <?php echo $row['tenSanPham']; ?>
                  </a>

                </td>

                <td class="text-center align-middle">
                  <div style="display: flex; justify-content: center;">
                    <button onclick="decreaseQuantity(this)" class="btn btn-sm color ml-5 rounded-left border-primary "
                      style="width: 30px;vertical-align: middle;">-</button>
                    <input oninput="validateQuantity(this)" id="soLuongInput" min="1" class="input  border-1  border-dark "
                      width="20px" height="31px" type="text" value="<?php echo $row['soLuong']; ?>"
                      style="text-align: center; vertical-align: middle;">
                    <button onclick="increaseQuantity(this)" class="btn btn-sm color rounded-right  mr-5 border-primary "
                      style="width: 30px;">+</button>
                  </div>
                </td>

                <td id='price' class="text-center  align-middle">
                  <?php 
                  $idSanPham= $row['id'];
                  $giaSanPham= $row['giaBan'];
                  
                  $khuyenmai= $cartController->getPromotionValue($idSanPham);
                  if(isset($khuyenmai) && !empty($khuyenmai)) {
                    foreach ($khuyenmai as $row1): 
                    if(isset($row1['giaTri']))
                      echo  "<p style='text-decoration: line-through;color:red'>". " -$giaSanPham- "."</p> " ."<p class='price'>". $giaSanPham - $giaSanPham*$row1['giaTri']/100 ."</p>";
                    endforeach;}
                    else
                    echo "<p class='price'>". $giaSanPham ."</p>";
                  ?>
                </td>

                <td class="text-center align-middle   ">
                  <a class="trash" title="Xóa sản phẩm" onclick= deleteRow(this)><i class="fas fa-trash"
                      style="font-size: 20px; cursor: pointer;"></i></a>
                </td>
              </tr>
            </div>
            <?php endforeach; ?>
            <?php } ?>
          


        <!-------------------- total-price --------------->
        <tr class="thead-total ">
          <td class="text-center align-middle">
            <div style="margin-top: 22px;">
              <input id="selectAll" style="cursor: pointer;" type="checkbox">
            </div>
            <p>Chọn tất cả</p>
          </td>
          <td class=" text-center align-middle">
            <p id="totalProduct" style="margin: 0px ;">Tổng sản phẩm đã chọn: 0</p>
          </td>
          <td class="text-center ">
          </td>
          <th class="text-center align-middle">

            <div class="input-group input-group-sm  ">
              <span class="input-group-text " id="inputGroup-sizing-sm"
                style="color: black; background-color: #80d8ff;"><strong>Tổng</strong></span>
              <input id="total" type="text" style="background-color: white;" readonly class="form-control"
                aria-label="Sizing example input" value="0" aria-describedby="inputGroup-sizing-sm">
            </div>


          </th>
          <td class="text-center align-middle">
            <a id=btnThanhToan class="btn btn-sm rounded-1 m-1" type="submit" 
              style="border-color: darkgray; border-radius: 10px !important; width: 130px; height: 50px; display: flex; justify-content: center; align-items: center;">
              <strong>Thanh toán</strong>
            </a>
          </td>

        </tr>


      </tbody>
    </table>

  </div>

</body>

</html>