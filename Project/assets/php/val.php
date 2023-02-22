<?php
    $idno = $_POST['idno'];
   
    $fir= substr($idno,0,1); 
    if('D'===$fir)
    {  
        $con = new mysqli("localhost","root", "", "login");
        if($con-> connect_error){
        die("Faild to connect : ".$con->connect_error);
        } else {
        $stmt = $con->prepare("select * from student where idno = ?");
        $stmt->bind_param("s", $idno);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows > 0){
            echo " <script type ='text/javascript'>document.location='../../reg.php'</script>";
        }else{
            echo " <script type ='text/javascript'>document.location='../../validity.html'</script>";
        }
    }
    }
    else{
        $con = new mysqli("localhost","root", "", "login");
        if($con-> connect_error){
        die("Faild to connect : ".$con->connect_error);
        } else {
        $stmt = $con->prepare("select * from lecturer where idno = ?");
        $stmt->bind_param("s", $idno);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows > 0){
            echo " <script type ='text/javascript'>document.location='../../reg.php'</script>";
        }else{
            echo " <script type ='text/javascript'>document.location='../../validity.html'</script>";
        }
    }
    }
    
?>