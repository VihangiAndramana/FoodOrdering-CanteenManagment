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
                    <span>User Credits</span>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-10">
                <h4>User Credits</h4>
            </div>
            <div class="col-2">
                <a href="#" id="add_button" data-bs-toggle="modal" data-bs-target="#userModal"
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
                        <th>Package ID</th>
                        <th>Package Name</th>
                        <th>Package Value</th>
                        <th>User Balance</th>
                        <th>Last Updated Date</th>
                        <th>Last Renewed Date</th>
                        
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
            </main>
        </div>
    </div>



    <!-- Add Product Modal start -->


    <?php include_once("./templates/footer.php"); ?>

    <div class="modal fade" id="userModal">
        <div class="modal-dialog">
            <form method="post" id="pro_form" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Add </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <label>Email </label>
                        <input type="text" name="uemail" id="uemail" class="form-control" />
                        <br />

                        <label>Package</label>
                        <select class="form-control category_list" name="availa" id="availa">
                            <option value="">Select Package</option>
                            <?php
						$sql = "SELECT package_id, package_title FROM package; ";
						$resultset = mysqli_query($conn, $sql);
						while ($rows = mysqli_fetch_assoc($resultset)) {
						?>
                            <option value="<?php
											echo $rows["package_id"]; ?>"><?php echo $rows["package_title"]; ?></option>
                            <?php }	?>
                        </select>
                        <br />

                        <label>Cost</label>
                        <input type="number" name="cost" id="cost" class="form-control" />
                        <br />
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="user_id" id="user_id" />
                        <input type="hidden" name="operation" id="operation" />
                        <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- USe datatable plugin -->
    <script type="text/javascript" language="javascript">
    $(document).ready(function() {
        $('#add_button').click(function() {
            $('#pro_form')[0].reset();
            $('.modal-title').text("Add User Credit");
            $('#action').val("Add");
            $('#operation').val("Add");
        });

        var dataTable = $('#ava').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "fetchCrdt.php",
                type: "POST"
            },
            "columnDefs": [{
                // Column Ordering
                "targets": [0, 2],
                "orderable": false,
            }, ],

        });

        $(document).on('submit', '#pro_form', function(event) {
            event.preventDefault();
            var email = 'aaaa';
            var availa = $('#availa').val();
            var cost = $('#cost').val();

            if (email != '' && availa != '' && cost !=
                '') {
                $.ajax({
                    url: "insertCrdt.php",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        alert(data);
                        $('#pro_form')[0].reset();
                        $('#userModal').modal('hide');
                        dataTable.ajax.reload();
                    }
                });
            } else {
                alert("Both Fields are Required");
            }
        });

        $(document).on('click', '.update', function() {

            // fetch id of the item
            var user_id = $(this).attr("id");
            // window.alert(user_id);

            $.ajax({
                url: "fetch_singleCrdt.php",
                method: "POST",
                data: {
                    user_id: user_id
                },
                dataType: "json",
                success: function(data) {


                    $('#userModal').modal('show');
                    $('#uemail').val(data.product_title);
                    $('#availa').val(data.cat_title);
                    $('#cost').val(data.p_cat_title);
                    $('.modal-title').text("Edit User Credits");
                    $('#user_id').val(user_id);
                    $('#action').val("Edit");
                    $('#operation').val("Edit");
                }
            })
        });

            $(document).on('click', '.delete', function() {
                var user_id = $(this).attr("id");
                if (confirm("Are you sure you want to delete this?")) {
                    $.ajax({
                        url: "deleteCrdt.php",
                        method: "POST",
                        data: {
                            user_id: user_id
                        },
                        success: function(data) {
                            alert(data);
                            dataTable.ajax.reload();
                        }
                    });
                } else {
                    return false;
                }
            });


    });
    </script>