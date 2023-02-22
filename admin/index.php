<?php 
session_start();  
if (!isset($_SESSION['admin_id'])) {
  header("location:login.php");
}

?>
<?php include "./templates/top.php";  ?>
<?php include "./templates/navbar.php"; ?>
<div class="container-fluid">
    <div class="row">
        <?php include "./templates/sidebar.php"; ?>

        <!-- Breadcrumb Section Begin -->
        <!-- <div class="breacrumb-section"> -->
        <!-- <div class="container"> -->
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="index.php"><i class="fa fa-home"></i><span> Dashboard</span> </a>
                </div>
            </div>
        </div>
        <!-- </div> -->
        <!-- </div> -->
        <br>
        <!-- Breadcrumb Form Section Begin -->

        <h2>Welcome to Admin's Panel</h2>
    <br><br><br>
        <div class="container">
            <div class="row" style="left: 50px; position:relative;">
                <div class="col-6">
               
                   <center>
                   <a class="nav-link <?php echo ($page == 'orders.php') ? 'active' : ''; ?>" href="orders.php">
                    <span data-feather="file"></span>
                    <button type="button" class="btn btn-warning btn-lg"  style=" width: 120px">Orders</button>
                </a>
                   </center> 
                </div>
                <div class="col-6">
                <a class="nav-link <?php echo ($page == 'products1.php') ? 'active' : ''; ?>" href="products1.php">
                    <span data-feather="file"></span>
                    <button type="button" class="btn btn-warning btn-lg"  style=" width: 120px">Prodcuts</button>
                </a>
                   
                </div>
                <!-- <div class="col-4">
                    <button type="button" class="btn btn-warning btn-lg">Warning</button>
                </div> -->
            </div>
        </div>
        <br><br><br>

        </main>

    </div>
</div>



<?php  include "./templates/footer.php"; ?>


<!-- Button trigger modal -->

<div class="modal fade" id="userModal">
    <div class="modal-dialog">
        <form method="post" id="pro_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Add </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <label>Product Title</label>
                    <input type="text" name="product_title" id="product_title" class="form-control" />
                    <br />

                    <label>Category Name</label>
                    <select class="form-control category_list" name="e_cat_id" id="e_cat_id">
                        <option value="">Select Category</option>
                        <?php
						$sql = "SELECT cat_id, cat_title FROM category";
						$resultset = mysqli_query($conn, $sql);
						while ($rows = mysqli_fetch_assoc($resultset)) {
						?>
                        <option value="<?php
											echo $rows["cat_id"]; ?>"><?php echo $rows["cat_title"]; ?></option>
                        <?php }	?>
                    </select>
                    <br />

                    <label>Availability</label>
                    <select class="form-control category_list" name="availa" id="availa">
                        <option value="">Select Availability</option>
                        <?php
						$sql = "SELECT p_cat_id, p_cat_title FROM availability; ";
						$resultset = mysqli_query($conn, $sql);
						while ($rows = mysqli_fetch_assoc($resultset)) {
						?>
                        <option value="<?php
											echo $rows["p_cat_id"]; ?>"><?php echo $rows["p_cat_title"]; ?></option>
                        <?php }	?>
                    </select>
                    <br />

                    <label>Cost</label>
                    <input type="number" name="cost" id="cost" class="form-control" />
                    <br />

                    <label>Price</label>
                    <input type="number" name="price" id="price" class="form-control" />
                    <br />

                    <label>Select User Image</label>
                    <input type="file" name="user_image" id="user_image" />
                    <span id="user_uploaded_image"></span>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="user_id" id="user_id" />
                    <input type="hidden" name="operation" id="operation" />
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        $('.modal-title').text("Add User");
        $('#action').val("Add");
        $('#operation').val("Add");
        $('#user_uploaded_image').html('');
    });

    var dataTable = $('#user_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "fetch.php",
            type: "POST"
        },
        "columnDefs": [{
            // Column Ordering
            "targets": [0, 2, 3, 4, 5, 6, 7],
            "orderable": false,
        }, ],

    });

    $(document).on('submit', '#pro_form', function(event) {
        event.preventDefault();
        var proTitle = $('#product_title').val();
        var category = $('#e_cat_id').val();
        var availability = $('#availa').val();
        var cost = $('#cost').val();
        var price = $('#price').val();
        var extension = $('#user_image').val().split('.').pop().toLowerCase();
        if (extension != '') {
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert("Invalid Image File");
                $('#user_image').val('');
                return false;
            }
        }
        if (proTitle != '' && category != '' && availability != '' && category != '' && cost != '' &&
            price != '') {
            $.ajax({
                url: "insert.php",
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
            url: "fetch_single.php",
            method: "POST",
            data: {
                user_id: user_id
            },
            dataType: "json",
            success: function(data) {


                $('#userModal').modal('show');
                $('#product_title').val(data.product_title);
                //$("select[name='availa']").val(data.p_cat_title);
                // $("select[name='e_cat_id']").val(data.cat_title);
                $('#e_cat_id').val(data.cat_title);
                $('#availa').val(data.p_cat_title);
                $('#cost').val(data.cost);
                $('#price').val(data.product_price);
                $('.modal-title').text("Edit Product");
                $('#user_id').val(user_id);
                $('#user_uploaded_image').html(data.user_image);
                $('#action').val("Edit");
                $('#operation').val("Edit");
            }
        })
    });

    $(document).on('click', '.delete', function() {
        var user_id = $(this).attr("id");
        if (confirm("Are you sure you want to delete this?")) {
            $.ajax({
                url: "delete.php",
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