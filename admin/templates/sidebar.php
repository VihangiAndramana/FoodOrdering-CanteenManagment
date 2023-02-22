<nav class="col-md-2 d-none d-md-block bg-warning sidebar">
    <div class="head">
        <h4><img src="icon.png" style="width:25%; height:75%;" alt="">KDUSC Canteen</h4>
    </div>
    <div class="sidebar-sticky">
        <ul class="nav flex-column">

            <?php 
            $uri = $_SERVER['REQUEST_URI']; 
            $uriAr = explode("/", $uri);
            $page = end($uriAr);
            ?>


            <li class="nav-item">
                <a class="nav-link <?php echo ($page == '' || $page == 'index.php') ? 'active' : ''; ?>"
                    href="index.php">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($page == 'products1.php') ? 'active' : ''; ?>" href="products1.php">
                    <span data-feather="shopping-cart"></span>
                    Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($page == 'qty.php') ? 'active' : ''; ?>" href="qty.php">
                    <span data-feather="dollar-sign"></span>
                    Product Quantity
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($page == 'orders.php') ? 'active' : ''; ?>" href="orders.php">
                    <span data-feather="file"></span>
                    Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($page == 'availability.php') ? 'active' : ''; ?>"
                    href="availability.php">
                    <span data-feather="file-text"></span>
                    Availability
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($page == 'categories.php') ? 'active' : ''; ?>" href="categories.php">
                    <span data-feather="file-text"></span>
                    Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($page == 'users.php') ? 'active' : ''; ?>" href="users.php">
                    <span data-feather="users"></span>
                    All Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($page == 'customer1.php') ? 'active' : ''; ?>" href="customer1.php">
                    <span data-feather="users"></span>
                    Customers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($page == 'admin.php') ? 'active' : ''; ?>" href="admin.php">
                    <span data-feather="user"></span>
                    Admin Details
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($page == 'packages.php') ? 'active' : ''; ?>" href="packages.php">
                    <span data-feather="dollar-sign"></span>
                    User Packages
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($page == 'ucredits.php') ? 'active' : ''; ?>" href="ucredits.php">
                    <span data-feather="dollar-sign"></span>
                    User Credits
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($page == 'sales.php') ? 'active' : ''; ?>" href="sales.php">
                    <span data-feather="dollar-sign"></span>
                    Sales Details
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($page == 'feedback.php') ? 'active' : ''; ?>" href="feedback.php">
                    <span data-feather="dollar-sign"></span>
                    Feedback
                </a>
            </li>

        </ul>
    </div>
</nav>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 ">