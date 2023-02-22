<?php
$active = "Account";
include("db1.php");
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
                    <span>Account</span>
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


<!-- #content Begin -->

<div class="container">
    <div class="insider row">
        <div class="col-md-3 col-8" style="padding: 20px 0;">
            <?php

            include("sidebar.php");

            ?>

        </div>

        <div class="col-md-8 col-10" style="padding:20px 0">

        <!-- <div>
            <h4 class='card' style='text-align: right;  margin: 0 0 0 0;font-weight:600; border-bottom: solid 1px #ababab; background-color: transparent; color: #ffbb00; padding:10px 0'> Account Balance: Rs. <?php echo $credit?></h4>
        </div>
        <br><br> -->


            <?php

            if (isset($_GET['orders'])) {
                echo " <h4 class='card' style='text-align: center; margin: 0 0 30px 0;font-weight:600;color: #000000;padding:10px 0 '>My Orders</h4>";

                include("orders.php");
            }

            if (isset($_GET['details'])) {
                echo " <h4 class='card' style='text-align: center; margin: 0 0 30px 0;font-weight:600;color: #000000;padding:10px 0 '>Account Details </h4>";
            
                include("details.php");
            }
            ?>


        </div>
    </div>
</div>






<?php
include('footer.php');
?>

</body>

</html>