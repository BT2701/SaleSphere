function show_product_detail(element, imagePath) {
  // Remove border from all image-items
  var imageItems = document.querySelectorAll(".image-item");
  imageItems.forEach((item) => {
    item.classList.remove("image-item-hovered");
  });

  // Set border for the currently hovered image-item
  let imageItem = document.querySelector(`.${element}`);

  imageItem.classList.add("image-item-hovered");
  // Change the main product image
  let imgElement = document.querySelector(".product-detail_image");
  imgElement.src = imagePath;
}

function decreaseQuantity() {
  let quantity_input = document.querySelector(".quantity-input").value;
  quantityValue = parseInt(quantity_input) || 0;
  //case value is none, set value comeback to 1
  if (quantityValue === 0) {
    document.querySelector(".quantity-input").value = 1;
  }
  //case value more than 1
  else if (parseInt(quantityValue) > 1) {
    document.querySelector(".quantity-input").value = quantityValue - 1;
  }
}

function increaseQuantity(maxProduct) {
  let quantity_input = document.querySelector(".quantity-input").value;
  quantityValue = parseInt(quantity_input) || 0;
  if (quantityValue < maxProduct) {
    document.querySelector(".quantity-input").value = quantityValue + 1;
  } else {
    //not do something
  }
}
