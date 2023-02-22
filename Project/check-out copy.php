<?php
$active = "Checkout";
include('db1.php');
include("functions.php");
include("header.php");

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


<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="index.php"><i class="fa fa-home"></i> Home</a>
                    <a href="shop.php">Shop</a>
                    <span>Check Out</span>
                </div>
            </div>
        </div>
        <br>
            <div>
                <h4 class='card' style='text-align: right;  font-weight:600; border-bottom: solid 1px #ababab; background-color: transparent; color: #ffbb00; padding:10px 0'> Account Balance: Rs. <?php echo $credit?></h4>
            </div>
            <br><br>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="checkout-section spad">
    <div class="container">
        <form class="checkout-form">
            <div class="row">
                <div class="col-lg-6" <?php if (!($_SESSION['customer_email'] == 'unset')) {
                                            echo "style = 'margin: 0 auto'";
                                        } ?>>
                        <!-- <div>
                            <h4 class='card' style='text-align: right;  margin: 0 0 0 0;font-weight:600; border-bottom: solid 1px #ababab; background-color: transparent; color: #ffbb00; padding:10px 0'> Account Balance: Rs. <?php echo $credit?></h4>
                        </div>
                        <br><br>     -->
                    <div class="checkout-content">
                        <a href="shop.php" class="content-btn">Continue Shopping</a>
                    </div>
                    <div class="place-order">
                        <h4>Your Order</h4>
                        <div class="order-total">
                            <ul class="order-table">
                                <li>Products <span>Total</span></li>
                                <?php checkoutProds(); ?>

                                <li class="fw-normal">Subtotal <span><?php total_price(); ?></span></li>
                                <li class="total-price">Total <span><?php total_price(); ?></span></li>
                            </ul>
                            <form action="check-out.php" method="post">
                                <div class="order-btn">
                                    <a href="check-out.php?place=1" class="site-btn place-btn">Place Order</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
        </form>
    </div>
</section>
<!-- Shopping Cart Section End -->


<?php
include('footer.php');
?>

</body>

</html>


<?php


if (isset($_GET['place'])) {


    $c_id = $_SESSION['customer_email'];

    $query = "select * from customer where customer_email= '$c_id'";

    $run_query = mysqli_query($con, $query);


    $get_query = mysqli_fetch_array($run_query);

    $custom_id = $get_query['customer_id'];


    $get_items = "select * from cart where c_id = '$c_id'";
    $run_items = mysqli_query($db, $get_items);

    while ($row_items = mysqli_fetch_array($run_items)) {
        $p_id = $row_items['products_id'];
        $pro_qty = $row_items['qty'];

        $get_item = "select * from products1 where products_id = '$p_id'";
        $run_item = mysqli_query($db, $get_item);


        // Updating Product qty 
        $get_p_amount = "select * from product_qty where product_id = '$p_id'";
        $run_item1 = mysqli_query($db, $get_p_amount);
        $row_item1 = mysqli_fetch_array($run_item1);
        $dailyTot = $row_item1['daily_tot'];
        $dailySold = $row_item1['sold_amount'];

        $dailySold = $dailySold+$pro_qty;
        $update = "UPDATE product_qty SET sold_amount = '$dailySold' WHERE product_id = '$p_id' ";
        $run_update = mysqli_query($con, $update);


        while ($row_item = mysqli_fetch_array($run_item)) {

            $pro_price = $row_item['product_price'];

            $total_q += $pro_qty;
            $pro_total_p = $pro_price * $pro_qty;

        }

        $final_price += $pro_total_p;
    }
    $order = "insert into orders (order_qty, order_price, c_id, date) values ('$total_q','$final_price','$custom_id',NOW())";

    $run_order = mysqli_query($con, $order);
    
    // Updating last ammount after confirm an order
    $credit = $credit-$final_price;
    $updateLamount =  "UPDATE credit SET lastAmount = '$credit' WHERE customer_id = '$cid' ";
    $run_update = mysqli_query($con, $updateLamount);


    $cart_clear = "delete from cart where c_id = '$c_id'";

    $run_clear = mysqli_query($con, $cart_clear);

    echo "<script>alert('Order Placed. Thankyou for Shopping')</script>";
    echo "<script>window.open('account.php?orders','_self')</script>";
}







?>