// ----------------------------Xóa sản phẩm đang chọn ------------------------
function deleteRow(btn) {
  var row = btn.parentNode.parentNode;
  var confirmDelete = confirm("Muốn xóa sản phẩm khỏi danh sách không?");
  
  if (confirmDelete) {
    row.parentNode.removeChild(row);
    return true;
  }
  if (!confirmDelete)
    return false;
}

// -------------------------------- Nhấn nút giảm số lượng ----------------------
function decreaseQuantity(btn) {
  var parentRow = btn.closest("tr");
  var checkboxElement = parentRow.querySelector(".check-box")  
  var value = parseInt(parentRow.querySelector(".input").value - 1)
  var productID= parentRow.getAttribute("data-product-id")
  var userID = document.getElementById("item-cart").getAttribute("data-user-id");
  console.log(userID)
  var soLuongInput = btn.parentNode.querySelector("input");
  var currentValue = parseInt(soLuongInput.value);
  var price = parseInt(parentRow.querySelector(".price").textContent.trim());
  var total = parseInt(document.getElementById('total').value);

  if (currentValue > 0) {
    currentValue--;

    if (currentValue === 0) {
      
      currentValue=1
    }
    soLuongInput.value = currentValue;
    updateSoLuong(userID, productID, currentValue)
    if (checkboxElement.checked) {
      if (currentValue == 1) {
        total = price
      }
      else
        total -= price
      document.getElementById('total').value = total
    }
  }
}

// -------------------------------- Nhấn nút tăng số lượng ----------------------
function increaseQuantity(btn) {
  
  var parentRow = btn.closest("tr");
  var checkboxElement = parentRow.querySelector(".check-box")
  var productID= parentRow.getAttribute("data-product-id")
  var userID = document.getElementById("item-cart").getAttribute("data-user-id");
  var soLuongInput = btn.parentNode.querySelector("input");
  var currentValue = parseInt(soLuongInput.value);
  var price = parseInt(parentRow.querySelector(".price").textContent.trim());
  var total = parseInt(document.getElementById('total').value);
  if (currentValue < 999) {
    currentValue++;
  }
  soLuongInput.value = currentValue;
  updateSoLuong(userID, productID, currentValue)
  if (checkboxElement.checked) {
    if (currentValue >= 999) {
      total = price * 999
    }
    else
      total += price
    document.getElementById('total').value = total
  }
}

function hasLeadingZero(value) {
  var leadingZeroRegex = /^0[0-9]+$/;
  return leadingZeroRegex.test(value);
}


function validateQuantity(input) {
  var value = input.value;

  // Loại bỏ các ký tự không phải số
  value = value.replace(/[^0-9]/g, '');

  // Kiểm tra số âm
  if (value <= 0) {
    value = 1;
  }
  if (hasLeadingZero(value)) {
    value = value.replace(/^0+/, '');
  }

  if (value > 999) {
    value = 999;
  }

  input.value = value;
}
// --------------------Update Số lượng trong database---------------------
function updateSoLuong(userID, maSanPham, soLuongMoi){
  var url = "xuly.php?updateSoLuong=true&maKhachHang=" + userID + "&maSanPham="+ maSanPham +"&soLuongMoi="+soLuongMoi;
  var xhttp = new XMLHttpRequest();
    xhttp.open("GET", url, true);
    xhttp.send();
}

// -----------------Thay đổi tổng tiền khi Nhập giá trị vào soLuongInput -----------------
  document.addEventListener("DOMContentLoaded",function(){
    const inputSoLuong = document.querySelectorAll('#soLuongInput');
    var newInputValue=0
    var oldInputValue=0
    inputSoLuong.forEach(function(input){
      input.addEventListener('focus',function(){
        oldInputValue= parseInt(input.value);
    })
      input.addEventListener('blur',function(){

        newInputValue= parseInt(input.value);
        var parentRow = this.closest("tr");
        const checkboxElement= parentRow.querySelector(".check-box")
        const price= parseInt(parentRow.querySelector(".price").textContent.trim())
        var total= parseInt(document.getElementById("total").value)

        var productID= parentRow.getAttribute("data-product-id")
        var userID = document.getElementById("item-cart").getAttribute("data-user-id");
        updateSoLuong(userID, productID, newInputValue)

        if(checkboxElement.checked){
          total-= oldInputValue*price
          total+= newInputValue*price
          document.getElementById("total").value= parseInt(total)
        }
        
      }) 
    })
  })

// ---------------Popup cửa sổ khuyến mãi----------------

function openPopup() {
  document.getElementById("myPopup").style.display = "block";
}

function closePopup() {
  document.getElementById("myPopup").style.display = "none";
}
//--------------tickCheckbox-------------
// Khi check sẽ lấy giá tiền cộng vào totalPrice và tính tổng sản phẩm đang chọn

document.addEventListener("DOMContentLoaded", function () {
  const selectAllCheckBox = document.getElementById("selectAll");
  const listCheckBox = document.querySelectorAll(".chooseProduct");
  const checkboxes = document.querySelectorAll('.chooseProduct');
  const totalPriceElement = document.getElementById('total');
  const totalProductElement = document.getElementById('totalProduct')

  function calculateTotal() {
      let totalValue = 0;
      let totalProduct=0;
      checkboxes.forEach(function (checkbox) {
          if (checkbox.checked) {
              var parentRow = checkbox.closest("tr");
              var priceElement = parentRow.querySelector(".price");
              var price = parseFloat(priceElement.textContent.trim());
              let number = parseFloat(parentRow.querySelector(".input").value);
              totalValue += price * number;
              totalProduct++;
          }
      });
      totalPriceElement.value = parseInt(totalValue);
      totalProductElement.textContent = "Tổng sản phẩm đã chọn: " + totalProduct;
  }

  selectAllCheckBox.addEventListener("change", function() {
      listCheckBox.forEach(function(checkbox) {
          checkbox.checked = selectAllCheckBox.checked;
          updateTrangThai(checkbox);
          
      });
      calculateTotal();
      
  });

  checkboxes.forEach(function (checkbox) {
      checkbox.addEventListener('change', function () {
          calculateTotal();
          updateTrangThai(this);
          
      });
  });

//  Khi check thì updateTrangThai,Khi out thì setAll trạng thái=0;
  function updateTrangThai(checkbox) {
    var parentRow = checkbox.closest("tr");
    var productId = parentRow.getAttribute("data-product-id");
    var userID= parentRow.getAttribute("data-user-id")
    var trangThai = checkbox.checked ? 1 : 0;

    // Gửi yêu cầu AJAX để cập nhật trạng thái
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };
    xhttp.open("GET", "xuly.php?maSanPham=" + productId +"&maKhachHang="+userID+ "&updateTrangThai=" + trangThai, true);
    xhttp.send();
}
});
// ----------------------------reset Trạng thái khi out khỏi trang-------------------

window.addEventListener('beforeunload', function() {
  var userID = document.getElementById("item-cart").getAttribute("data-user-id");
  var url = "xuly.php?resetTrangThai=true&maKhachHang=" + userID;
  var xhttp = new XMLHttpRequest();
    xhttp.open("GET", url, true);
    xhttp.send();
});

// ---------------------------------Thanh Toán------------------------------------------------
document.addEventListener("DOMContentLoaded", function () {
var btnThanhToan = document.getElementById('btnThanhToan');
btnThanhToan.addEventListener('click', function(event){
  event. preventDefault();
  var total= parseInt(document.getElementById("total").value)
  var userID = document.getElementById("item-cart").getAttribute("data-user-id");
  var url = "xuly.php?thanhToan=true&maKhachHang=" + userID +"&tongTien="+total;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        alert("Thanh toán thành công!");
        window.location.reload();
    }
  };
  
  xhttp.open("GET", url, true);
  xhttp.send();


});
})
