<?php session_start();
if (!isset($_SESSION['admin_id'])) {
    header("location:login.php");
  } ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
    <div class="row">

        <?php include "./templates/sidebar.php"; ?>

        <!-- Breadcrumb Section Begin -->
        <!-- <div class="breacrumb-section"> -->
        <!-- <div class="container"> -->
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="index.php"><i class="fas fa-home"></i> <span>Dashboard</span></a>
                    <span>Customers</span>
                </div>
            </div>
        </div>
        <!-- </div> -->
        <!-- </div> -->
        <br>
        <!-- Breadcrumb Form Section Begin -->

        <div class="row">
            <div class="col-10">
                <h4>Customers</h4>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-dark table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Index</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Intake</th>
                        <th>Mobile</th>
                        <th>Username</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody id="customer_list">
                    <!-- <tr>
              <td>1</td>
              <td>ABC</td>
              <td>FDGR.JPG</td>
              <td>122</td>
              <td>eLECTRONCS</td>
              <td>aPPLE</td>
              <td><a class="btn btn-sm btn-info"></a><a class="btn btn-sm btn-warning">Delete</a></td>
            </tr> -->
                </tbody>
            </table>
        </div>
        </main>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-product-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" name="product_name" class="form-control"
                                    placeholder="Enter Product Name">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Brand Name</label>
                                <select class="form-control brand_list" name="brand_id">
                                    <option value="">Select Brand</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Category Name</label>
                                <select class="form-control category_list" name="category_id">
                                    <option value="">Select Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product Description</label>
                                <textarea class="form-control" name="product_desc"
                                    placeholder="Enter product desc"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product Price</label>
                                <input type="number" name="product_price" class="form-control"
                                    placeholder="Enter Product Price">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product Keywords <small>(eg: apple, iphone, mobile)</small></label>
                                <input type="text" name="product_keywords" class="form-control"
                                    placeholder="Enter Product Keywords">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product Image <small>(format: jpg, jpeg, png)</small></label>
                                <input type="file" name="product_image" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" name="add_product" value="1">
                        <div class="col-12">
                            <button type="button" class="btn btn-warning add-product">Add Product</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<?php include_once("./templates/footer.php"); ?>



<script>
$(document).ready(function() {

    getCustomers();

    function getCustomers() {
        $.ajax({
            url: 'classes/Customers1.php',
            method: 'POST',
            data: {
                GET_CUSTOMERS: 1
            },
            success: function(response) {

                console.log(response);
                var resp = $.parseJSON(response);
                if (resp.status == 202) {

                    var customersHTML = "";

                    $.each(resp.message, function(index, value) {

                        customersHTML += '<tr>' +
                    
                            '<td>' + value.id + '</td>' +
                            '<td>' + value.idno + '</td>' +
                            '<td>' + value.name + '</td>' +
                            '<td>' + value.email + '</td>' +
                            '<td>' + value.dep + '</td>' +
                            '<td>' + value.intake + '</td>' +
                            '<td>' + value.mobile + '</td>' +
                            '<td>' + value.uname + '</td>' +
                            '</tr>'

                    });

                    $("#customer_list").html(customersHTML);

                } else if (resp.status == 303) {

                }

            }
        })

    }

});
</script>