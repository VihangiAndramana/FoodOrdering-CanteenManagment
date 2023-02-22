<?php
$active = "Product";
include("db1.php");
include("functions.php");
include('header.php');

// getting current user's id
$emal = $_SESSION['customer_email'];
$query = "select * from customer where customer_email = '$emal'";
$run_query = mysqli_query($con,$query);
$row_query = mysqli_fetch_array($run_query);

// getting credit amount
$cid = $row_query['customer_id'];
$check_credit = "select lastAmount from credit where customer_id = '$cid'";
$run_query1 = mysqli_query($con,$check_credit);
$row_query1 = mysqli_fetch_array($run_query1);
$credit = $row_query1['lastAmount'];

?>
<div style="overflow: hidden;">
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="index.php"><i class="fa fa-home"></i> Home</a>
                        <a href="shop.php">Shop</a>
                        <span>Details</span>
                    </div>
                </div>
            </div>
            <br>
            <div>
            <h4 class='card'
                style='text-align: right;  font-weight:600; border-bottom: solid 1px #ababab; background-color: transparent; color: #ffbb00; padding:5px 0 0 0 '>
                <i class="fas fa-coins" style="font-size: 35px"> <span
                        style=" font-size: 25px;font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color :beige">
                        Rs. <?php echo $credit?></span></i>
            </h4>
        </div>
            <br><br>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details">
        <div class="container">
            <!-- <div>
                <h4 class='card' style='text-align: right;  font-weight:600; border-bottom: solid 1px #ababab; background-color: transparent; color: #ffbb00; padding:10px 0'> Account Balance: Rs. <?php echo $credit?></h4>
            </div>
            <br><br>     -->
            <div class="row">
                <div class="col-lg-3">
                    <div class="filter-widget">
                        <h4 class="fw-title">Categories</h4>
                        <ul class="filter-catagories">
                            <?php

                            getCat();

                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <?php

                        
                        
                        getProd();
                        //addCart();

                        ?>



                        <form action='product.php?add_cart=<?php if (isset($_GET['products_id'])) {
                                                                $products_id = $_GET['products_id'];
                                                                echo $products_id;
                                                            } ?>' method='post'>

                            <div class="form-group">
                                <!-- form-group Begin -->
                                <div class='quantity'>
                                    <div class='pro-qty'>
                                        <input type='text' value='1' name="product_qty">
                                    </div>
                                </div>
                            </div>
                            <!-- Food type form-group Finish -->

                            <!-- form-group Begin -->
                            <!-- <div class="form-group">
                                <div class='pd-size-choose'>
                                    <div class='sc-item'>
                                        <input type='radio' id='sm-size' class="form-control" name='size' value="Small" required novalidate>
                                        <label for='sm-size'>s</label>
                                    </div>
                                    <div class='sc-item'>
                                        <input type='radio' id='md-size' class="form-control" name='size' value="Medium">
                                        <label for='md-size'>m</label>
                                    </div>
                                    <div class='sc-item'>
                                        <input type='radio' id='lg-size' class="form-control" name='size' value="Large">
                                        <label for='lg-size'>l</label>
                                    </div>
                                    <div class='sc-item'>
                                        <input type='radio' id='xl-size' class="form-control" name='size' value="XL">
                                        <label for='xl-size'>xl</label>
                                    </div>
                                </div>
                                <p id="msg"></p>
                            </div> -->
                            <!-- form-group Finish -->
                            <?php if ($_SESSION['customer_email'] == 'unset') {
                                echo "<a href='login.php' class='btn primary-btn pd-cart' style='margin-top: 20px;'> Add to cart</a>";
                            } else {
                                echo "<button class='btn primary-btn pd-cart' id='cartbtn' style='margin-top: 20px;'> Add to cart</button>";
                            }
                            ?>
                        </form>

                    </div>
                </div>
            </div>
        </div>
</div>

</section>


<!-- <div class="related-products spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>More like this</h2>
                </div>
            </div>
        </div>

        <div class="row">

            <?php

            relatedProducts();
            ?>

        </div>
    </div>
</div>
</div> -->

<?php
include('footer.php');
?>

<script>
    // $("#cartbtn").on('click', function() {
    //     var atLeastOneChecked = false;
    //     if (!$("input[name='size']").is(':checked')) {

    //         $("#msg").html(
    //             "<span class='alert alert-danger'>" +
    //             "Please Choose Size </span>");
    //     } else {
    //         return;
    //     }

    // });
</script>

</body>

</html>