<?php
// $page_title = '';

include('../conn.php');

include('../function.php');

if(!isset($_SESSION['email_admin']))
{
  echo "<script>window.location.href='login_admin.php'</script>";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $page_title." | ".WEBSITE_NAME ?></title>
        <meta name="description" content="Pushy is an off-canvas navigation menu for your website.">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

        
        <!-- bar chart script -->
<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->

        <!-- External CSS -->
        <link rel="stylesheet" href="../css/style.css">

        <!-- Pushy CSS -->
        <link rel="stylesheet" href="../css/pushy.css">

        <!-- fontawesome -->
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </head>
    <body>

        <header class="site-header push ">
            <div class="d-md-flex justify-content-md-between">
                <?php include '../logo.php';?>
        
                    <div class="d-md-flex justify-content-md-start pt-2">
                        <div class="dropdown">
                            <a href="#" class="text-decoration-none mt-2 mx-3 dropdown-toggle" data-bs-toggle="dropdown" type="button"><?php echo $_SESSION ['email_admin']; ?></a>   
                            <ul class="dropdown-menu ">
                                <li><a href="profile.php" class="dropdown-item ">Profile</a></li>
                                <li><a href="change_password_admin.php" class="dropdown-item ">Change Password</a></li>
                                <li><a href="registration_admin.php" class="dropdown-item ">Sign-up</a></li>
                            </ul>
                        </div>
                        <a href="logout_admin.php" class="text-danger text-decoration-none mt-2 mx-2" >Logout</a>    
                    </div>
                </div>
            </header>

            <!-- Pushy Menu -->
            <nav class="pushy pushy-left" data-focus="#first-link">
                <div class="pushy-content">
                    <div class="pushy-profile">
                    <?php 
                    $email = $_SESSION['email_admin'];
                        $profile = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image,name FROM admin WHERE email = '$email'"));
                    ?>
                    <img src="../images/profile/<?php echo $profile['image']; ?>" alt="">   
                    <a href="profile.php"><?php echo $profile['name']; ?></a>
                    </div>
                    <ul>
                        <li class="pushy-link"><a href="index.php">Dashbord</a></li>
                        <li class="pushy-submenu">
                            <button id="first-link">Category</button>
                            <ul>
                                <li class="pushy-link"><a href="category.php">Category Manage</a></li>
                                <li class="pushy-link"><a href="category_manage.php">Add New Category</a></li>
                            </ul>
                        </li>
                        <li class="pushy-submenu">
                            <button id="first-link">Sub Category</button>
                            <ul>
                                <li class="pushy-link"><a href="sub_category.php">Sub Category Manage</a></li>
                                <li class="pushy-link"><a href="sub_category_manage.php">Add New Sub Category</a></li>
                            </ul>
                        </li>
                        <li class="pushy-submenu">
                            <button>Product</button>
                            <ul>
                                <li class="pushy-link"><a href="product.php">Product Manage</a></li>
                                <li class="pushy-link"><a href="product_manage.php">Add New Product</a></li>
                            </ul>
                        </li>
                        <li class="pushy-submenu">
                            <button>Orders</button>
                            <ul>
                                <li class="pushy-link"><a href="order_manage.php">Order Manage</a></li>
                            </ul>
                        </li>
                        
                        <li class="pushy-link"><a href="user_manage.php">Users Manage</a></li>
                        <li class="pushy-link"><a href="contact_us.php">Contact-us Manage</a></li>
                        <li class="pushy-link"><a href="registration_admin.php">Sign-up</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Site Overlay -->
        <div class="site-overlay"></div>
