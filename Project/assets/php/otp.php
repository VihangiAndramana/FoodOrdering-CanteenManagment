<?php require_once "assets/php/otpControl.php"; ?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Check Use Validity</title>
    <link rel="stylesheet" type="text/css" href="assets/css/styleval.css">
</head>

<body>
    <div class="body">
        <div class="form-boxl">
            <img src="assets/img/log/z_pXX-KDU.png" class="logo">
            <h1 class="h1">Check Validity</h1><br>
                    

            <form id="Val" class="input-group" action="otp.php" method="post" autocomplete="off">
               
                <?php
                if(isset($_SESSION['info'])){
                ?>
                <div class="alert alert-success text-center" id="alert">
                    <?php echo $_SESSION['info']; ?>
                </div>
                <?php
                }
                 ?>
                <?php
                if(count($errors) > 0){
                ?>
                <div class="alert alert-danger text-center">
                    <?php
                    foreach($errors as $showerror){
                        echo $showerror;
                    }
                    ?>
                </div>
                <?php
                }
                ?>
                <!-- <label class="hide"> Unknow User. Please check you <br> index/sevice number or contact administrator</label> -->
                <input type="number" class="input-field"  name="otp" id="idno">
                <button type="submit" class="submit-btn" name="check" value="Submit">Check</button>
            </form>
        </div>
    </div>

</body>

</html>