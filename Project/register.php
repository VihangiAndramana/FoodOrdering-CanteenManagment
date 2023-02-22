<?php

$active = "Register";
include("db1.php");
include("functions.php");
include('header.php');
$error = "";

?>

<?php

//if student signup button

if (isset($_POST['register'])) {

    $c_email = $_POST['cemail'];
    $uname = $_POST['uname'];
    $pword = $_POST['password'];
    $code = "12345";
    $status = "done";

    //checking for existing users

    $sqlN = "SELECT * FROM customer WHERE customer_email = '$c_email'";
    $run_SqlN = mysqli_query($con, $sqlN);
    if (!(mysqli_num_rows($run_SqlN) > 0)) {

        //checking for kdu users and if yes registering///
        $sql = "SELECT * FROM student WHERE email = '$c_email'";
        $run_Sql = mysqli_query($con, $sql);
        if (mysqli_num_rows($run_Sql) > 0) {
            // if($run_Sql){
            $fetch_info = mysqli_fetch_assoc($run_Sql);
            $index =  $fetch_info['uindex'];
            $name = $fetch_info['name'];
            $email = $fetch_info['email'];
            $strm = $fetch_info['stream'];
            $intake = $fetch_info['intake'];
            $mobile = $fetch_info['mobile'];
            $utype = "Student";

            $c_ip = getRealIpUser();

            $_SESSION['customer_email'] = $c_email;
            $c_id = $_SESSION['customer_email'];

            // $insert_data = "INSERT INTO stureg (idno, name, email, dep, intake, mobile, uname, pword, code, status)
            // values('$idno', '$name', '$email', '$dep', '$intake', '$mobile', '$uname', '$password', '$code', '$status')";
            // $data_check = mysqli_query($con, $insert_data);
            // if($data_check)
            // {
            //     echo "<script>alert('Account registered. You are Logged In')</script>";
            //     echo "<script>window.open('index.php','_self')</script>";
            // }

            $tardir = "img/customer/";

            $fileName = basename($_FILES['pimage']['name']);

            $targetPath = $tardir . $fileName;
            $fileType = pathinfo($targetPath, PATHINFO_EXTENSION);

            $allow = array('jpg', 'png', 'jpeg');


            // if (in_array($fileType, $allow)) {
            //     if (move_uploaded_file($_FILES['pimage']['tmp_name'], $targetPath)) {
            //         $insert_c = "Insert into customer (customer_name,customer_email,customer_pass,customer_address,customer_contact,customer_image,customer_ip)
            // values('$c_name','$c_email','$c_pass','$c_address','$c_contact','$fileName','$c_ip')";
            //     }
            // } else {
            //     echo "<script>alert('Image not Inserted.')</script>";
            // }



            $insert_data = "INSERT INTO customer (customer_name, c_type, index_no, intake, stream, customer_email, customer_pass, customer_contact, customer_image, customer_ip, uname)
            values('$name', '$utype', '$index', '$intake', '$strm', '$email', '$pword', '$mobile', 'img.jpg', '$c_ip', '$uname')";
            $data_check = mysqli_query($con, $insert_data);
            if ($data_check) {

                $sql1 = "SELECT * FROM customer WHERE customer_email = '$c_email'";
                $run_Sql1 = mysqli_query($con, $sql1);
                $fetch_info = mysqli_fetch_assoc($run_Sql1);
                $id =  $fetch_info['customer_id'];

                $insert_data1 = "INSERT INTO `credit` (`customer_id`, `package_id`, `lastAmount`, `lastUpdated` , `renewDate`) VALUES ('$id', 'None', 0.00, current_timestamp(), current_timestamp()); ";
                $data_check1 = mysqli_query($con, $insert_data1);
                if ($data_check1) {
                    echo "<script>alert('Account registered. You are Logged In')</script>";
                    echo "<script>window.open('login.php','_self')</script>";
                } else {
                    echo "<script>alert('Account registered. You are Logged In')</script>";
                }
            } else {
                echo "<script>alert('Account registered. You are Logged In')</script>";
            }
        } else {
            $sql = "SELECT * FROM lecturer WHERE email = '$c_email'";
            $run_Sql = mysqli_query($con, $sql);
            if (mysqli_num_rows($run_Sql) > 0) {
                // if($run_Sql){
                $fetch_info = mysqli_fetch_assoc($run_Sql);
                $name = $fetch_info['name'];
                $email = $fetch_info['email'];
                $dep = $fetch_info['department'];
                $intake = "None";
                $mobile = $fetch_info['mobile'];
                $utype = "Lecturer";

                $c_ip = getRealIpUser();

                $_SESSION['customer_email'] = $c_email;
                $c_id = $_SESSION['customer_email'];

                $insert_data = "INSERT INTO customer (customer_name, c_type, index_no, intake, stream, customer_email, customer_pass, customer_contact, customer_image, customer_ip, uname)
                    values('$name', '$utype', 'None', 'None', '$dep', '$email', '$pword', '$mobile', 'img.jpg', '$c_ip', '$uname')";
                $data_check = mysqli_query($con, $insert_data);
                if ($data_check) {
                    echo "<script>alert('Account registered. You are Logged In')</script>";
                    echo "<script>window.open('index.php','_self')</script>";
                } else {
                    $error = "Not Registered. Please Try Again..";
                    echo "<script>window.open('register.php','_self')</script>";

                    // echo "<script>alert('Account not registered. You are Logged In')</script>";
                }
            } else {
                // echo "<script>alert('Invalid User')</script>";
                $error = "Not a Valid KDU User";
            }
        }
    } else {
        $error = "User Already Registered";
    }

    // $sql = "SELECT * FROM customer WHERE email = '$c_email'";
    // $run_Sql = mysqli_query($con, $sql);
    // if (!(mysqli_num_rows($run_Sql) > 0)) {

    // } else {
    // }

    // $tardir = "img/customer/";

    // $fileName = basename($_FILES['pimage']['name']);

    // $targetPath = $tardir . $fileName;
    // $fileType = pathinfo($targetPath, PATHINFO_EXTENSION);

    // $allow = array('jpg', 'png', 'jpeg');


    // if (in_array($fileType, $allow)) {
    //     if (move_uploaded_file($_FILES['pimage']['tmp_name'], $targetPath)) {
    //         $insert_c = "Insert into customer (customer_name,customer_email,customer_pass,customer_address,customer_contact,customer_image,customer_ip)
    //         values('$c_name','$c_email','$c_pass','$c_address','$c_contact','$fileName','$c_ip')";
    //     }
    // } else {
    //     echo "<script>alert('Image not Inserted.')</script>";
    // }

    // $run_insert = mysqli_query($con, $insert_c);

    // $sel_cart = "select * from cart where c_id = '$c_id'";

    // $run_sel_cart = mysqli_query($con, $sel_cart);

    // $check_cart = mysqli_num_rows($run_sel_cart);

    // if ($check_cart > 0) {

    //     $_SESSION['customer_email'] = $c_email;

    //     echo "<script>alert('Account registered. You are Logged In')</script>";
    //     echo "<script>window.open('check-out.php','_self')</script>";
    // } else {

    //     $_SESSION['customer_email'] = $c_email;

    //     echo "<script>alert('Account registered. You are Logged In')</script>";
    //     echo "<script>window.open('index.php','_self')</script>";
    // }
}

?>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="Index.php"><i class="fa fa-home"></i> Home</a>
                    <span>Register</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Form Section Begin -->

<!-- Register Section Begin -->
<div class="register-login-section spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="register-form">
                    <h2>Register</h2>
                    <form action="register.php" method="post" enctype="multipart/form-data" id="logform">
                        <div>
                            <?php if (isset($error)) { ?>
                                <p align="center" class="error-Reg" style="color:red" S><?php echo $error ?></p>
                            <?php } ?>
                        </div>

                        <div class="group-input">
                            <label for="email">Email *</label>
                            <input type="text" id="eemail" name="cemail" required>
                            <div id="eerr" style="margin:20px 0"></div>
                        </div>

                        <div class="group-input">
                            <label for="uname">Uname *</label>
                            <input type="text" id="uname" name="uname" required>
                            <div id="eerr" style="margin:20px 0"></div>
                        </div>
                        <div class="group-input">
                            <label for="pass">Password *</label>
                            <input type="password" id="pass" name="password" required>
                        </div>
                        <!-- <div class="group-input">
                            <label for="con-pass">Confirm Password *</label>
                            <input type="text" id="con-pass" name="address" required>
                        </div> -->
                        <div class="group-input">
                            <label for="con-pass">Profile Image *</label>
                            <input type="file" name="pimage" style="border: none; margin-top:6px;" required>
                        </div>
                        <button type="submit" class="site-btn register-btn" name="register">REGISTER</button>
                    </form>
                    <div class="switch-login">
                        <a href="login.php" class="or-login">Or Login</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register Form Section End -->

<?php
include('footer.php');
?>
</body>

</html>

<?php

// if (isset($_POST['register'])) {

//     $c_email = $_POST['cemail'];
//     $uname = $_POST['uname'];
//     $pword = $_POST['password'];
//     $code = "12345";
//     $status = "done";

//     $sql = "SELECT * FROM student WHERE email = '$c_email'";
//     $run_Sql = mysqli_query($con, $sql);
//     if (mysqli_num_rows($run_Sql) > 0) {
//         // if($run_Sql){
//         $fetch_info = mysqli_fetch_assoc($run_Sql);
//         $idno =  $fetch_info['idno'];
//         $name = $fetch_info['name'];
//         $email = $fetch_info['email'];
//         $dep = $fetch_info['dep'];
//         $intake = $fetch_info['intake'];
//         $mobile = $fetch_info['mobile'];
//         $utype = "Student";

//         $c_ip = getRealIpUser();

//         $_SESSION['customer_email'] = $c_email;
//         $c_id = $_SESSION['customer_email'];

//         $insert_data = "INSERT INTO stureg (idno, name, email, dep, intake, mobile, uname, pword, code, status)
//         values('$idno', '$name', '$email', '$dep', '$intake', '$mobile', '$uname', '$password', '$code', '$status')";
//         $data_check = mysqli_query($con, $insert_data);
//         if ($data_check) {
//             echo "<script>alert('Account registered. You are Logged In')</script>";
//             echo "<script>window.open('index.php','_self')</script>";
//         }
//     } else {
//         $sql = "SELECT * FROM lecturer WHERE email = '$c_email'";
//         $run_Sql = mysqli_query($con, $sql);
//         if (mysqli_num_rows($run_Sql) > 0) {
//             // if($run_Sql){
//             $fetch_info = mysqli_fetch_assoc($run_Sql);
//             $name = $fetch_info['name'];
//             $email = $fetch_info['email'];
//             $dep = $fetch_info['dep'];
//             $intake = "None";
//             $mobile = $fetch_info['mobile'];
//             $utype = "Lecturer";

//             $c_ip = getRealIpUser();

//             $_SESSION['customer_email'] = $c_email;
//             $c_id = $_SESSION['customer_email'];

//             $insert_data = "INSERT INTO stureg (idno, name, email, dep, intake, mobile, uname, pword, code, status)
//                 values('$idno', '$name', '$email', '$dep', '$intake', '$mobile', '$uname', '$password', '$code', '$status')";
//             $data_check = mysqli_query($con, $insert_data);
//             if ($data_check) {
//                 echo "<script>alert('Account registered. You are Logged In')</script>";
//                 echo "<script>window.open('index.php','_self')</script>";
//             }
//         } else {
//             // echo "<script>alert('Invalid User')</script>";
//             $error = "Not a Valid user";
//         }
//     }
// $tardir = "img/customer/";
// $fileName = basename($_FILES['pimage']['name']);
// $targetPath = $tardir . $fileName;
// $fileType = pathinfo($targetPath, PATHINFO_EXTENSION);

// $allow = array('jpg', 'png', 'jpeg');
// if (in_array($fileType, $allow)) {
//     if (move_uploaded_file($_FILES['pimage']['tmp_name'], $targetPath)) {
//         $insert_c = "Insert into customer (customer_name,customer_email,customer_pass,customer_address,customer_contact,customer_image,customer_ip)
//         values('$c_name','$c_email','$c_pass','$c_address','$c_contact','$fileName','$c_ip')";
//     }
// } else {
//     echo "<script>alert('Image not Inserted.')</script>";
// }

// $run_insert = mysqli_query($con, $insert_c);

// $sel_cart = "select * from cart where c_id = '$c_id'";

// $run_sel_cart = mysqli_query($con, $sel_cart);

// $check_cart = mysqli_num_rows($run_sel_cart);

// if ($check_cart > 0) {

//     $_SESSION['customer_email'] = $c_email;

//     echo "<script>alert('Account registered. You are Logged In')</script>";
//     echo "<script>window.open('check-out.php','_self')</script>";
// } else {

//     $_SESSION['customer_email'] = $c_email;

//     echo "<script>alert('Account registered. You are Logged In')</script>";
//     echo "<script>window.open('index.php','_self')</script>";
// }
//}

?>