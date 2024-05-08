<?php
    require_once __DIR__.'\..\..\CONTROLLER\ProfileController.php';
    
    $profileController= new ProfileController();
    $user="";
    if(isset($_SESSION['login_name'])&&$_SESSION['login_name']!="")
    {
        $user=$_SESSION['login_name'];
    }
    if(isset($_SESSION['id'])&&$_SESSION['id']!="")
    {
        $id=$_SESSION['id'];
    }
    if($user!="")
    {
        //Khi user là admin thì ẩn giỏ hàng và khi chưa đăng nhập thì ẩn giỏ hàng, 
            $cart = '
            <a href="#" class="user-info_cart circle-bg-icon">
            <i class="fa-solid fa-cart-shopping" id="viewCartButton"></i>
            <div class="quantity-product">' .
            $numberProductIncart
            . '</div>
            </a>
        ';
        $logined="&nbsp".$profileController->GetTenById($id);
        $logined_mini="&nbsp" .$profileController->GetTenById($id);
        $login='<li class="user-action_list-item"><a href="/web2/VIEWS/profile/profile.php">Tài khoản</a></li>';
        $signup='<li class="user-action_list-item"><a href="/web2/VIEWS/sign_up/logout.php">Đăng xuất</a></li>';
        $XemLichSuDonHang =
        '<li class="nav-item dropdown navbar-item">
    <a class="nav-link " href="#" id="promote" role="button" aria-expanded="false">
        <form id="viewHistoryForm" action="/web2/VIEWS/History/OrderHistory.php" method="post">
            <input type="hidden" name="customerId" value="' . $id . '">
            <button id="viewHistory" style="background-color: #212529; color:rgba(255, 255, 255, .55);border:none" type="submit">View Order History</button>
        </form>
    </a>
    </li>';
        $logout='<li class="nav-item d-lg-none d-flex align-items-center">
        <i class="fa-solid fa-right-to-bracket" style="color: aliceblue; margin-right: 10px;"></i>
        <a class="nav-link" href="/web2/VIEWS/sign_up/logout.php">Log out</a>
    </li>';
    }
    else {
        $cart = `hehe`;
        $XemLichSuDonHang = '';
        $logined= '<span class="user-name">Đăng nhập/Đăng ký</span>';
        $login='<li class="user-action_list-item"><a href="/web2/VIEWS/login/login.php">Đăng nhập</a></li>';
        $signup='<li class="user-action_list-item"><a href="/web2/VIEWS/sign_up/sign_up.php">Đăng ký</a></li>';
        $logined_mini='<a class="nav-link" href="/web2/VIEWS/sign_up/sign_up.php">Đăng ký</a>';
        $logout='<li class="nav-item d-lg-none d-flex align-items-center">
        <i class="fa-solid fa-user" style="color: aliceblue; margin-right: 10px;"></i>
        <a class="nav-link" href="/web2/VIEWS/Login/login.php">Đăng nhập</a>
    </li>';
    }   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/web2/STATIC/css/style.css">
    <link rel="stylesheet" type="text/css" href="/web2/STATIC/css/base-style.css">
    <title>Document</title>
</head>
<body>

<header class="header-style">
        <div class="container">
            <div class="row d-flex align-items-center container-fluid header-wraper">

                <!-- Logo -->
                <div class="col-lg-4 col-6 web-logo">
                    <!-- <a class="navbar-brand" href="#">
                        <img src="your-logo.png" alt="Logo" height="30" class="d-inline-block align-top">
                    </a> -->
                    <a href="index.php?page=homepage">G1'sShop</a>
                </div>


                <!-- Search Bar -->
                <div class="col-lg-4 d-lg-block d-none search-bar">
                    
                </div>


                <!-- Header operation -->
                <div class="col-lg-4 d-flex col-6 align-items-center justify-content-end header-operations">
                    
                    <div class=" d-none d-lg-flex header-operations_user-info ">
                    <?php echo $cart ?>

                        <div class="user-info_wrapper">
                            <i class="fa-solid fa-user circle-bg-icon"></i>
                            <?=$logined?>
                            <div class="user-actions">
                                <ul class="user-action_list">
                                <?=$login?>
                                <?=$signup?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- ----------------------------------------------------------------------- -->
                    <!-- Case width less than Ipad pro  -->
                    <ul class="d-flex d-lg-none list-unstyled m-0 ">
                        <li class="search-hiden" onclick="showSearchModal()">
                            <i class="fa-solid fa-magnifying-glass circle-bg-icon"></i>
                            <!-- search bar -->

                            <div class="search-bar-hiden">
                                <input class="form-control me-2 " type="search" placeholder="Search"
                                    aria-label="Search">
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </header>



    <!-- navbar seccion  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 navbar-list">
                    <li class="nav-item dropdown navbar-item">
                        <a class="nav-link " href="index.php?page=homepage" id="all-product" role="button" aria-expanded="false">
                            Trang chủ
                        </a>
                        
                    </li>
                    <li class="nav-item dropdown navbar-item">
                        <a class="nav-link " href="index.php?page=productlist" id="all-product" role="button" aria-expanded="false">
                            Danh sách sản phẩm
                        </a>
                        
                    </li>

                    <li class="nav-item dropdown navbar-item">
                        <a class="nav-link " href="index.php?page=promote" id="promote" role="button" aria-expanded="false">
                            Chương trình khuyến mãi
                        </a>
                    </li>
                    <?php echo $XemLichSuDonHang ?>
                    

                    <!-- case user dose not login  -->
                    <!-- <li class="nav-item d-lg-none d-flex align-items-center">
                        <i class="fa-solid fa-user" style="color: aliceblue; margin-right: 10px;"></i>
                        <a class="nav-link" href="#">Log in</a>
                    </li>
                    <li class="nav-item d-lg-none d-flex align-items-center">
                        <i class="fa-solid fa-unlock" style="color: aliceblue; margin-right: 10px;"></i>
                        <a class="nav-link" href="#">sign in</a>
                    </li> -->


                    <!-- case user has been login  -->
                    <li class="nav-item d-lg-none d-flex align-items-center">
                        <i class="fa-solid fa-user" style="color: aliceblue; margin-right: 10px;"></i>
                        <a class="nav-link" href="/web2/VIEWS/profile/profile.php"> <?=$logined_mini?></a>
                    </li>
                    <?=$logout ?>
                </ul>
            </div>
        </div>
    </nav>


<script>
    document.getElementById("viewCartButton").addEventListener("click", function() {
    // Điều hướng người dùng đến trang giỏ hàng (cart.php)
    window.location.href = "/web2/VIEWS/cart/cart.php";

    });
</script>
</body>
</html>