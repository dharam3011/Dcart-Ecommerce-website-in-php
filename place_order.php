<?php

    // page title
    $page_title = 'Place Order';

    // header file
    include 'conn.php';

    // function file
    include 'function.php';

    if(!isset($_SESSION['email_user']))
    {
        redirect('login.php');
    }
    
    require 'payment/razorpay-php/Razorpay.php';
    use Razorpay\Api\Api;

    // get order id from database
    $result_get_order_id = mysqli_query($conn,"SELECT * FROM `order` ORDER BY order_id DESC LIMIT 1");

    $row_get_order_id = mysqli_fetch_assoc($result_get_order_id);

    $order_id = $row_get_order_id['order_id'];

    if ($order_id == '') 
    {
        $order_id = '1111111';
    }
    else
    {
        $order_id = ($order_id + 1);
    }
    
    // insert order into database
    if(isset($_POST['payment_type']))
    {
        $payment_type = get_safe_value($_POST['payment_type']);
        $address_id = get_safe_value($_POST['address_id']);
        $total_item = get_safe_value($_POST['t_item']);
        $total_price = get_safe_value($_POST['t_price']);
        $delivery_charge = get_safe_value($_POST['delivery_charge']);
        $grad_total_price = get_safe_value($_POST['grad_total_price']);
        $user_id = $_SESSION['user_id'];

        if ($payment_type == 'paymentGetway') 
        {
            $quary_insert_order = "INSERT  INTO `order` (order_id,grand_total,total_item,total_price,delivery_charge,user_id,address_id,payment_type,payment_status,order_status) VALUES ('$order_id','$grad_total_price','$total_item','$total_price','$delivery_charge','$user_id','$address_id','$payment_type','pending','1')";

            $result_insert_order = mysqli_query($conn,$quary_insert_order);

            // order details : retrieve from cart and insert into order detail
            $_SESSION['order_id'] = mysqli_insert_id($conn);

            // database cart value
            if (isset($_SESSION['email_user']) && !isset($_SESSION['cart'])) 
            {

                $query_select = "SELECT cart.*,product.* FROM cart INNER JOIN product ON cart.product_id=product.product_id ORDER BY cart_id DESC";

                $result_select = mysqli_query($conn,$query_select);

                while ($value = mysqli_fetch_assoc($result_select)) 
                {
                    $product_id = $value['product_id'];
                    $qty = $value['quantity'];

                    // insert data
                    $query_insert_order_details = "INSERT INTO order_detail (order_id,product_id,qty) VALUES ('$order_id','$product_id','$qty')";

                    $result_insert_order_details = mysqli_query($conn,$query_insert_order_details);
                }
            }
        }

        if ($payment_type == 'COD') 
        {
            
            $quary_insert_order = "INSERT  INTO `order` (order_id,grand_total,total_item,total_price,delivery_charge,user_id,address_id,payment_type,payment_status,order_status) 
                                        VALUES ('$order_id','$grad_total_price','$total_item','$total_price','$delivery_charge','$user_id','$address_id','$payment_type','pending','1')";

            $result_insert_order = mysqli_query($conn,$quary_insert_order);

            // order details : retrieve from cart and insert into order detail
            $order_id = mysqli_insert_id($conn);

            // database cart value
            if (isset($_SESSION['email_user']) && !isset($_SESSION['cart'])) 
            {

                $query_select = "SELECT cart.*,product.* FROM cart INNER JOIN product ON cart.product_id=product.product_id ORDER BY cart_id DESC";

                $result_select = mysqli_query($conn,$query_select);

                while ($value = mysqli_fetch_assoc($result_select)) 
                {
                    $product_id = $value['product_id'];
                    $qty = $value['quantity'];

                    // insert data
                    $query_insert_order_details = "INSERT INTO order_detail (order_id,product_id,qty) VALUES ('$order_id','$product_id','$qty')";

                    $result_insert_order_details = mysqli_query($conn,$query_insert_order_details);

                    $cart_id = $value['cart_id'];
                
                    // delete cart item after place order
                    $query_delete_cart = "DELETE FROM cart WHERE cart_id = '$cart_id' ";

                    $result_delete_cart = mysqli_query($conn,$query_delete_cart);
                }
                
                unset($_SESSION['address_id']);
                echo 'success';
            }
        }
        
        // session cart value 
        if (isset($_SESSION['cart'])) 
        {
            foreach($_SESSION['cart'] as $key => $value)
            {
                $query_insert_order_details = "INSERT INTO order_detail (order_id,product_id,qty) VALUES ('$order_id','$product_id','$qty')";

                $result_insert_order_details = mysqli_query($conn,$query_insert_order_details);
            }

            unset($_SESSION['cart']);
            unset($_SESSION['address_id']);
        }
    }

    // update payment satus
    if (isset($_POST['payment_id'])) 
    {
        $payment_id = get_safe_value($_POST['payment_id']);

        $api = new Api('rzp_test_J5REH0O897SkxA', 'NQ2tbGXlPBbj3NB8AcXhlPX9');

        // fetch data from payment getway from api
        $payment = $api->payment->fetch($payment_id);
        
        $payment_method = $payment->{'method'};
        
        if ($payment_method == 'netbanking') 
        {
            $card_bank_upi_wallet = $payment->{'bank'};
        }
        if ($payment_method == 'card') 
        {
            $card_bank_upi_wallet = $payment->{'card_id'};
        }
        if ($payment_method == 'wallet') 
        {
            $card_bank_upi_wallet = $payment->{'wallet'};
        }
        if ($card_bank_upi_wallet == 'upi') 
        {
            $rzp_vpa = $payment->{'vpa'};//upi id (upi payment) 
        }
        
        $payment_status = get_safe_value($_POST['payment_status']);

        $date = date_default_timezone_set('Asia/Kolkata');

        $today = date("Y-m-d G:i:s");
        
        $result_update_payment_status = mysqli_query($conn,"UPDATE `order` SET payment_type = '$payment_method',card_bank_upi_wallet='$card_bank_upi_wallet',payment_id = '$payment_id', payment_status = '$payment_status', payment_date = '$today' WHERE order_id = '".$_SESSION['order_id']."' ");    
        
        if ($payment_status == 'Success') 
        {
            // palce order and payment successfull after that delete items into cart
            if (isset($_SESSION['email_user']) && !isset($_SESSION['cart'])) 
            {
                $query_select = "SELECT cart.*,product.* FROM cart INNER JOIN product ON cart.product_id=product.product_id ORDER BY cart_id DESC";

                $result_select = mysqli_query($conn,$query_select);

                while ($value = mysqli_fetch_assoc($result_select)) 
                {
                    $cart_id = $value['cart_id'];
                
                    // delete cart item after place order
                    $query_delete_cart = "DELETE FROM cart WHERE cart_id = '$cart_id' ";

                    $result_delete_cart = mysqli_query($conn,$query_delete_cart);
               }
                
                unset($_SESSION['address_id']);    
            }
        }
    }

    // update order status by admin
    if(isset($_POST['order_status_id']))
    {
        $order_id = $_POST['order_id'];
        $order_status_id = $_POST['order_status_id'];
       
        $query_update_order_status  = "UPDATE `order` SET order_status = '$order_status_id' WHERE order_id = '$order_id' ";

        $result_update_order_status= mysqli_query($conn,$query_update_order_status);

        if($result_update_order_status)
        {
            echo 'update';
        }
    }
?>
