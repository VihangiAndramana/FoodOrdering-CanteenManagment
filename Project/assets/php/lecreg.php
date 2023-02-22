<?php
session_start();
$con = new mysqli("localhost","root", "", "login");
// require "connection.php";
$email = "";
$name = "";
$errors = array();

//if user signup button
if(isset($_POST['signup'])){
    $idnoL = mysqli_real_escape_string($con, $_POST['idnol']);
    $nameL = mysqli_real_escape_string($con, $_POST['namel']);
    $emailL = mysqli_real_escape_string($con, $_POST['emaill']);
    $depL = mysqli_real_escape_string($con, $_POST['depl']);
    $mobileL = mysqli_real_escape_string($con, $_POST['mobilel']);
    $unameL = mysqli_real_escape_string($con, $_POST['unamel']);
    $passwordL = mysqli_real_escape_string($con, $_POST['pwordl']);
    

    $email_check = "SELECT * FROM lecreg WHERE email = '$emailL'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        echo "Existing Users...!";
        // $errors['email'] = "Email that you have entered is already exist!";
    }
    else{
        $stmt = $con->prepare("select * from lecturer where email = ?");
        $stmt->bind_param("s", $emailL);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows < 0){
            echo "No Lec";
        }
        else{
            $encpassL = password_hash($passwordL, PASSWORD_BCRYPT);
            $codeL = rand(999999, 111111);
            $statusL = "notverified";
            $insert_data = "INSERT INTO lecreg (idno, name, email, dep, mobile, uname, pword, code, status)
            values('$idnoL', '$nameL', '$emailL', '$depL', '$mobileL', '$unameL', '$passwordL', '$codeL', '$statusL')";
            $data_check = mysqli_query($con, $insert_data);
            if($data_check){
                $subject = "Email Verification Code";
                $message = "Your verification code is $codeL";
                $sender = "From: shekz.c@gmail.com";
                if(mail($emailL, $subject, $message, $sender)){
                    $info = "We've sent a verification code to your email - $emailL";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $emailL;
                    $_SESSION['password'] = $passwordL;
                    header('location: ..\..\otpL.php');
                    exit();
                }else{
                    // $errors['otp-error'] = "Failed while sending code!";
                    echo "email error";
                }
            }else{
                // $errors['db-error'] = "Failed while inserting data into database!";
                echo "DB Error";
            }

        }

    }

    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM stureg WHERE code = $otp_code";
        echo'$code_res';
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE stureg SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: home.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }
    


}













    //  $idnol = $_POST['idnol'];
    //  $namel = $_POST['namel'];
    //  $emaill = $_POST['emaill'];
    //  $depL = $_POST['depL'];
    //  $mobilel = $_POST['mobilel']; 
    //  $unamel = $_POST['unamel'];
    //  $pwordl = $_POST['pwordl'];
    //  //

     
    // $conn = new mysqli('localhost','root','','login');
    // if($conn->connect_error){
    //     die('Connection Failed : '.$conn->connect_error);
    // }else{
    //     $stmt = $conn->prepare("insert into lecreg(idno,name,email,dep,mobile,uname,pword)
    //     values(?,?,?,?,?,?,?)");
    //     $stmt->bind_param("ssssiss", $idnol, $namel, $emaill, $depl, $mobilel, $unamel, $pwordl);
    //     $stmt->execute();
    //     echo "Register Successfully... ";
    //     $stmt->close();
    //     $conn->close();
    // }
      
?>