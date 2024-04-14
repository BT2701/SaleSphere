// ----------------------------Xóa sản phẩm đang chọn ------------------------
function deleteRow(btn) {
  var row = btn.parentNode.parentNode
  var parentRow = btn.closest("tr");
  var userID = document.getElementById("item-cart").getAttribute("data-user-id")
  var productID= parentRow.getAttribute("data-product-id")
  var confirmDelete = confirm("Muốn xóa sản phẩm khỏi danh sách không?")
  
  if (confirmDelete) {
      $.ajax({
        url: "/web2/CONTROLLER/CartController.php",
        method: 'POST',
        dataType: 'json',
        data: { action:'deleteProduct',
                userid: userID,
                idSanPham: productID
              },
        success: function(response) {
            if(response==true){
              alert("Xóa sản phẩm thành công!");
            } else {
              alert(response);
            }    
        },
        error: function(xhr, status, error) {
          alert("Lỗi khi gửi yêu cầu: "+xhr.status);
        }
    });
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
  var soLuongInput = btn.parentNode.querySelector("input");
  var currentValue = parseInt(soLuongInput.value);
  var price = parseInt(parentRow.querySelector(".price").textContent.trim());
  var total = parseInt(document.getElementById('total').value);
  var x=1; // Kiểm tra nếu currentValue có từng =0 và gán lại 1 chưa. 
  if (currentValue > 0) {
    currentValue--;

    if (currentValue === 0) {
      x=0
      currentValue=1
    }
    soLuongInput.value = currentValue;
    updateQuantity(userID, productID, currentValue)
    
    if (checkboxElement.checked) {
      // Nếu đã gán lại currentValue=1 rồi thì không trừ nữa
      if (currentValue == 1 && x==0) {  
      }
      
      // Nếu chưa lại currentValue=1 rồi thì trừ
      else if( currentValue ==1 && x!=0){
        total-=price
      }
      
      else if( currentValue > 1)
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
  updateQuantity(userID, productID, currentValue)
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
function updateQuantity(userID, idsanpham, soLuongMoi){
    $.ajax({
      url: "/web2/CONTROLLER/CartController.php",
      method: 'POST',
      dataType: 'json',
      data: { action:'updateQuantity',
              userid: userID,
              idSanPham: idsanpham,
              soLuongMoi: soLuongMoi
            },
      success: function(response) {
          if(response==true){
            
          } else {
            alert("Cập nhật số lượng lỗi: "+ response);
          }    
      },
      error: function(xhr, status, error) {
        alert("Lỗi khi gửi yêu cầu: "+xhr.status);
      }
  });
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
        updateQuantity(userID, productID, newInputValue)

        if(checkboxElement.checked){
          total-= oldInputValue*price
          total+= newInputValue*price
          document.getElementById("total").value= parseInt(total)
        }
        
      }) 
    })
  })

//--------------tickCheckbox-------------
// Khi check sẽ lấy giá tiền cộng vào totalPrice và tính tổng sản phẩm đang chọn
var selectedProductIDs = [];
document.addEventListener("DOMContentLoaded", function() {
  const selectAllCheckBox = document.getElementById("selectAll");
  const listCheckBox = document.querySelectorAll(".chooseProduct");
  const checkboxes = document.querySelectorAll('.chooseProduct');
  const totalPriceElement = document.getElementById('total');
  const totalProductElement = document.getElementById('totalProduct')
 
  function calculateTotal() {
    let totalValue = 0;
    let totalProduct = 0;
  
    checkboxes.forEach(function(checkbox) {
      if (checkbox.checked) {
        var parentRow = checkbox.closest("tr");
        if (parentRow) {
          var priceElement = parentRow.querySelector(".price");
          if (priceElement) {
            var price = parseFloat(priceElement.textContent.trim());
            let number = parseFloat(parentRow.querySelector(".input").value);
            totalValue += price * number;
            totalProduct++;
  
            // Nếu productID chưa tồn tại trong mảng, thêm vào
            var productID = parentRow.getAttribute("data-product-id");
            if (!selectedProductIDs.includes(productID)) {
              selectedProductIDs.push(productID);
            }
          }
        }
      } else {
        // Nếu productID tồn tại trong mảng, gỡ bỏ
        var parentRow = checkbox.closest("tr");
        if (parentRow) {
          var productID = parentRow.getAttribute("data-product-id");
          const index = selectedProductIDs.indexOf(productID);
          if (index !== -1) {
            selectedProductIDs.splice(index, 1);
          }
        }
      }
    });
    totalPriceElement.value = parseInt(totalValue);
    totalProductElement.textContent = "Tổng sản phẩm đã chọn: " + totalProduct;
  }
  

  selectAllCheckBox.addEventListener("change", function() {
    listCheckBox.forEach(function(checkbox) {
      checkbox.checked = selectAllCheckBox.checked;
      
    });
    
    // Nếu selectAllCheckBox được chọn, cập nhật lại mảng selectedProductIDs
    if (selectAllCheckBox.checked) {
      selectedProductIDs = [];
      checkboxes.forEach(function(checkbox) {
        var parentRow = checkbox.closest("tr");
        var productID = parentRow.getAttribute("data-product-id");
        selectedProductIDs.push(productID);
        
      });
    } 
    
    calculateTotal();
  });

  checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
      calculateTotal();
    });
  });
});

// ---------------------------------Thanh Toán------------------------------------------------
document.addEventListener("DOMContentLoaded", function () {
  var btnThanhToan = document.getElementById('btnThanhToan');
  btnThanhToan.addEventListener('click', function(event){
      event.preventDefault();
      var confirmed = confirm("Bạn có chắc chắn muốn thanh toán?");
      if(confirmed){
          var total = parseInt(document.getElementById("total").value);
          var userID = document.getElementById("item-cart").getAttribute("data-user-id");
          var listSelectedProductID = selectedProductIDs;
          console.log("userID: " + userID + " selected: " + selectedProductIDs + " tongTien: " + total);
          $.ajax({
              url: "/web2/CONTROLLER/CartController.php",
              method: 'POST',
              dataType: 'json',
              data: {
                  action: 'payProduct',
                  userid: userID,
                  selectedProductIDs: listSelectedProductID,
                  tongTien: total
              },
              success: function(response) {
                  if(response == true){
                      alert("Đặt hàng thành công!");
                      location.reload(); // Reload the page after successful order
                  } else {
                      alert(response);
                  }    
              },
              error: function(xhr, status, error) {
                  alert("Lỗi khi gửi yêu cầu: " + xhr.status + status + error);
              }
          });
      }
  });
});

