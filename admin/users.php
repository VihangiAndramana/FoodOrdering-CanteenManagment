<?php session_start();
if (!isset($_SESSION['admin_id'])) {
    header("location:login.php");
  } ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
    <div class="row">

        <?php include "./templates/sidebar.php"; ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="index.php"><i class="fa fa-home"></i> <span>Dashboard</span></a>
                    <span>All Users</span>
                </div>
            </div>
        </div>
            <br>
        <div class="row">
            <div class="col-10">
                <h4>All Users</h4>
            </div>
            <div class="col-2">
                <a href="#" id="add_button" data-bs-toggle="modal" data-bs-target="#add_category_modal"
                    class="btn btn-warning btn-sm">
                    <i class="fa fa-plus" style="font-size:25px"></i></a>
                    
            </div>
        </div>
        <br>

        <div class="tab">
      
            <table id="ava" class="table table-dark table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Index</th>
                        <th>Intake</th> 
                        <th>Stream</th>
                        <th>Email</th>
                        <th>Mobile</th>
                    </tr>
                </thead>
            </table>
            </main>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="add_category_modal" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Users</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="cols-md-6">
                        <p style="color: red; font-style: italic; ">Note: <br> 1. File type must be ".csv/ .xlsx/ .xls/
                            .ods"
                            <br> 2. Column headers must be removed.
                            <br> 3. Columns must be in this order -->
                            <br> Name, Index, Intake, Department, Stream, Email, Mobile
                        </p>
                        <form action="users.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="file">Select your .csv/ .xlsx/ .xls/ .ods File</label>
                                <input type="file" name="file" class="form-control" accept=".xls,.xlsx">
                            </div><br>
                            <div align="right">
                                <button type="submit" name="import" class="btn btn-warning"
                                    style="width:125px;">Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->

<?php 
error_reporting(0);
$conn=mysqli_connect("localhost","root","","canteendb");

require_once('plugin/php-excel-reader/excel_reader2.php');
require_once('plugin/SpreadsheetReader.php');

if (isset($_POST["import"]))
{
$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
if(in_array($_FILES["file"]["type"],$allowedFileType)){

	// is uploaded file
	 $targetPath = 'uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        // end is uploaded file

        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {
           $Reader->ChangeSheet($i);

           foreach ($Reader as $Row)
            {
                $name = "";
                if(isset($Row[0])) {
                    $name = mysqli_real_escape_string($conn,$Row[0]);
                }
                     $index = "";
                if(isset($Row[1])) {
                    $index = mysqli_real_escape_string($conn,$Row[1]);
                }
                $intake = "";
                if(isset($Row[2])) {
                    $intake = mysqli_real_escape_string($conn,$Row[2]);
                }
                $stream = "";
                if(isset($Row[3])) {
                    $stream = mysqli_real_escape_string($conn,$Row[3]);
                }
                     $email = "";
                if(isset($Row[4])) {
                    $email = mysqli_real_escape_string($conn,$Row[4]);
                }
                     $mob = "";
                if(isset($Row[5])) {
                    $mob = mysqli_real_escape_string($conn,$Row[5]);
                }

                if (!empty($name) || !empty($index)) {
                    $query = "insert into Student(name,uindex,intake,stream,email,mobile) values('".$name."','".$index."','".$intake."','".$stream."','".$email."','".$mob."')";
                    $result = mysqli_query($conn, $query);
                
                    if ($result) {
                        $type = "success";
                        $message = "Excel Data Imported into the Database";
                        
                    } else {
                        $type = "error";
                        $message = "Problem in Importing Excel Data";
                    }
                }


            }

        }
       
        echo "<script>alert($message);</script>";


}
else
  { 
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
  }

}

 ?>

    <?php include_once("./templates/footer.php"); ?>

    
    <!-- USe datatable plugin -->
    <script type="text/javascript" language="javascript">
    $(document).ready(function() {
        $('#add_button').click(function() {
            $('#pro_form')[0].reset();
            $('.modal-title').text("Add User");
            $('#action').val("Add");
            $('#operationA').val("Add");
            // $('#user_uploaded_image').html('');
        });

        var dataTable = $('#ava').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "fetchUs.php",
                type: "POST"
            },
            "columnDefs": [{
                // Column Ordering
                "targets": [0, 2, 3, 4, 5, 6],
                "orderable": false,
            }, ],

        });

        // $(document).on('submit', '#pro_form', function(event) {
        //     event.preventDefault();
        //     var proTitle = $('#availability').val();
            
        //     if (proTitle != '') {
        //         $.ajax({
        //             url: "insertA.php",
        //             method: 'POST',
        //             data: new FormData(this),
        //             contentType: false,
        //             processData: false,
        //             success: function(data) {
        //                 alert(data);
        //                 $('#pro_form')[0].reset();
        //                 $('#userModal').modal('hide');
        //                 dataTable.ajax.reload();
        //             }
        //         });
        //     } else {
        //         alert("Field cannot be empty");
        //     }
        // });

        // $(document).on('click', '.update', function() {

        //     // fetch id of the item
        //     var user_id = $(this).attr("id");
        //     // window.alert(user_id);

        //     $.ajax({
        //         url: "fetch_singleA.php",
        //         method: "POST",
        //         data: {
        //             user_id: user_id
        //         },
        //         dataType: "json",
        //         success: function(data) {


        //             $('#userModal').modal('show');
        //             $('#availability').val(data.p_cat_id);
        //             $('.modal-title').text("Edit Availability");
        //             $('#user_id').val(user_id);
        //             $('#action').val("Edit");
        //             $('#operationA').val("Edit");
        //         }
        //     })
        // });

        // $(document).on('click', '.delete', function() {
        //     var user_id = $(this).attr("id");
        //     if (confirm("Are you sure you want to delete this?")) {
        //         $.ajax({
        //             url: "deleteA.php",
        //             method: "POST",
        //             data: {
        //                 user_id: user_id
        //             },
        //             success: function(data) {
        //                 alert(data);
        //                 dataTable.ajax.reload();
        //             }
        //         });
        //     } else {
        //         return false;
        //     }
        // });


    });
    </script>