<?php

// page title
$page_title = 'Address Select';

// header file
include 'conn.php';

// function file
include 'function.php';

if(!isset($_SESSION['email_user']))
{
    redirect('login.php');
}

// If cart is empty, redirect to index page
$query_select = "SELECT * FROM cart";

$result_select = mysqli_query($conn,$query_select);
            
$value = mysqli_fetch_assoc($result_select);

if (!isset($_SESSION['cart']) && !isset($value['cart_id'])) 
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

    <!-- External CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pushy.css">

    <!-- font awsome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <title><?php echo $page_title.' | '.WEBSITE_NAME ; ?></title>
  </head>
  
  <body class="bg-light">

    <div class="container">
        <div class="text-center">
                <?php include 'logo.php';?>
            </div>
        <div class="pb-5 text-center">    
            <h2>Checkout Item</h2>
        </div>

        <div class="row">
            <div class="col-md-5 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                </h4>
                <ul class="list-group mb-3">
                <?php 
                    
                    // define the null variable
                    $address_id = '';
                    $fname = '';
                    $lname = '';
                    $address_1 = '';
                    $address_2 = '';
                    $mobile = '';
                    $email = '';
                    $city = '';
                    $state = '';
                    $country = '';
                    $pin = '';
                    $addressId = '';
                    $type = '';

                    // Get address Id and type from url
                    if (isset($_GET['addressId']) && $_GET['addressId'] != '' && isset($_GET['type']) && $_GET['type'] != '') 
                    {
                            
                        $addressId = urldecode(base64_decode($_GET['addressId']));

                        $type = urldecode(base64_decode($_GET['type']));

                        // delete address 
                        if ($type == 'delete') 
                        {
                            $query_delete = "DELETE FROM address WHERE address_id = '$addressId' ";

                            $result_delete = mysqli_query($conn,$query_delete);
                        }
                        
                        // edit address
                        if($type == 'edit')
                        {
                            // call the function after that retrieve address from database
                            $addressarray = get_address($type,$addressId);

                            // for Edit address
                            foreach ($addressarray as $key => $row_add) 
                            {   
                                $address_id = $row_add['address_id'];
                                $fname = $row_add['fname'];
                                $lname = $row_add['lname'];
                                $address_1 = $row_add['address_1'];
                                $address_2 = $row_add['address_2'];
                                $mobile = $row_add['mobile'];
                                $email = $row_add['email'];
                                $city = $row_add['city'];
                                $state = $row_add['state'];
                                $country = $row_add['country'];
                                $pin = $row_add['pin'];
                                
                            }
                        }
                    }

                    $t_item = 0;
                    $t_price = 0;
            
                    if (isset($_SESSION['email_user']) && !isset($_SESSION['cart'])) 
                    {
                        $query_select = "SELECT cart.quantity,product.* FROM cart INNER JOIN product ON cart.product_id=product.product_id ORDER BY cart_id DESC";

                        $result_select = mysqli_query($conn,$query_select);

                        while ($value = mysqli_fetch_assoc($result_select)) 
                        {
                            // count total item and price
                        $t_item =  $value['quantity'] + $t_item ; 
                        $t_price =  ($value['product_price']*$value['quantity']) + $t_price ; 
                    ?>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <input type="hidden" name="product_id" id="<?php echo $value['product_id'] ?>pid" value="<?php echo $value['product_id'] ?>" >
                            <input type="hidden" name="product_id" value="<?php echo $value['product_name'] ?>" >
                            <input type="hidden" name="product_id" value="<?php echo $value['quantity'] ?>" >
                            
                            <div class="row">
                                <div class="col-lg-3">
                                    <img src="images/<?php echo $value['product_image']; ?>" class="col-sm-3" style="width:100px; height:100px">
                                </div>
                                <div class="col-lg-9">
                                    <h6 class="mt-1 "><?php echo $value['product_name']; ?></h6>
                                    
                                    <h6 class="m-1 p-1 float-start">Price : <?php echo $value['product_price']; ?> ₹ | </h6>  
                                    <h6 class="m-1 p-1 float-start">Qty : <?php echo $value['quantity'];?> | </h6>  
                                    <h6><button class="btn text-danger " onclick="remove(<?php echo $value['product_id'] ?>)">Remove</button></h6> 
                                </div>
                            </div>
                        </div>        
                    <?php
                        }
                    }
                    if (isset($_SESSION['cart'])) 
                    {
                        $t_item = 0;
                        $t_price = 0;

                        foreach($_SESSION['cart'] as $key => $value)
                        {
                            $t_item =  $value['quantity'] + $t_item ; 
                            $t_price =  ($value['product_price']*$value['quantity']) + $t_price ; 
                    ?>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <input type="hidden" name="product_id" id="<?php echo $value['product_id'] ?>pid" value="<?php echo $value['product_id'] ?>" >
                            <input type="hidden" name="product_id" value="<?php echo $value['product_name'] ?>" >
                            <input type="hidden" name="product_id" value="<?php echo $value['quantity'] ?>" >
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="images/<?php echo $value['product_image']; ?>" class="col-sm-3" style="width:100px; height:100px">
                                </div>
                                <div class="col-md-9">
                                    <h6 class="mt-1 "><?php echo $value['product_name']; ?></h6>
                                    
                                    <h6 class="m-1 p-1 float-start">Price : <?php echo $value['product_price']; ?> ₹ | </h6>  
                                    <h6 class="m-1 p-1 float-start">Qty : <?php echo $value['quantity'];?> | </h6>  
                                    <h6><button class="btn text-danger " onclick="remove(<?php echo $value['product_id'] ?>)">Remove</button></h6> 
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                        }
                    }
                ?>
                    
                    <!-- promo code -->
                    <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-success">
                        <h6 class="my-0">Promo code</h6>
                        <small>EXAMPLECODE</small>
                    </div>
                    <span class="text-success">-$5</span>
                    </li>
                    <!-- total item -->
                    <li class="list-group-item d-flex justify-content-between">
                    <span>Total Item</span>
                    <strong><?php echo $t_item; ?></strong>
                    </li>
                    <!-- total price -->
                    <li class="list-group-item d-flex justify-content-between">
                    <span>Total Price</span>
                    <strong><?php echo $t_price; ?> ₹</strong>
                    </li>
                </ul>
                <!-- promo code -->
                <form class="card p-2">
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="Promo code">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">Redeem</button>
                    </div>
                    </div>
                </form>
            </div>
            <!-- Billing Address -->
            <div class="col-md-7 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <div class="address_msg">
                </div>
                <hr class="mb-4">
            <!-- Before used address -->
                <h4 class="mb-3">Before used address</h4>
                <div class="row">
                
                        <?php 
                            // call the function after that retrieve address from database
                            $addressarray = get_address();
                            
                            foreach ($addressarray as $key => $row_add) 
                            {
                        
                        ?>
                        
                        <div class="card m-3 " style="max-width: 16rem;">
                            <div class="card-body">
                                <div class="body_up " style="min-height: 17rem; ">
                                <input type="hidden" id="<?php echo $row_add['address_id'] ?>selectAddress" value="<?php echo $row_add['address_id'] ?>">
                                <h5 class="card-title mb-2"><?php echo $row_add['fname'].' '.$row_add['lname']; ?></h5>
                                <p class="card-text"><?php echo $row_add['address_1']; ?></p>
                                <?php 
                                    if ($row_add['address_2']) {
                                    ?>
                                        <p class="card-text"><?php echo $row_add['address_2']; ?></p>
                                    <?php
                                    } 
                                ?>
                                <p class="card-text"><?php echo $row_add['city'].', '.$row_add['pin']; ?></p>
                                <p class="card-text"><?php echo $row_add['state'].', '.$row_add['country']; ?></p>
                                <p class="card-text">Mobile : <?php echo $row_add['mobile']; ?></p>
                                <p class="card-text pb-1">Email : <?php echo $row_add['email']; ?></p>
                                </div>
                                <div class="body_down">
                                <div class="text-center">
                                    <?php
                                    // encode url date send by link
                                        $hrefedit = '?type='.urlencode(base64_encode('edit')).'&addressId='.urlencode(base64_encode($row_add['address_id'])) ;
                                        $hrefdelete = '?type='.urlencode(base64_encode('delete')).'&addressId='.urlencode(base64_encode($row_add['address_id'])) ;
                                    ?>
                                    <a href="<?php echo $hrefedit; ?>" class="btn btn-sm col-5 mb-1 btn-secondary " style="margin-left:0px;">Edit</a>
                                    <a href="<?php echo $hrefdelete; ?>" class="btn btn-sm col-5 mb-1 btn-secondary">Delete</a>
                                </div>
                                <button type="submit" class="btn col-12 btn-primary" onclick="selectAddress(<?php echo $row_add['address_id'] ?>)" >Deliver to this Address</button>
                                </div>
                            </div>
                        </div>   
                        <?php
                            }
                        ?>
                    </div>
                    <hr class="mb-4">
            <!-- Add New Addess -->
                <div class="headding_new_add"><h4 >Add a New Address</h4></div>
                <div class="headding_edit_add"><h4 >Edit Address</h4></div>
                <span class="new_add_btn">if you are add new address, click on botton</span><button class="btn btn-secondary new_add_btn" >Add New Delivery Address</button>
                <div class="new_address">
                    <!-- <form class="needs-validation"  method="POST"> -->
                        <div class="row">
                            <input type="hidden" name="address_id" id="Address_id" value="<?php echo $address_id ?>">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">First name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="fname" id="firstName" placeholder="" value="<?php echo $fname ?>" required>
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Last name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="lname" id="lastName" placeholder="" value="<?php echo $lname ?>" required>
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="mobile">Mobile<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $mobile ?>" placeholder="" required>
                            <div class="invalid-feedback">
                                Please enter a Mobile Number for shipping updates.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $email ?>" placeholder="" required>
                            <div class="invalid-feedback">
                                Please enter a Email for shipping updates.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address">Address<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="address1" id="address1" placeholder="1234 Main St" value="<?php echo $address_1 ?>" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                            <input type="text" class="form-control" name="address2" id="address2" value="<?php echo $address_2 ?>" placeholder="Apartment or suite">
                        </div>

                        <div class="mb-3">
                            <label for="city">City<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="city" id="city" value="<?php echo $city ?>" placeholder="" required>
                            <div class="invalid-feedback">
                                Please enter a city for shipping updates.
                            </div>
                        </div>

                        <div class="row">
                            <?php 
                                $countryArr = ['India','United State','United kindom','Canada'];

                                sort($countryArr);

                            ?>
                            <div class="col-md-5 mb-3">
                                <label for="country">Country<span class="text-danger">*</span></label>
                                <select class="custom-select d-block w-100 form-select" name="country" id="country" required>
                                <option value="<?php echo $country ?>"><?php echo $country ?></option>
                                <?php 
                                    foreach ($countryArr as  $country) 
                                    {
                                        ?>
                                            <option><?php echo $country; ?></option>        
                                        <?php
                                    }
                                ?>
                                
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid country.
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="state">State<span class="text-danger">*</span></label>
                                <input class="custom-select d-block w-100 form-control" name="state" id="state" value="<?php echo $state ?>" required>
                                
                                <div class="invalid-feedback">
                                    Please provide a valid state.
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="zip">PIN Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="pin" id="pin" value="<?php echo $pin ?>" placeholder="" required>
                                <div class="invalid-feedback">
                                    Pin code required.
                                </div>
                            </div>
                            <!-- Error message -->
                            <div class="name_error mb-3 text-danger"></div>
                            <!-- Add New Address button -->
                            <div class="col-md-3 mb-3">
                            <?php
                              
                              
                              if ($type == 'edit') {
                                $btn = 'Update Address';  
                              }else{
                                $btn = 'Add New Address';
                              }
                            ?>
                            
                                <button class="btn btn-primary" onclick="add_address()" ><?php echo $btn ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
                <hr class="mb-4">
                <div class="Checkout_btn">
                    <a href="payment.php" class="btn btn-primary btn-lg mb-4 ">Continue to Checkout</a>
                </div>
            <!-- </form> -->
    </div>

<script>
    // Add New Address button to hide or unhide div
    $(document).ready(function(){
        var unhide = $(".new_add_btn");
        var editUnhide = $("#Address_id").val();
            
        $(".headding_new_add").show();
        $(".headding_edit_add").hide();
        $(".new_address").hide();
            
        if (unhide) 
        {
            $(unhide).click(function()
            {  
                $(".headding_new_add").show();
                $(".headding_edit_add").hide();
                $(".new_address").show();
                $(".new_add_btn").hide();
            })    
        }
        
        if (editUnhide != '') {
            $(".headding_edit_add").show();
            $(".headding_new_add").hide();
            $(".new_address").show();
            $(".new_add_btn").hide();

            $('html, body').animate({
                scrollTop: $(".new_address").offset().top-100
                }, 100);
        }
    });

    // Select the deliver to this Address
    function selectAddress(addId) {
        var address_id = addId;

        $.ajax({
            url: 'manage_checkout.php',
            type: 'post',
            data: {
                address_id: address_id,
            },
            success: function(status) {
                
            }
        });

        $('html, body').animate({
                scrollTop: $(".Checkout_btn").offset().top-100
                }, 100);
        
    }

</script>

    <!-- jQuery and ajax script -->
    <script src="js/add.js"></script>

<?php include 'footer.php ' ?>    
  </body>
</html>
