function deleteRow(btn) {
    var row = btn.parentNode.parentNode;
    var confirmDelete = confirm("Muốn xóa sản phẩm khỏi danh sách không?");
    if (confirmDelete) {
        row.parentNode.removeChild(row);
    }
    
  }
  

  function decreaseQuantity(btn) {
    var soLuongInput = btn.parentNode.querySelector("input");
    var currentValue = parseInt(soLuongInput.value);
  
    if (currentValue > 0) {
      currentValue--;
  
      if (currentValue === 0) {
        deleteRow(btn.parentNode);
      }
    }
  
    soLuongInput.value = currentValue;
  }

  function increaseQuantity(btn) {
    var soLuongInput = btn.parentNode.querySelector("input");
    var currentValue = parseInt(soLuongInput.value);
  
    if (currentValue < 99) {
      currentValue++;
    }
  
    soLuongInput.value = currentValue;
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
      value = 0;
    }
    if (hasLeadingZero(value)) {
        value = value.replace(/^0+/, '');
      }

    if(value>99){
        value=99;
    }
  
    input.value = value;
  }

  function priceTotal(){
    var total=0;
    

  }