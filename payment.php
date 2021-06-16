<?php

// page title
$page_title = 'Checkout';

// header file
include 'conn.php';

// function file
include 'function.php';

// payment getway file
require 'payment/razorpay-php/Razorpay.php';

// use payment getway api
use Razorpay\Api\Api;

// page authintication
if(!isset($_SESSION['email_user']))
{
    redirect('login.php');    
}

$query_select = "SELECT * FROM cart";

$result_select = mysqli_query($conn,$query_select);
            
$value = mysqli_fetch_assoc($result_select);

// check cart is not empty 
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

    <!-- font-awsome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- payment Getway -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <title><?php echo $page_title.' | '.WEBSITE_NAME ; ?></title>
  </head>
  
  <body class="bg-light">

    <div class="container " style="min-height:580px;">
        <div class="text-center">
            <?php include 'logo.php';?>
        </div>
        <div class="pb-5 text-center">    
            <h2>Checkout Item</h2>
        </div>
        
        <div class="row">
            
            <div class="col-md-8 order-md-2 mb-4">
     
                <h4 class="mb-3">Select Payment Method</h4>
                <form method="POST">
                <div class="d-block my-3">
                <div class="custom-control custom-radio">
                    <input id="card_method" name="paymentMethod" type="radio" value="paymentGetway" class="custom-control-input "  >
                    <label class="custom-control-label" for="credit">Credit/Debit card/Netbanking</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="cod_method" name="paymentMethod" type="radio"  class="custom-control-input "  value="COD"  checked>
                    <label class="custom-control-label" for="paypal">COD <small class="text-secondary">(Case On Delivery)</small></label>
                </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                        <!-- show address -->
                            <?php 
                                $user_id = $_SESSION['user_id'];

                                if (isset($_SESSION['address_id'])) 
                                {
                                    $address_id = $_SESSION['address_id'];
                                }
                                
                                $query_select_add = "SELECT * FROM address WHERE address_id = '$address_id' AND user_id = '$user_id' ";
                              
                                $result_select_add = mysqli_query($conn , $query_select_add);

                                $row_add = mysqli_fetch_assoc($result_select_add);
                            ?>
                            <div class="col-md-5 ">
                                <h5 class="card-title">Shpping address <small><a href="checkout.php" class="text-decoration-none">(change)</a></small></h5>
                                <input type="hidden" id="selectAddress" value="<?php echo $row_add['address_id'] ?>">
                                <p class="card-title mb-2"><?php echo $row_add['fname'].' '.$row_add['lname']; ?><input type="hidden" name="name" id="name" value="<?php echo $row_add['fname'].' '.$row_add['lname']; ?>"></p>
                                <p class="card-text"><?php echo $row_add['address_1']; ?><input type="hidden" name="address1" id="address1" value="<?php echo $row_add['address_1']; ?>"></p>
                                <p class="card-text"><?php echo $row_add['address_2']; ?></p>
                                <p class="card-text"><?php echo $row_add['city'].', '.$row_add['pin']; ?><input type="hidden" name="city_pin" id="city_pin" value="<?php echo $row_add['city'].', '.$row_add['pin']; ?>"></p>
                                <p class="card-text"><?php echo $row_add['state'].', '.$row_add['country']; ?><input type="hidden" name="state_country" id="state_country" value="<?php echo $row_add['state'].', '.$row_add['country']; ?>"></p>
                                <p class="card-text">Mobile : <?php echo $row_add['mobile']; ?><input type="hidden" name="mobile" id="mobile" value="<?php echo $row_add['mobile']; ?>"></p>      
                                <p class="card-text">Email : <?php echo $row_add['email']; ?><input type="hidden" name="email" id="email" value="<?php echo $row_add['email']; ?>"></p>      
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Item</h5>
                        <?php 

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
                                    <input type="hidden" name="product_name" value="<?php echo $value['product_name'] ?>" >
                                    <input type="hidden" name="quantity" value="<?php echo $value['quantity'] ?>" >
                                    
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <img src="images/<?php echo $value['product_image']; ?>" class="col-sm-3" style="width:100px; height:100px">
                                        </div>
                                        <div class="col-lg-9">
                                            <h6 class="mt-1 "><?php echo $value['product_name']; ?></h6>
                                            
                                            <h6 class="m-1 p-1 float-start">Price : <?php echo $value['product_price']; ?> ₹ | </h6>  
                                            <h6 class="m-1 p-1 float-start">Qty : <?php echo $value['quantity'];?>  </h6>  
                                            
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
                                    <input type="hidden" name="product_name" value="<?php echo $value['product_name'] ?>" >
                                    <input type="hidden" name="quantity" value="<?php echo $value['quantity'] ?>" >
                                    
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="images/<?php echo $value['product_image']; ?>" class="col-sm-3" style="width:100px; height:100px">
                                        </div>
                                        <div class="col-md-9">
                                            <h6 class="mt-1 "><?php echo $value['product_name']; ?></h6>
                                            
                                            <h6 class="m-1 p-1 float-start">Price : <?php echo $value['product_price']; ?> ₹ | </h6>  
                                            <h6 class="m-1 p-1 float-start">Qty : <?php echo $value['quantity'];?>  </h6>  
                                            
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php
                                }
                            }
                        ?>
                        
                    </div>
                    </div>
                </form>
            </div>
            <!-- Side bar -->
            <div class="col-md-4 order-md-2 mb-4">
                <div class="card" >
                    <div class="card-body">
                        <button class="btn btn-primary btn-md btn-block mb-3 col-md-12" id="place_order" onclick="placeOrder()" name="checkout" type="submit">Place Your Order and Pay</button>
                        
                        <h5 class="card-title">Order Summary</h5>
                        <div class="item d-flex justify-content-between mb-1">
                                <span>Total Item</span>
                                <strong><?php echo $t_item; ?><input type="hidden" name="t_item" id="t_item" value="<?php echo $t_item; ?>"></strong>
                        </div>
                        <div class="item d-flex justify-content-between mb-1">
                                <span>Total Price </span>
                                <strong><?php echo $t_price; ?> ₹</strong>
                                <input type="hidden" name="t_price" id="t_price" value="<?php echo $t_price; ?>">
                        </div>
                        <div class="item d-flex justify-content-between mb-1">
                                <span>Delivery Charge </span>
                                <strong><?php echo $delivery_chargr = 50; ?> ₹</strong>
                                <input type="hidden" name="delivery_charge" id="delivery_charge" value="<?php echo $delivery_chargr; ?>">
                        </div>
                        <hr>
                        <?php 
                            $order_total_price = $t_price + $delivery_chargr;
                            
                        ?>
                        <div class="item d-flex justify-content-between mb-1">
                                <h5>Order Total price </h5>
                                <h5><?php echo $order_total_price;?> ₹</h5>
                                <input type="hidden" name="order_total_price" id="order_total_price" value="<?php echo $order_total_price; ?>">
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
    
    <!-- create razorpay payment getway order id -->
    <?php 
        $api = new Api('your Key_id', 'your Secrate Key');
            $order  = $api->order->create([
                'receipt'         => 'order_rcptid_11',
                'amount'          => $order_total_price*100, // amount in the smallest currency unit
                'currency'        => 'INR',// <a href="/docs/payment-gateway/payments/international-payments/#supported-currencies"  target="_blank">See the list of supported currencies</a>.)
            ]);
        
        // convert object to variable
        $razorpay_order_id = $order->{'id'};
        echo '<input type="hidden" name="razorpay_order_id" id="razorpay_order_id" value="'.$razorpay_order_id.'">';

        // get order id from database
        $result_get_order_id = mysqli_query($conn,"SELECT * FROM `order` ORDER BY order_id DESC LIMIT 1");

        $row_get_order_id = mysqli_fetch_assoc($result_get_order_id);

        $shipping_order_id = $row_get_order_id['order_id'];

        if ($shipping_order_id == '') 
        {
            $shipping_order_id = '1111111';
        }
        else
        {
            $shipping_order_id = ($shipping_order_id + 1);
        }
        echo '<input type="hidden" name="shipping_order_id" id="shipping_order_id" value="'.$shipping_order_id.'">';
    ?>

<script>
    function placeOrder() {

        var payment_type = $("input[name='paymentMethod']:checked").val();

        // for payment getway
        var address_id = $("#selectAddress").val();
        var name = $("#name").val();
        var Address = $("#address1").val() +', '+ $("#city_pin").val() +', '+ $("#state_country").val();
        var mobile = $("#mobile").val();
        var email = $("#email").val();
        var razorpay_order_id = $("#razorpay_order_id").val();
        var shipping_order_id = $("#shipping_order_id").val();
        
        //  user order totals
        var t_item = $("#t_item").val();
        var t_price = $("#t_price").val();
        var delivery_charge = $("#delivery_charge").val();
        var grad_total_price = $("#order_total_price").val();

        $.ajax({
            url: 'place_order.php',
            type: 'post',
            data: {
                payment_type : payment_type,
                address_id : address_id,
                t_item : t_item,
                t_price : t_price,
                delivery_charge : delivery_charge,
                grad_total_price : grad_total_price,
            },
            success: function(data, status) {
                if (payment_type == 'COD') {
                    window.location.href='thankyou.php';
                }
            }
        });

        if (payment_type == 'paymentGetway') 
        {
            var options = {
                "key": "Your Key_id", 
                "amount": grad_total_price*100, 
                "currency": "INR",
                "name": "Dcart.com",
                "description": "Online Shopping Transaction",
                "order_id": razorpay_order_id, 
                "handler": function (response){
                        payment_id = response.razorpay_payment_id;
            
                        $.ajax({
                            url : 'place_order.php',
                            type : 'post',
                            data : {
                                payment_id : payment_id,
                                payment_status : 'Success',
                            },
                            success : function(data, status){
                                window.location.href='thankyou.php';
                            }
                        });
                },
                "prefill": {
                    "name": name,
                    "email": email,
                    "contact": mobile 
                },
                "notes": {
                    "address": Address ,
                    "shipping_order_id" : shipping_order_id,
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function (response){
                    
                payment_id = response.error.metadata.payment_id;
                
                $.ajax({
                    url : 'place_order.php',
                    type : 'post',
                    data : {
                        payment_id : payment_id,
                        payment_status : 'Failed',
                    },
                    success : function(data, status){
                        
                    }
                });
            });
            rzp1.open();
        }
    }
</script>
    <!-- jQuery and ajax script -->
    <!-- <script src="js/add.js"></script> -->
    
    <?php include 'footer.php';?>
    