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
                    <a href="index.php"><i class="fa fa-home"></i> <span>Dashboard</span></a>
                    <span>User's Credit</span>
                </div>
            </div>
        </div>
        <!-- </div> -->
        <!-- </div> -->
        <br>
        <!-- Breadcrumb Form Section Begin -->

        <div class="row">
            <div class="col-10">
                <h4>User's Credit</h4>
            </div>
            <div class="col-2">
                <a href="#" data-toggle="modal" data-target="#add_product_modal" class="btn btn-warning btn-sm"><i
                        class="fa fa-plus" style="font-size:25px"></i></a>
            </div>
        </div>
        <br>

        <div class="table-responsive">
            <table class="table table-dark table-sm">
                <thead>
                    <tr>
                    <th>Id</th>
                        <th>Name</th>
                        <th>Package ID</th>
                        <th>Packege Name</th>
                        <th>Packege Value</th>
                        <th>User Balance</th>
                        <th>Last Renew Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="product_list">
                    <!-- <tr>
              <td>1</td>
              <td>ABC</td>
              <td>FDGR.JPG</td>
              <td>122</td>
              <td>eLECTRONCS</td>
              <td>aPPLE</td>
              <td><a class="btn btn-sm btn-info"></a><a class="btn btn-sm btn-danger">Delete</a></td>
            </tr> -->
                </tbody>
            </table>
        </div>
        </main>
    </div>
</div>



<!-- Add Product Modal start -->
<div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User Credit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-credit-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Index No</label>
                                <input type="text" name="index_no" class="form-control"
                                    placeholder="Enter Index No">
                            </div>
                        </div>
                    
                        <div class="col-12">
                            <div class="form-group">
                                <label>Package Name</label>
                                <select class="form-control category_list" name="package_id">
                                    <option value="">Select Package</option>
                                </select>
                            </div>
                        </div>       
                        <input type="hidden" name="add_credit" value="1">
                        <div class="col-12">
                            <button type="button" class="btn btn-warning add-credit">Add User</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div> 
</div>
<!-- Add Product Modal end -->

<!-- Edit Product Modal start -->
<div class="modal fade" id="edit_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User Credit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-product-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Index No</label>
                                <input type="text" name="e_product_name" class="form-control"
                                    placeholder="Enter Product Name">
                            </div>
                        </div>
                   
                        <div class="col-12">
                            <div class="form-group">
                                <label>Package Name</label>
                                <select class="form-control category_list" name="e_cat_id">
                                    <option value="">Select Package</option>
                                </select>
                            </div>
                        </div>
                      
                        <input type="hidden" name="pid">
                        <input type="hidden" name="edit_product" value="1">
                        <div class="col-12">
                            <button type="button" class="btn btn-warning submit-edit-product">Add Product</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Product Modal end -->

<?php include_once("./templates/footer.php"); ?>



<script>
$(document).ready(function() {

    var productList;

    function getCredits() {
        $.ajax({
            url: '../admin/classes/Products1.php',
            method: 'POST',
            data: {
                GET_CREDITS: 1
            },
            success: function(response) {
                //console.log(response);
                var resp = $.parseJSON(response);
                if (resp.status == 202) {

                    var productHTML = '';

                    productList = resp.message.credits;

                    if (productList) {
                        $.each(resp.message.credits, function(index, value) {

                            productHTML += '<tr>' +
                                '<td>' + value.customer_id + '</td>' +
                                '<td>' + value.customer_name + '</td>' +
                                '<td>' + value.package_id + '</td>' +
                                '<td>' + value.package_title + '</td>' +
                                '<td>' + value.package_amount + '</td>' +
                                '<td>' + value.lastAmount + '</td>' +
                                '<td>' + value.renew_date + '</td>' +
                                '<td><a class="btn btn-sm btn-warning edit-product" style="color:#fff;"><span style="display:none;">' +
                                JSON.stringify(value) +
                                '</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a pid="' +
                                value.products_id +
                                '" class="btn btn-sm btn-warning delete-product" style="color:#fff;"><i class="fas fa-trash-alt"></i></a></td>' +
                                '</tr>'

                        });

                        $("#product_list").html(productHTML);
                    }

                    var catSelectHTML = '<option value="">Select Package</option>';
                    $.each(resp.message.category, function(index, value) {

                        catSelectHTML += '<option value="' + value.package_id + '">' + value
                            .package_title + '</option>';

                    });

                    $(".category_list").html(catSelectHTML);

                 

                }
            }

        });
    }

    getCredits();

    $(".add-credit").on("click", function() {

        $.ajax({

            url: '../admin/classes/Products1.php',
            method: 'POST',
            data: new FormData($("#add-product-form")[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                console.log(response);
                var resp = $.parseJSON(response);
                if (resp.status == 202) {
                    $("#add-product-form").trigger("reset");
                    $("#add_product_modal").modal('hide');
                    getProducts();
                } else if (resp.status == 303) {
                    alert(resp.message);
                }
            }

        });

    });


    $(document.body).on('click', '.edit-product', function() {

        console.log($(this).find('span').text());

        var product = $.parseJSON($.trim($(this).find('span').text()));

        console.log(product);

        $("input[name='e_product_name']").val(product.product_title);
        $("select[name='e_p_cat_id']").val(product.p_cat_id);
        $("select[name='e_cat_id']").val(product.cat_id);
        $("input[name='e_product_price']").val(product.product_price);
        $("input[name='e_product_keywords']").val(product.product_keywords);
        $("input[name='e_product_image']").siblings("img").attr("src", "product_images/" + product
            .product_img1);
        $("input[name='pid']").val(product.products_id);
        $("#edit_product_modal").modal('show');

    });

    $(".submit-edit-product").on('click', function() {

        $.ajax({

            url: '../admin/classes/Products1.php',
            method: 'POST',
            data: new FormData($("#edit-product-form")[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                console.log(response);
                var resp = $.parseJSON(response);
                if (resp.status == 202) {
                    $("#edit-product-form").trigger("reset");
                    $("#edit_product_modal").modal('hide');
                    getProducts();
                    alert(resp.message);
                } else if (resp.status == 303) {
                    alert(resp.message);
                }
            }

        });


    });

    $(document.body).on('click', '.delete-product', function() {

        var pid = $(this).attr('pid');
        if (confirm("Are you sure to delete this item ?")) {
            $.ajax({

                url: '../admin/classes/Products1.php',
                method: 'POST',
                data: {
                    DELETE_PRODUCT: 1,
                    pid: pid
                },
                success: function(response) {
                    console.log(response);
                    var resp = $.parseJSON(response);
                    if (resp.status == 202) {
                        getProducts();
                    } else if (resp.status == 303) {
                        alert(resp.message);
                    }
                }

            });
        } else {
            alert('Cancelled');
        }


    });

});
</script>