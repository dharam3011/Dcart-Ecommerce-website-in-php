<?php

// Database Cannocation
  include 'conn.php';

// Function File
  include 'function.php';
  
  // categories for category dropdown
  $query_select_category = "SELECT * FROM category WHERE status = 1 ORDER BY category_name ASC";

  $query_select_category = mysqli_query($conn,$query_select_category);

  $meta_title = $page_title." | ".WEBSITE_NAME;
  $meta_keyword = WEBSITE_NAME;
  $meta_desc = WEBSITE_NAME;

  // current page path
  $script_name = $_SERVER['SCRIPT_NAME'];
  $script_name_arr = explode('/',$script_name);
  $my_page = $script_name_arr[count($script_name_arr)-1];

  if ($my_page == 'product.php') 
  { 
    $product_id = get_safe_value(urldecode(base64_decode($_GET['product_id']))/1122334455);
    $row_select_product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM product WHERE product_id = '$product_id'"));
    $meta_title = $row_select_product['meta_title'];
    $meta_desc = $row_select_product['meta_desc'];
    $meta_keyword = $row_select_product['meta_keyword'];
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title><?php echo $meta_title ?></title>
    <meta name="description" content="<?php echo $meta_desc ?>">
    <meta name="keywords" content="<?php echo $meta_keyword ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- font awesome -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <!-- External CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pushy.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

  </head>
  <body>

    
  <nav class=" navbar-expand-lg navbar-light bg-light container-fluid position-fixed " id="dh">
    <div class="d-md-flex justify-content-md-between">
      <div class="d-md-flex justify-content-md-start  ">
          <?php include 'logo.php' ?>
      
          <button class="navbar-toggler mx-3 me-2 my-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
    
          <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav mx-2">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" href="" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Category
                </a>
                <ul class="dropdown-menu">
                <?php 
                  while($cat_list = mysqli_fetch_assoc($query_select_category))
                  {
                    $category_id = $cat_list['category_id'];
                    
                    $category_name = $cat_list['category_name'];
                    
                    $href = "category.php?id=".urlencode(base64_encode($category_id*1122334455))."&catName=".urlencode(base64_encode($category_name));
                ?>
                  <li> <a class="dropdown-item" href="<?php echo $href ?>"> <?php echo $cat_list['category_name'] ?> &raquo; </a>
                    <ul class="submenu dropdown-menu">
                    <?php 
                      $query_select_sub_category = "SELECT * FROM sub_category WHERE status = 1 AND category_id = '$category_id'  ORDER BY sub_category_name ASC";

                      $query_select_sub_category = mysqli_query($conn,$query_select_sub_category);
                    
                      while($sub_cat_list = mysqli_fetch_assoc($query_select_sub_category))
                      {
                        $sub_category_id = $sub_cat_list['sub_category_id'];
                        
                        $sub_category_name = $sub_cat_list['sub_category_name'];
                        
                        $href2 = "sub_category.php?scid=".urlencode(base64_encode($sub_category_id*1122334455))."&sCatName=".urlencode(base64_encode($sub_category_name));
                    ?>
                        <li> <a class="dropdown-item" href="<?php echo $href2 ?>"> <?php echo $sub_cat_list['sub_category_name'] ?> </a></li>
                    <?php 
                      }
                    ?>
                    </ul>
                  </li>
                  <?php 
                    }
                  ?>
                </ul>
              </li>
              <li class="nav-item ">
                  <a class="nav-link active"  id="" role="button" aria-expanded="false" href="myorder.php">
                My-Orders
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link active"  id="" role="button" aria-expanded="false" href="registration.php">
                Sign-up
                </a>
              </li>
            </ul>
          </div>
      </div>
      <!-- Search box -->
      <div class="mt-1 col-md-4">
        <form>
              <input class="form-control col-md-12 me-2 my-2 " type="search" placeholder="Search Products, Brand, more.." aria-label="Search">
        </form>
      </div>
      <!-- User Cart sign-in/out -->
      <div class="d-md-flex justify-content-md-start  ">
    
          <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav mx-2">
            <!-- User name -->
            <?php
              if(isset($_SESSION['email_user']))
              {
            ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" href="" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $_SESSION ['email_user']; ?>
                </a>
                <ul class="dropdown-menu " aria-labelledby="navbarDarkDropdownMenuLink">
                  
                  <li><a class="dropdown-item" href="change_password.php">Change Password</a></li>
                  <li><a class="dropdown-item" href="registration.php">Sign-up</a></li>
                </ul>
              </li>
              <?php
                } 
              ?>
              <li class="nav-item cart">
                  <a class="nav-link active d-flex"  id="" role="button" aria-expanded="false" href="cart.php">
                  <i class='fas fa-fw fa-cart-arrow-down' style='font-size:24px'></i>
                  <span class="cart-qty" >
                  <?php
                    $t_item = 0 ;
                    if (isset($_SESSION['cart'])) 
                    {
                      foreach($_SESSION['cart'] as $key => $value)
                      {
                        $t_item =  $value['quantity'] + $t_item ; 
                      }
                    }
                    if (isset($_SESSION['email_user'])) 
                    {
                      $result = mysqli_query($conn, "SELECT * FROM cart  ");
                    
                      //  $t_item =  $row['quantity']  ; 
                      while($row = mysqli_fetch_assoc($result))
                      {
                        $t_item =  $row['quantity'] + $t_item  ; 
                      }
                    }
                    
                    echo $t_item;
                  ?>
                  </span>
                </a>
              </li>
              <li class="nav-item ">
              <?php 
                if(!isset($_SESSION['email_user']))
                {
              ?>
                <a class="nav-link text-success active"  id="" role="button" aria-expanded="false" href="login.php">
                  Sign-in
                </a>
                <?php
                }
                else
                {
              ?>
                <a class="nav-link text-danger active"  id="" role="button" aria-expanded="false" href="logout.php">
                  Logout
                </a>
              <?php
                }
              ?>
              </li>
            </ul>
          </div>
      </div>
    </div>
  </div>
</nav>

