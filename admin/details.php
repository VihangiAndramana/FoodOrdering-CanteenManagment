<?php
$active = "Details";



    $id = $_SESSION['admin_id'];
    $query = "select * from admin where id = '$id'";
    $run_query = mysqli_query($con,$query);
    $row_query = mysqli_fetch_array($run_query);
    
    $cname = $row_query['name'];
    // $cimage = $row_query['customer_image'];
    $cid = $row_query['email'];

    echo  "
    <div class='col-md-6 col-12' style='margin:0px auto'>
    <div class='bg-light text-dark' style='border:solid #e5e5e5 0.2px; padding: 10px 40px'> 
            <div class='ci-text'>
                <span style='font-size:large;font-weight:600'>Email</span>
                <p style='text-align:center;color: #000000'>$cid</p>
            </div>
            <div class='ci-text'>
                <span style='font-size:large;font-weight:600'>Contact</span>
                <p style='text-align:center;color: #000000'>$cname</p>
            </div>
            <div class='ci-text'>
                <span style='font-size:large;font-weight:600'>Address</span>
                <p style='text-align:center;color: #000000'>$cname</p>
            </div>        
         </div>
    </div> 
        ";

