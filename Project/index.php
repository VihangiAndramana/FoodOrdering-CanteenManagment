<?php
$active = "Home";
include("functions.php");
include("header.php");

?>

<section id="hero" class="d-flex align-items-center">
        <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">

            <div class="row">
                <div class="col-lg-12 col-md-6 col-sm-3">

                    <img src="assets\img\log\wc1.png" width="100%" height="100%" alt="">

                </div>
            </div>

        </div>
    </section>

<!-- Banner Section Begin -->




<!-- Today Special Section Begin -->

<section class="man-banner spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="filter-control">
                    <h3> Today's Special </h3>
                </div>
                <div class="product-slider owl-carousel">
                    <?php
                    getMProduct();
                    ?>
                </div>
            </div>
            <!-- <div class="col-lg-3 offset-lg-1">
                <div class="product-large set-bg m-large" data-setbg="img/men-large.jpg">
                    <h2>Men’s</h2>
                    <a href="shop.php?cat_id=ca01">Discover More</a>
                </div>
            </div> -->
        </div>
    </div>
</section>

<!-- Footer -->
<script src="assets/vendor/aos/aos.js"></script>
<?php
include('footer.php');


if (isset($_GET['stat'])) {

    echo "
        <script>
                bootbox.alert({
                    message: 'Welcome! You are logged in.',
                    backdrop: true
                });
        </script>";
}
?>

</body>

</html>