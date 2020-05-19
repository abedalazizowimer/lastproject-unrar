
<?php

require "includes/db.php";
session_start();

if(isset($_POST["add_to_cart_button"])){
    $_SESSION['car'][$_POST['add_to_cart_button']]=$_POST['add_to_cart_button'];
    if(isset( $_SESSION['quantity'][$_POST['add_to_cart_button']])) {
        $_SESSION['quantity'][$_POST['add_to_cart_button']] += $_POST['quantity'];
    }
    else{
        $_SESSION['quantity'][$_POST['add_to_cart_button']]=0;
        $_SESSION['quantity'][$_POST['add_to_cart_button']] += $_POST['quantity'];
    }
    ob_start();
    header("location:single-product.php?id=$_GET[id]");

}
if(isset($_SESSION['car'])){

foreach ($_SESSION['car'] as $car_id){
    $sql="SELECT name,car_id, carName, cars.image, date_OF_made,quantity,state, carDesc, price, cars.brand_id 
                              FROM cars inner join brand on cars.brand_id=brand.brand_id where car_id=$car_id";
    $result=mysqli_query($conn,$sql);
    while ($row = mysqli_fetch_assoc($result)){
    $carCart[]=$row;
    }

}}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .frmSearch {border: 1px solid #a8d4b1;background-color: #c6f7d0;margin: 2px 0px;padding:40px;border-radius:4px;}
        #country-list{float:left;list-style:none;margin-top:-3px;padding:0;width:334px;position: absolute;font-size:15px;}
        #country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;height: 30px}
        #country-list li:hover{background:#ece3d2;cursor: pointer;}
        #search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
    </style>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Car Store</title>

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="header-area">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-12">
                <div class="user-menu">
                    <ul>
                        <li><a href="http://localhost/lastproject/public/profile.php"><i class="fa fa-user"></i> My Account</a></li>

                        <?php
                        if(!isset($_SESSION['customerId'])){
                        ?>
                        <li><a href="login.php"><i class="fa fa-user"></i> Login</a></li>
                        <?php } else {?>
                        <li><a href="logout.php"><i class="fa fa-user"></i> logout</a></li>
                        <?php } ?>
                    </ul>
                    
                </div>
            </div>


        </div>
    </div>
</div> <!-- End header area -->

<div class="site-branding-area">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-sm-6">
                <div class="logo">
                    <h1><a href="index.php">e<span>-Car store</span></a></h1>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="shopping-item">
                    <a href="cart.php">Cart <span class="cart-amunt"><i class="fa fa-shopping-cart"></i>
                        <span class="product-count"><?php if(isset($carCart)){echo count($carCart);}?></span></a>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End site branding area -->

<div class="mainmenu-area">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="shop.php">Shop page</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="checkout.php">Checkout</a></li>
                    <li><a href="order.php"> My orders</a></li>
                  <li>
            </div>
                </ul>


            </div>
        </div>
    </div>
</div>


    <!-- End mainmenu area -->