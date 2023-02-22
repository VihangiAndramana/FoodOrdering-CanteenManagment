<?php 
session_start();
$con = new mysqli("localhost","root", "", "login");
$emailL = "";
$nameL = "";
$errors = array();

    //if user click verification code submit button
    if(isset($_POST['checkL'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM lecreg WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $emailL = $fetch_data['email'];
            $codeL = 0;
            $status = 'verified';
            $update_otp = "UPDATE lecreg SET code = $codeL, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $nameL;
                $_SESSION['email'] = $emailL;
                header('location: ../../login.html');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }


?>