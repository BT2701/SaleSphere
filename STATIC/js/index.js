// slider-product
// hiệu ứng chuyển cụm
const rightBtn=document.querySelector(".fa-chevron-right")
const leftBtn=document.querySelector(".fa-chevron-left")
const sliderProduct=document.querySelectorAll(".slider-product-items")
rightBtn.addEventListener("click",function(){
    index=index+1
    if(index>sliderProduct.length-1){
        index=0
    }
    document.querySelector(".slider-product-items-parent").style.right=index *100 +"%"
})
leftBtn.addEventListener("click",function(){
    index=index-1
    if(index<=0){
        index=sliderProduct.length-1
    }
    document.querySelector(".slider-product-items-parent").style.right=index *100 +"%"
})



// -----------CANH CHỈNH CÁC ITEMS PRODUCT GALLERY THEO SỐ LƯỢNG PHÙ HỢP------------
// // Số lượng items
// const numberOfItems = 9;

// // Số lượng items trên mỗi dòng
// const itemsPerRow = 5;

// // Tính toán số lượng dòng
// const numberOfRows = Math.ceil(numberOfItems / itemsPerRow);

// // Tạo ra các item
// const container = document.querySelector('.product-gallery-content-product');

// // for (let i = 0; i < numberOfItems; i++) {
// //   const item = document.createElement('div');
// //   item.classList.add('item');
// //   item.textContent = i + 1;
// //   container.appendChild(item);
// // }

// // Tính toán số lượng items cần thêm vào từng dòng
// const remainingItems = numberOfItems % itemsPerRow;
// const itemsToAdd = itemsPerRow - remainingItems;

// // Thêm items trống vào cuối mỗi dòng
// for (let i = 0; i < numberOfRows - 1; i++) {
//   const row = document.createElement('div');
//   row.classList.add('row');
//   for (let j = 0; j < itemsToAdd; j++) {
//     const emptyItem = document.createElement('div');
//     emptyItem.classList.add('product-gallery-content-product-item', 'empty');
//     row.appendChild(emptyItem);
//   }
//   container.appendChild(row);
// }
