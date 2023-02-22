<?php
require_once('config.php');
include('db1.php');
?>


<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta name="description" content="KDU SC">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KDUSC Canteen.</title>

<!-- Google Fonts Used -->
<link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<!-- Tab Icon -->

<link rel="icon" href="img/icon.png">


<!-- Css Styles -->
<link rel='stylesheet' href='css/bootstrap.min.css' type='text/css'>
<link rel='stylesheet' href='css/font-awesome.min.css' type='text/css'>
<link rel='stylesheet' href='css/themify-icons.css' type='text/css'>
<link rel='stylesheet' href='css/elegant-icons.css' type='text/css'>
<link rel='stylesheet' href='css/owl.carousel.min.css' type='text/css'>
<link rel='stylesheet' href='css/slicknav.min.css' type='text/css'>
<link rel='stylesheet' href='css/style.css' type='text/css'>




</head>

<body>

    <!-- Page Pre Load Section-->

    <div id="preload">
        <div class="load">
        </div>
    </div>

    <!-- Header Section-->

    <header class="header-section">
        <!-- Top Bar -->
        <div class="header-top" id="top">
            <div class="container">

                <div class="f-right">
                    <ul class="nav-right">
                        <li class="user-icon">
                            <div class="login-panel">
                                <i class="fa fa-user-circle" style="font-size:40px" aria-hidden="true"></i>
                            </div>
                            <div class="login-hover">
                                <div class="insidelog">


                                    <?php if ($_SESSION['customer_email'] == 'unset') {
                                        echo "<a href='login.php' class='btn logbtn' style='width: 200px; height:40px'>Login</a>";
                                    } else {
                                        echo "<a href='logout.php' class='btn logbtn' style='width: 200px; height:40px'>Log Out</a>";
                                    } ?>


                                </div>
                                <?php if ($_SESSION['customer_email'] == 'unset') {
                                    echo "<div class='insidelog'>
                                    <span class='small'>or </span><a href='register.php' class='small'>Sign up Now</a>
                                </div>";
                                } ?>
                                <?php if (!($_SESSION['customer_email'] == 'unset')) {
                                    echo "
                                <div class='insidelog' style='border-top: solid 0.2px #e5e5e5;'>
                                    <a href='account.php?orders' class='btn btn-dark' style='color:white;margin:4px 0'>My Account</a>
                                </div>";
                                }
                                ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Middle Bar -->

        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-md-3 logo">
                        <a href="index.php">
                            <span>KDU-SC Canteen</span>
                        </a>
                    </div>

                    <div class="col-md-6">
                        <form method="post">
                            <div class="input-group">
                                <input type="text" name="search" placeholder="Search any Food" required>
                                <button type="submit" name="submit"><i class="ti-search"></i></button>

                            </div>
                        </form>
                    </div>

                    <div class="col-md-3 text-right" style="visibility:      <?php if ($_SESSION['customer_email'] == 'unset') {
                                                                                    echo "hidden";
                                                                                } ?>">
                        <ul class="nav-right">
                            <li class="cart-icon">
                                <a href="shopping-cart.php">
                                    <i class="fa fa-cart-arrow-down" style="font-size:40px" aria-hidden="true"></i>
                                    <span><?php items(); ?></span>
                                </a>
                                <div class="cart-hover">
                                    <div class="select-items">
                                        <table>
                                            <tbody>

                                                <?php cart_icon_prod(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="select-total">
                                        <span>total:</span>
                                        <h5><?php total_price(); ?></h5>
                                    </div>
                                    <div class="select-button">
                                        <a href="shopping-cart.php" class="primary-btn view-card">VIEW ADDED ITEMS</a>
                                        <a href="check-out.php" class="primary-btn checkout-btn">CHECK OUT</a>
                                    </div>
                                </div>
                            </li>
                            <li class="cart-price"><?php total_price(); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <!-- Lower Bar -->


        <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="ti-menu"></i>
                        <span>Avalability</span>
                        <ul class="depart-hover">

                            <?php
                            getProdCat();
                            ?>

                        </ul>
                    </div>
                </div>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="<?php if ($active == 'Home') echo "active" ?>"><a href="index.php">Home</a></li>
                        <li class="<?php if ($active == 'Shop') echo "active" ?>"><a href="<?php if (!($_SESSION['customer_email'] == 'unset')) {
                                                                                                echo "shop.php";
                                                                                            } else {
                                                                                                echo "login.php";
                                                                                            } ?>">Shop</a>
                        </li>
                        <li class="<?php if ($active == 'Contact') echo "active" ?>"><a href="contact.php">Contact</a>
                        </li>

                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>
    <!-- Header End -->


    <?php
    if (isset($_GET['delcart'])) {


        $p_id = $_GET['delcart'];


        $query = "Delete from cart where products_id='$p_id'";

        $run_query = mysqli_query($con, $query);

        echo "<script>window.open('index.php','_self')</script>";
    }


    if (isset($_POST['submit'])) {

        $item = $_POST["search"];

        $get_product = "select * from products1 where product_title LIKE '%$item%' ";

        $run_product = mysqli_query($con, $get_product);

        $count = mysqli_num_rows($run_product);

        if ($count > 0) {

            $row_product = mysqli_fetch_array($run_product);

            $products_id = $row_product['products_id'];
            $product_title = $row_products['product_title'];
            $product_price = $row_products['product_price'];
            $product_img1 = $row_products['product_img1'];



            echo "<script>window.open('product.php?product_id=$products_id','_self')</script>";
        } else {

            echo "
            <script>
                    bootbox.alert({
                        message: 'No product found',
                        backdrop: true
                    });
            </script>";
        }
    }
    ?>