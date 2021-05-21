<?php

// page title
$page_title = 'Thank you';

// header file
include 'conn.php';

// function file
include 'function.php';

if(!isset($_SESSION['email_user']))
{
    redirect('login.php');
}

$query_select = "SELECT * FROM cart";

$result_select = mysqli_query($conn,$query_select);
            
$value = mysqli_fetch_assoc($result_select);

if (isset($_SESSION['cart']) && isset($value['cart_id'])) 
{
    redirect('index.php');
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <title><?php echo $page_title.' | '.WEBSITE_NAME ; ?></title>
  </head>
  
  <body class="bg-light">

  <div class="container d-flex justify-content-center align-items-center" style="height: 580px;" >
      <div>
      <h3 class="mx-5"><span class="text-success">Successfully</span> place your order</h3>
      <h1 >Thank You for shopping!<i class="far fa-fw fa-smile" aria-hidden="true"></i></h1>
        <h5 class="d-flex justify-content-center"><a href="index.php">Continue shopping</a></h5>
      </div>
        <?php 
          echo "<script>setTimeout(function(){ window.location.href='index.php'; }, 3000);</script>";
        ?>
  </div>
  <?php include 'footer.php' ?>