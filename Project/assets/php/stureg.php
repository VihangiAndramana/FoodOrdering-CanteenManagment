<?php
session_start();
$con = new mysqli("localhost","root", "", "login");
// require "connection.php";
$email = "";
$name = "";
$errors = array();

//if user signup button
if(isset($_POST['signup'])){
    $idno = mysqli_real_escape_string($con, $_POST['idno']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $dep = mysqli_real_escape_string($con, $_POST['dep']);
    $intake = mysqli_real_escape_string($con, $_POST['intake']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $uname = mysqli_real_escape_string($con, $_POST['uname']);
    $password = mysqli_real_escape_string($con, $_POST['pword']);
    

    $email_check = "SELECT * FROM stureg WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        echo "Existing Users...!";
        // $errors['email'] = "Email that you have entered is already exist!";
    }
    else{
        $stmt = $con->prepare("select * from student where email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows < 0){
            echo "No Student";
        }
        else{
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $code = rand(999999, 111111);
            $status = "notverified";
            $insert_data = "INSERT INTO stureg (idno, name, email, dep, intake, mobile, uname, pword, code, status)
            values('$idno', '$name', '$email', '$dep', '$intake', '$mobile', '$uname', '$password', '$code', '$status')";
            $data_check = mysqli_query($con, $insert_data);
            if($data_check){
                $subject = "Email Verification Code";
                $message = "Your verification code is $code";
                $sender = "From: shekz.c@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent a verification code to your email \n - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    header('location: ..\..\otp.php');
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
    









    //  $idno = $_POST['idno'];
    //  $name = $_POST['name'];
    //  $email = $_POST['email'];
    //  $dep = $_POST['dep'];
    //  $intake = $_POST['intake'];
    //  $mobile = $_POST['mobile']; 
    //  $uname = $_POST['uname'];
    //  $pword = $_POST['pword'];

    //  //

     
    // $conn = new mysqli('localhost','root','','login');
    // if($conn->connect_error){
    //     die('Connection Failed : '.$conn->connect_error);
    // }else{
    //     $stmt = $conn->prepare("insert into stureg(idno,name,email,dep,intake,mobile,uname,pword)
    //     values(?,?,?,?,?,?,?,?)");
    //     $stmt->bind_param("ssssiiss", $idno, $name, $email, $dep, $intake, $mobile, $uname, $pword);
    //     $stmt->execute();
    //     echo "Registered Successfully... ";
    //     $stmt->close();
    //     $conn->close();
    // }
      
?>