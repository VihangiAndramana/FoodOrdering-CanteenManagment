<!-- Page Pre Load Section-->

<!-- <div id="preload">
     <div class="load">
     </div>
 </div> -->

<!-- Header Section-->

<header class="header-section">
	<!-- Top Bar -->
	<div class="header-top" id="top">
		<div class="container">
			<div class="f-right">
				<ul class="nav-right">
					<li class="user-icon">
						<div class="login-panel">
							<i class="fa fa-user-circle" style="font-size:40px"></i>
						</div>
						<div class="login-hover">
							<div class="insidelog">
								<?php if (!isset($_SESSION['admin_id'])) {
									echo "<a href='login.php' class='btn logbtn' style='width: 200px; height:40px'>Login</a>";
								} else {
									echo "<a href='../admin/admin-logout.php' class='btn logbtn' style='width: 200px; height:40px'>Log Out</a>";
								} ?>
							</div>
							<?php if (!isset($_SESSION['admin_id']))  {
								echo "<div class='insidelog'>
                                    <span class='small'>or </span><a href='register.php' class='small'>Sign up Now</a>
                                </div>";
							} ?>
							<?php if (isset($_SESSION['admin_id']))  {
								echo "
                                <div class='insidelog' style='border-top: solid 0.2px #e5e5e5;'>
                                    <a href='account.php?orders' class='btn btn-dark' style='color:white;margin:4px 0'>My Account</a>
                                </div>";
							}
							?>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- Middle Bar -->

	<!-- <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Khan Store</a>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
    	<?php
		if (isset($_SESSION['admin_id'])) {
		?>
    				<a class="nav-link" href="../admin/admin-logout.php">Sign out</a>
    			<?php
			} else {
				$uriAr = explode("/", $_SERVER['REQUEST_URI']);
				$page = end($uriAr);
				if ($page === "login.php") {
				?>
	    				<a class="nav-link" href="../admin/register.php">Register</a>
	    			<?php
				} else {
					?>
	    				<a class="nav-link" href="../admin/login.php">Login</a>
	    			<?php
				}
			}

					?>
      
    </li>
  </ul>
</nav> -->