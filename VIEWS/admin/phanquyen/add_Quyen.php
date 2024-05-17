<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
            <div class="formxuly" style="text-align: center;">
                    <h2>Thêm quyền</h2>
                    <br>
                    <form action="/SaleSphere/CONTROLLER/PhanQuyenController.php?controller=them" method="post" id="Form1">
                        <div style="font-size: 20px;">
                        <label style="padding-right: 5px;">Tên quyền</label>
                        <input type="text" name="username" id="Username" style="padding-left: 5px;">
                        <p id="errorusername"></p>
                        </div>
                        <input type="submit" class="btn btn-success mb-3 btnthem" value="Thêm" id="tinh" name="btntinh">
                    </form>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                <script src="/SaleSphere/STATIC/js/validation_addQuyen.js"></script>
</body>
</html>