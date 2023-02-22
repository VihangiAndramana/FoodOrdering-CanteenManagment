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
                    <span>Sales</span>
                </div>
            </div>
        </div>
            <br>
        <div class="row">
            <div class="col-10">
                <h4>Sales</h4>
            </div>
            <div class="col-2">
                <a href="..\..\pdfFromDatabase\sales.php" dat class="btn btn-warning btn-sm"><i class="fa fa-download"  style="font-size:25px"></i></a>
            </div>
        </div>
        <br>

        <div class="tab">
      
            <table id="ava" class="table table-dark table-sm">
                <thead>
                    <tr>
                    <th>Products ID</th>
                    <th>Time</th>
                        <th>Product_Name</th>
                        <th>Daily Total Amount</th>
                        <th>Sold Amount</th>
                        <th>Rest Amount</th>
                        <th>Daily Cost (LKR)</th>
                        <th>Daily Sales Value (LKR)</th>
                        <th>Profit/Loss (LKR)</th>
                    </tr>
                </thead>
            </table>
            </main>
        </div>
    </div>





<!-- Modal -->



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
                url: "fetchSa.php",
                type: "POST"
            },
            "columnDefs": [{
                // Column Ordering
                "targets": [0, 2, 3, 4, 5, 6, 7, 8],
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