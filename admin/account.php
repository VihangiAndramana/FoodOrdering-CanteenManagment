<?php session_start();
$con = mysqli_connect("localhost","root", "", "canteenDb");
include_once("./templates/top.php");
include_once("./templates/navbar.php"); 

// getting current user's id
$id = $_SESSION['admin_id'];
$query = "select * from admin where id = '$id'";
$run_query = mysqli_query($con,$query);
$row_query = mysqli_fetch_array($run_query);

$cname = $row_query['name'];
// $cimage = $row_query['customer_image'];
$cid = $row_query['email'];

// // $row_query = mysqli_fetch_array($run_query);

// if(mysqli_num_rows($run_query) > 0){
//     // if($run_Sql){
//         $fetch_info = mysqli_fetch_assoc($run_Sql);
//         $name = $fetch_info['name'];
//         $email = $fetch_info['email'];
//         // $dep = $fetch_info['dep'];
//         // $intake = $fetch_info['intake'];
//         // $mobile = $fetch_info['mobile'];
       
//     }

 ?>
<div class="row">
<?php include "./templates/sidebar.php"; ?>

<!-- Breadcrumb Section Begin -->
<!-- <div class="breacrumb-section"> -->
    <!-- <div class="container"> -->
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="index.php"><i class="fa fa-home"></i> <span>Dashboard</span> </a>
                    <span>Account</span>
                </div>
            </div>
        </div>
    <!-- </div> -->
<!-- </div> -->

<!-- #content Begin -->

<div class="container">
    <div class="insider row">
        <div class="col-md-3 col-8" style="padding: 20px 0;">
            <?php

            include("sidebar-admin.php");

            ?>

        </div>

        <div class="col-md-8 col-10" style="padding:20px 0">

            <?php

            {
                echo " <h4 class='card' style='text-align: center; margin: 0 0 30px 0;font-weight:600;color: #000000;padding:10px 0 '>Account Details </h4>";
            
                include("details.php");
            }
            ?>


        </div>
    </div>
</div>

</div>










<?php
// include('footer.php');
?>

</body>

</html>