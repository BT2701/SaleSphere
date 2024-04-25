
// $(document).ready(function() {
//     $("#saveProductBtn").click(function() {
//         // Lấy dữ liệu từ form
//         var productName = $("#productName").val();
//         var productPrice = $("#productPrice").val();
//         var productType = $("#productType").val();
//         var productUnit = $("#productUnit").val();
//         var productDescription = $("#productDescription").val();

//         // Gửi dữ liệu thông qua Ajax
//         $.ajax({
//             url: "/web2/CONTROLLER/SanPhamController.php",
//             type: "POST",
//             data: {
//                 productName: productName,
//                 productPrice: productPrice,
//                 productType: productType,
//                 productUnit: productUnit,
//                 productDescription: productDescription
//             },
//             success: function(response) {
//                 // Hiển thị modal khi lưu thành công
//                 $("#successModal").modal("show");
//                 // Làm mới form (nếu cần)
//                 $("#productForm")[0].reset();
//             },
//             error: function(xhr, status, error) {
//                 // Xử lý lỗi nếu có
//                 console.error(xhr.responseText);
//                 alert("Đã xảy ra lỗi: " + xhr.responseText);
//             }
//         });
//     });
// });

