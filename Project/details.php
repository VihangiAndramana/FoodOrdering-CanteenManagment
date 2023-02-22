<?php
$active = "Details";

if (isset($_GET['details'])) {

    $emal = $_SESSION['customer_email'];
    // $query = "select * from customer where customer_email = '$emal'";
    $query = "SELECT c.customer_name, c.index_no, c.intake, c.department, c.customer_email, c.customer_contact, c.customer_image, cr.package_id, p.package_title, p.package_amount, cr.lastAmount, 
    cr.renew_date FROM customer c JOIN credit cr ON c.customer_id = cr.customer_id JOIN package p ON cr.package_id = p.package_id WHERE  customer_email = '$emal' ";

    $run_query = mysqli_query($con,$query);

    $row_query = mysqli_fetch_array($run_query);

    $cname = $row_query['customer_name'];
    $index = $row_query['index_no'];
    $dep = $row_query['department'];
    $in = $row_query['intake'];
    $cemail = $row_query['customer_email'];
    $ccontact = $row_query['customer_contact'];
    $packID = $row_query['package_id'];
    $pack = $row_query['package_title'];
    $packAmount = $row_query['package_amount'];
    $renew = $row_query['renew_date'];

    echo  "
    <div class='col-md-12 col-12' style='margin:0px auto'>
   
    <div class='form-group'>
        <label class='label' style='color:white; font-weight:600;' for='fullName'>Name</label>
        <input type='text' class='form-control' style='color:Black; font-weight:700; '  id='fullName' disabled value=' $cname'>
    </div>
    <div class='form-group'>
        <label class='label' style='color:white; font-weight:600;' for='fullName'>Index Number</label>
        <input type='text' class='form-control' id='fullName' style='color:Black; font-weight:700; ' disabled value=' $index'>
    </div>

    
   
    <div class='form-group'>
        <label class='label' style='color:white; font-weight:600;' for='fullName'>Department</label>
        <input type='text' class='form-control' style='color:Black; font-weight:700; '  id='fullName' disabled value=' $dep'>
    </div>
    <div class='form-group'>
        <label class='label' style='color:white; font-weight:600;' for='fullName'>Intake</label>
        <input type='text' class='form-control' id='fullName' style='color:Black; font-weight:700; ' disabled value=' $in'>
    </div>

   
    <div class='form-group'>
        <label class='label' style='color:white; font-weight:600;' for='fullName'>Email</label>
        <input type='text' class='form-control' style='color:Black; font-weight:700; '  id='fullName' disabled value=' $cemail'>
    </div>
    <div class='form-group'>
        <label class='label' style='color:white; font-weight:600;' for='fullName'>Contact Number</label>
        <input type='text' class='form-control' id='fullName' style='color:Black; font-weight:700; ' disabled value=' $ccontact'>
    </div>

   
    <div class='form-group'>
        <label class='label' style='color:white; font-weight:600;' for='fullName'>Package Id</label>
        <input type='text' class='form-control' style='color:Black; font-weight:700; '  id='fullName' disabled value=' $pack'>
    </div>
   
    <div class='form-group'>
        <label class='label' style='color:white; font-weight:600;' for='fullName'>Package Amount</label>
        <input type='text' class='form-control' style='color:Black; font-weight:700; '  id='fullName' disabled value=' $packAmount'>
    </div>
    <div class='form-group'>
        <label class='label' style='color:white; font-weight:600;' for='fullName'>Last Renew Date</label>
        <input type='text' class='form-control' id='fullName' style='color:Black; font-weight:700; ' disabled value=' $renew'>
    </div>



    </div> 
        ";
}
