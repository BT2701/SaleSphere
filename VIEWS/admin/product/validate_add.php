<?php
// Đảm bảo rằng request là POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $name = $_POST["name"];
    $root= $_POST['root'];
    $price=$_POST['price'];
    $image = $_POST["image"];


    // Kiểm tra dữ liệu
    $errors = array();
    if (empty($name)) {
        $errors['name1'] = 'Tên sản phẩm không được để trống';
    }
    if (empty($root)) {
        $errors['root1'] = 'Giá nhập không được để trống';
    }
    else{
        if(!is_numeric($root) && intval($root) == $root){
            $errors['root1']='Giá nhập phải là số nguyên';
        }
    }
    if (empty($price)) {
        $errors['price1'] = 'Giá bán không được để trống';
    }
    else{
        if(!is_numeric($price) && intval($price) == $price){
            $errors['price1']='Giá bán phải là số nguyên';
        }
    }
    if (empty($image)) {
        $errors['image1'] = 'Hình ảnh không được để trống';
    }
   
    
   

    // Nếu không có lỗi, tiến hành xử lý
    if (empty($errors)) {
        // Tiếp tục xử lý dữ liệu (ví dụ: lưu vào cơ sở dữ liệu)
        // Sau khi xử lý, trả về một phản hồi JSON cho client
        $response = array(
            'success' => true
        );
    } else {
        // Nếu có lỗi, trả về thông báo lỗi dưới dạng JSON
        $response = array(
            'success' => false,
            'errors' => $errors
        );
    }

    // Trả về kết quả dưới dạng JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

