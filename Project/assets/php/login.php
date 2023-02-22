<?php
// POST method to get data from browser client to  web server
    $uname = $_POST['uname'];
    $powrd = $_POST['pword'];

    // fir is a variabl that equals to the first letter of the username
    $fir= substr($uname,0,1); 

    // s stands for checking student 
    if('s'===$fir)
    {
        // Connecting to database
        $con = new mysqli("localhost","root", "", "login");
        if($con-> connect_error){
        die("Faild to connect : ".$con->connect_error);
        } else {
            //change stmt to select_user ***************************
        $stmt = $con->prepare("select * from stureg where uname = ?");
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows > 0){
            $data = $stmt_result->fetch_assoc();
            if($data['pword'] === $powrd){
               echo " <script type ='text/javascript'>document.location='../../Menu Page/Home.html'</script>";
            }
            else{
                echo"$fir";
            }
        }else{
            echo"$fir";
        }
    }

    }
    else {
        
    $con = new mysqli("localhost","root", "", "login");
    if($con-> connect_error){
        die("Faild to connect : ".$con->connect_error);
    } else {
        $stmt = $con->prepare("select * from lecreg where uname = ?");
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows > 0){
            $data = $stmt_result->fetch_assoc();
            if($data['pword'] === $powrd){
                echo " <script type ='text/javascript'>document.location='../../Menu Page/Home.html'</script>";
            }
            else{
                echo"$hi";
            }
           
        }else{
            echo"";
        }
    }

    }

?>