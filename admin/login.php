<?php include "./templates/top.php"; ?>

<?php include "./templates/navbar.php"; ?>

<div class="register-login-section spad">
<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
        <div class="login-form">
            <h2>Admin Login</h2>
            <!-- <h4 style="text-align: center;" class="center">Admin Login</h4> -->
            <p class="message"></p>
            <form id="admin-login-form">
                <div class="group-input">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                </div>
                <div class="group-input">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                <input type="hidden" name="admin_login" value="1">
                <button style="color: white; font-weight:700; " type="button" class="btn btn-warning login-btn">Submit</button>
            </form>
        </div>
    </div>
    </div>
</div>
</div>






<?php include "./templates/footer.php"; ?>

<script>
$(document).ready(function() {


    $(".login-btn").on("click", function() {

        $.ajax({
            url: '../admin/classes/Credentials.php',
            method: "POST",
            data: $("#admin-login-form").serialize(),
            success: function(response) {
                console.log(response);
                var resp = $.parseJSON(response);
                if (resp.status == 202) {
                    $("#admin-register-form").trigger("reset");
                    //$(".message").html('<span class="text-success">'+resp.message+'</span>');
                    window.location.href = window.origin + "/abhi/admin/index.php";
                } else if (resp.status == 303) {
                    $(".message").html('<span class="text-danger">' + resp.message +
                        '</span>');
                }
            }
        });

    });

});
</script>