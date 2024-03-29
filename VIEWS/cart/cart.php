<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/web2/STATIC/css/cart.css">
  <title>Document</title>

</head>

<body>
  <div class="container-md">
    <table class="table table-hover rounded-2" style="margin-top: 20px;">
      <thead>
        <tr class="thead table-primary ">
          <th class="text-center col-2"><input class="check-box " type="checkbox"></th>

          <th class="col-4">Sản Phẩm</th>
          <th class="col-2">Số Lượng</th>
          <th class="col-3">Giá</th>
          <th class="col-1">Thao Tác</th>
        </tr>
      </thead>
      <tbody>

        <div class="item-cart">
          <tr>
            <td class="text-center align-middle">
              <input class="check-box " type="checkbox">
            </td>

            <td >

              <a class="link " title="Dao cạo râu"
                href="https://www.google.com/search?q=dao+c%E1%BA%A1o+r%C3%A2u&sca_esv=601719464&tbm=isch&sxsrf=ACQVn08lV8JZjrQ965CWuTg7_MxAyrTdZQ:1706274026979&source=lnms&sa=X&ved=2ahUKEwiCxZGKjvuDAxVXsFYBHfr1CRkQ_AUoAXoECAMQAw&biw=1314&bih=613&dpr=1.04#imgrc=iDg0fwX-rCYUnM">
                <img style="border: 1px solid black;margin-left: 30px;" width="70px" height="70px"
                  src="https://anlocviet.vn/upload/product/daocaoraugillettesuperthiniiluoidoi1cay3501000x1000-788.jpg">
              </a>
              <a class="link text-dark" style="margin-left: 8px;"
                href="https://www.google.com/search?q=dao+c%E1%BA%A1o+r%C3%A2u&sca_esv=601719464&tbm=isch&sxsrf=ACQVn08lV8JZjrQ965CWuTg7_MxAyrTdZQ:1706274026979&source=lnms&sa=X&ved=2ahUKEwiCxZGKjvuDAxVXsFYBHfr1CRkQ_AUoAXoECAMQAw&biw=1314&bih=613&dpr=1.04#imgrc=iDg0fwX-rCYUnM">
                Dạo cạo râu</a>

            </td>

            <td class="text-center align-middle">
              <div style="display: flex; justify-content: center;">
                <button onclick="decreaseQuantity(this)" class="btn btn-sm color ml-5 rounded-0 border-primary "
                  style="width: 30px;vertical-align: middle;">-</button>
                <input oninput="validateQuantity(this)" id="soLuongInput" class="input rounded-0 border-1  border-dark "
                  width="20px" height="31px" type="text" value="1" style="text-align: center; vertical-align: middle;">
                <button onclick="increaseQuantity(this)" class="btn btn-sm color  rounded-0 mr-5 border-primary "
                  style="width: 30px;">+</button>
              </div>
            </td>

            <td class="text-center align-middle">
              10.000đ
            </td>

            <td class="text-center align-middle">
              <button onclick="deleteRow(this)" class="btn btn-sm  rounded-2"
                style="background-color: white;border: 0;"><i class="fas fa-trash"
                  style="font-size: 20px;"></i></button>
            </td>
          </tr>
        </div>

        <div class="item-cart">
          <tr>
            <td class="text-center align-middle">
              <input class="check-box " type="checkbox">
            </td>

            <td >

              <a class="link " title="Xúc xếch lắc"
                href="https://www.google.com/search?q=%E1%BA%A3nh+x%C3%BAc+x%C3%ADch+visan&tbm=isch&ved=2ahUKEwig86mA04KEAxWuf_UHHe4tAWEQ2-cCegQIABAA&oq=%E1%BA%A3nh+x%C3%BAc+x%C3%ADch+visan&gs_lcp=CgNpbWcQAzoECCMQJzoFCAAQgAQ6BggAEAcQHjoECAAQHjoGCAAQBRAeUPYDWOoRYMwTaABwAHgAgAFhiAHfBJIBATeYAQCgAQGqAQtnd3Mtd2l6LWltZ8ABAQ&sclient=img&ei=tqC3ZaDAJa7_1e8P7tuEiAY&bih=613&biw=1314#imgrc=If-RTk1ioNVcBM">
                <img style="border: 1px solid black;margin-left: 30px;" width="70px" height="70px"
                  src="https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/Products/Images/3507/283659/xuc-xich-lac-keu-vi-pho-mai-vissan-ly-56g-1.jpg">
              </a>
              <a class="link text-dark" style="margin-left: 8px;"
                href="https://www.google.com/search?q=%E1%BA%A3nh+x%C3%BAc+x%C3%ADch+visan&tbm=isch&ved=2ahUKEwig86mA04KEAxWuf_UHHe4tAWEQ2-cCegQIABAA&oq=%E1%BA%A3nh+x%C3%BAc+x%C3%ADch+visan&gs_lcp=CgNpbWcQAzoECCMQJzoFCAAQgAQ6BggAEAcQHjoECAAQHjoGCAAQBRAeUPYDWOoRYMwTaABwAHgAgAFhiAHfBJIBATeYAQCgAQGqAQtnd3Mtd2l6LWltZ8ABAQ&sclient=img&ei=tqC3ZaDAJa7_1e8P7tuEiAY&bih=613&biw=1314#imgrc=If-RTk1ioNVcBM">
                Xúc xếch lắc</a>

            </td>

            <td class="text-center align-middle">
              <div style="display: flex; justify-content: center;">
                <button onclick="decreaseQuantity(this)" class="btn btn-sm color ml-5 rounded-0 border-primary "
                  style="width: 30px;vertical-align: middle;">-</button>
                <input oninput="validateQuantity(this)" id="soLuongInput" class="input rounded-0 border-1  border-dark "
                  width="20px" height="31px" type="text" value="1" style="text-align: center; vertical-align: middle;">
                <button onclick="increaseQuantity(this)" class="btn btn-sm color  rounded-0 mr-5 border-primary "
                  style="width: 30px;">+</button>
              </div>
            </td>

            <td class="text-center align-middle">
              15.000đ
            </td>

            <td class="text-center align-middle">
              <button onclick="deleteRow(this)" class="btn btn-sm  rounded-2"
                style="background-color: white;border: 0;"><i class="fas fa-trash"
                  style="font-size: 20px;"></i></button>
            </td>
          </tr>
        </div>

        <div class="item-cart">
          <tr>
            <td class="text-center align-middle">
              <input class="check-box " type="checkbox">
            </td>

            <td >

              <a class="link " title="Xúc xếch hêu"
                href="https://www.google.com/search?q=%E1%BA%A3nh+x%C3%BAc+x%C3%ADch+visan&tbm=isch&ved=2ahUKEwig86mA04KEAxWuf_UHHe4tAWEQ2-cCegQIABAA&oq=%E1%BA%A3nh+x%C3%BAc+x%C3%ADch+visan&gs_lcp=CgNpbWcQAzoECCMQJzoFCAAQgAQ6BggAEAcQHjoECAAQHjoGCAAQBRAeUPYDWOoRYMwTaABwAHgAgAFhiAHfBJIBATeYAQCgAQGqAQtnd3Mtd2l6LWltZ8ABAQ&sclient=img&ei=tqC3ZaDAJa7_1e8P7tuEiAY&bih=613&biw=1314#imgrc=R3ATIVV7Qs9C5M">
                <img style="border: 1px solid black; margin-left: 30px;" width="70px" height="70px"
                  src="https://cdn.tgdd.vn/Products/Images/3507/89859/bhx/xuc-xich-dinh-duong-heo-vissan-goi-175g-2-org.jpg">
              </a>
              <a class="link text-dark" style="margin-left: 8px;"
                href="https://www.google.com/search?q=%E1%BA%A3nh+x%C3%BAc+x%C3%ADch+visan&tbm=isch&ved=2ahUKEwig86mA04KEAxWuf_UHHe4tAWEQ2-cCegQIABAA&oq=%E1%BA%A3nh+x%C3%BAc+x%C3%ADch+visan&gs_lcp=CgNpbWcQAzoECCMQJzoFCAAQgAQ6BggAEAcQHjoECAAQHjoGCAAQBRAeUPYDWOoRYMwTaABwAHgAgAFhiAHfBJIBATeYAQCgAQGqAQtnd3Mtd2l6LWltZ8ABAQ&sclient=img&ei=tqC3ZaDAJa7_1e8P7tuEiAY&bih=613&biw=1314#imgrc=R3ATIVV7Qs9C5M">
                Xúc xếch hêu</a>

            </td>

            <td class="text-center align-middle">
              <div style="display: flex; justify-content: center;">
                <button onclick="decreaseQuantity(this)" class="btn btn-sm color ml-5 rounded-0 border-primary "
                  style="width: 30px;vertical-align: middle;">-</button>
                <input oninput="validateQuantity(this)" id="soLuongInput" class="input rounded-0 border-1  border-dark "
                  width="20px" height="31px" type="text" value="1" style="text-align: center; vertical-align: middle;">
                <button onclick="increaseQuantity(this)" class="btn btn-sm color  rounded-0 mr-5 border-primary "
                  style="width: 30px;">+</button>
              </div>
            </td>

            <td class="text-center align-middle">
              23.000đ
            </td>

            <td class="text-center align-middle">
              <button onclick="deleteRow(this)" class="btn btn-sm  rounded-2"
                style="background-color: white;border: 0;"><i class="fas fa-trash"
                  style="font-size: 20px;"></i></button>
            </td>
          </tr>
        </div>

        <div class="item-cart">
          <tr>
            <td class="text-center align-middle">
              <input class="check-box " type="checkbox">
            </td>

            <td >

              <a class="link " title="Pate Hêu"
                href="https://www.google.com/search?q=pate&tbm=isch&ved=2ahUKEwjLl-yC04KEAxWVTfUHHVMmBJ4Q2-cCegQIABAA&oq=pate&gs_lcp=CgNpbWcQAzIECCMQJzIICAAQgAQQsQMyCggAEIAEEIoFEEMyDQgAEIAEEIoFEEMQsQMyBQgAEIAEMggIABCABBCxAzIFCAAQgAQyBQgAEIAEMgUIABCABDIFCAAQgAQ6BAgAEB46BggAEAUQHjoHCCMQ6gIQJzoECAAQA1Dj2gVYwPIFYK30BWgCcAB4AoABcYgBxQ2SAQQxNy4ymAEAoAEBqgELZ3dzLXdpei1pbWewAQrAAQE&sclient=img&ei=u6C3ZYvONpWb1e8P08yQ8Ak&bih=613&biw=1314#imgrc=rdWZTEuUa6IVrM">
                <img style="border: 1px solid black; margin-left: 30px;" width="70px" height="70px"
                  src="https://www.lottemart.vn/media/catalog/product/cache/0x0/8/9/8934572000217.jpg.webp">
              </a>
              <a class="link text-dark" style="margin-left: 8px;"
                href="https://www.google.com/search?q=pate&tbm=isch&ved=2ahUKEwjLl-yC04KEAxWVTfUHHVMmBJ4Q2-cCegQIABAA&oq=pate&gs_lcp=CgNpbWcQAzIECCMQJzIICAAQgAQQsQMyCggAEIAEEIoFEEMyDQgAEIAEEIoFEEMQsQMyBQgAEIAEMggIABCABBCxAzIFCAAQgAQyBQgAEIAEMgUIABCABDIFCAAQgAQ6BAgAEB46BggAEAUQHjoHCCMQ6gIQJzoECAAQA1Dj2gVYwPIFYK30BWgCcAB4AoABcYgBxQ2SAQQxNy4ymAEAoAEBqgELZ3dzLXdpei1pbWewAQrAAQE&sclient=img&ei=u6C3ZYvONpWb1e8P08yQ8Ak&bih=613&biw=1314#imgrc=rdWZTEuUa6IVrM">
                Pate hêu</a>

            </td>

            <td class="text-center align-middle">
              <div style="display: flex; justify-content: center;">
                <button onclick="decreaseQuantity(this)" class="btn btn-sm color ml-5 rounded-0 border-primary "
                  style="width: 30px;vertical-align: middle;">-</button>
                <input oninput="validateQuantity(this)" id="soLuongInput" class="input rounded-0 border-1  border-dark "
                  width="20px" height="31px" type="text" value="1" style="text-align: center; vertical-align: middle;">
                <button onclick="increaseQuantity(this)" class="btn btn-sm color  rounded-0 mr-5 border-primary "
                  style="width: 30px;">+</button>
              </div>
            </td>

            <td class="text-center align-middle">
              85.000đ
            </td>

            <td class="text-center align-middle">
              <button onclick="deleteRow(this)" class="btn btn-sm  rounded-2"
                style="background-color: white;border: 0;"><i class="fas fa-trash"
                  style="font-size: 20px;"></i></button>
            </td>
          </tr>
        </div>

        <div class="item-cart">
          <tr>
            <td class="text-center align-middle">
              <input class="check-box " type="checkbox">
            </td>

            <td >

              <a class="link " title="Mì Hảo Hảo sườn hêu"
                href="https://www.google.com/search?q=m%C3%AC+g%C3%B3i+heo&tbm=isch&ved=2ahUKEwijpsaq2YKEAxVgkK8BHXnOBPcQ2-cCegQIABAA&oq=m%C3%AC+g%C3%B3i+heo&gs_lcp=CgNpbWcQA1AAWABgAGgAcAB4AIABAIgBAJIBAJgBAKoBC2d3cy13aXotaW1n&sclient=img&ei=Wae3ZeOVL-Cgvr0P-ZyTuA8#imgrc=NbrAmOHhsKulaM">
                <img style="border: 1px solid black; margin-left: 30px;" width="70px" height="70px"
                  src="https://www.lottemart.vn/media/catalog/product/cache/0x0/8/9/8934563182144.jpg.webp">
              </a>
              <a class="link text-dark" style="margin-left: 8px;"
                href="https://www.google.com/search?q=m%C3%AC+g%C3%B3i+heo&tbm=isch&ved=2ahUKEwijpsaq2YKEAxVgkK8BHXnOBPcQ2-cCegQIABAA&oq=m%C3%AC+g%C3%B3i+heo&gs_lcp=CgNpbWcQA1AAWABgAGgAcAB4AIABAIgBAJIBAJgBAKoBC2d3cy13aXotaW1n&sclient=img&ei=Wae3ZeOVL-Cgvr0P-ZyTuA8#imgrc=NbrAmOHhsKulaM">
                Mì Hảo Hảo </a>

            </td>

            <td class="text-center align-middle">
              <div style="display: flex; justify-content: center;">
                <button onclick="decreaseQuantity(this)" id="decreaseButton" class="btn btn-sm color ml-5 rounded-0 border-primary "
                  style="width: 30px;vertical-align: middle;">-</button>
                <input oninput="validateQuantity(this)" id="soLuongInput" class="input rounded-0 border-1  border-dark "
                  width="20px" height="31px" type="text" value="1" style="text-align: center; vertical-align: middle;">
                <button onclick="increaseQuantity(this)" class="btn btn-sm color  rounded-0 mr-5 border-primary "
                  style="width: 30px;">+</button>
              </div>
            </td>

            <td class="text-center align-middle">
              5.000đ
            </td>

            <td class="text-center align-middle">
              <button onclick="deleteRow(this)" class="btn btn-sm  rounded-2"
                style="background-color: white;border: 0;"><i class="fas fa-trash"
                  style="font-size: 20px;"></i></button>
            </td>
          </tr>
        </div>
        

        <!-------------------- total-price --------------->
        <tr class="thead-total ">
          <td class="text-center align-middle">
            <div>
              <input type="checkbox" >
            </div>
            <button class="clear-btn-style">Chọn tất cả</button>
          </td>
          <td >
            
          </td>
          <td></td>
          <th class="text-center align-middle">
            
            <div class="input-group input-group-sm  ">
              <span class="input-group-text " id="inputGroup-sizing-sm" style="color: black; background-color: #80d8ff;"><strong>Tổng tiền</strong></span>
              <input type="text" style="background-color: white;" readonly class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
          

          </th>
          <td class="text-center align-middle">
            <button class="btn btn-sm  rounded-1"> Mua hàng</button>
          </td>
        </tr>


      </tbody>
    </table>


    <div class="Total">

    </div>

  </div>

  <script src="/web2/STATIC/js/cart.js"></script>
</body>

</html>