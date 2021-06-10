<?php

//database connection
include 'conn.php';

//function file
include 'function.php';

$added = '';

// Login user. if users are login, products store in database
if(isset($_SESSION['email_user']))   
{
    // when user are login and product stored in session
    if (isset($_SESSION['cart'])) 
    {
        //when user was login after he will be add new product in cart
        if (isset($_POST['add_to_cart'])) 
        {
            $product_id = $_POST['product_id'];

            $quantity = $_POST['quantity'];

            $query_select = "SELECT  * FROM cart WHERE product_id = '$product_id' ";

            $result_select = mysqli_query($conn,$query_select);

            // chaeck the product alredy added or not
            if (!mysqli_num_rows($result_select))
            {
                $row = mysqli_fetch_assoc($result_select);
                
                $query_insert = "INSERT INTO cart (product_id,quantity,status) VALUES ('$product_id','$quantity',1) ";

                $result_insert = mysqli_query($conn,$query_insert);

                echo "Product add to cart! ";
            }
            else
            {
                echo "Product alredy added! ";
            }
        }
        else
        {
        // if users are login before the products stored in cart, product direct store in database
            foreach($_SESSION['cart'] as $key => $value)
            {
                $product_id = $value['product_id'];

                $quantity = $value['quantity'];
            
            
                $query_select = "SELECT  * FROM cart WHERE product_id = '$product_id' ";

                $result_select = mysqli_query($conn,$query_select);

                // check the product already exist in cart. If that is exist, unset that product and redirect to index page
                if (mysqli_num_rows($result_select)) 
                {
                    
                    unset($_SESSION['cart']);

                }
                // if product  does not exist in cart, insert into cart
                else
                {
                    $query_insert = "INSERT INTO cart (product_id,quantity,status) VALUES ('$product_id','$quantity',1) ";

                    $result_insert = mysqli_query($conn,$query_insert);

                    if ($result_insert) 
                    {
                        $added = 'added';
                        unset($_SESSION['cart']);

                    }
                }
            }

            // check the item is insert or not 
            if ($added == 'added') {
                echo "Item Add to Cart!";
            }
            else
            {
                echo "Item Add to Cart!";
            }
        }
    }
    //when user are login and session and cart is empty then user insert new product
    else
    {
        if (isset($_POST['add_to_cart'])) 
        {
            $product_id = $_POST['product_id'];

            $quantity = $_POST['quantity'];

            $query_select = "SELECT  * FROM cart where product_id = '$product_id' ";
            
            $result_select = mysqli_query($conn,$query_select);

            // chaeck the product alredy added or not
            if (!mysqli_num_rows($result_select)) 
            {
                $row = mysqli_fetch_assoc($result_select);
                
                $query_insert = "INSERT INTO cart (product_id,quantity,status) VALUES ('$product_id','$quantity',1) ";

                $result_insert = mysqli_query($conn,$query_insert);

                echo "Product add to cart! ";
                
            }
            else
            {
                echo "Product alredy added";
            }
        }
    }

    //Remove item when user login
    if (isset($_POST['remove_product2'])) 
    {
        $product_id = $_POST['product_id'];

        // remove item query
        $query_remove = mysqli_query($conn,"DELETE FROM cart WHERE product_id = '$product_id' ");

        echo "<script>
                window.location.href = 'cart.php';
            </script>";
    }

    // Update quantity when user login
    if (isset($_POST['p_id'])) 
    {
        $pid = $_POST['p_id'];
        $qty = $_POST['p_qty'];
        $price = $_POST['p_price'];
    
        if (isset($_SESSION['email_user'])) {
            mysqli_query($conn,"UPDATE cart SET quantity = '$qty' WHERE product_id = '$pid' ");
        }
    }
}
// Without Login User. if user is not login, products store in seassion
else
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") 
    {
        if (isset($_POST['add_to_cart'])) 
        {
            $product_id = get_safe_value($_POST['product_id']);

            $quantity = get_safe_value($_POST['quantity']);

            $query_select_product = "SELECT * FROM product WHERE product_id = '$product_id'";

            $result_select_product = mysqli_query($conn, $query_select_product);

            $row_product = mysqli_fetch_assoc($result_select_product);

            // secound time session cart create
            if (isset($_SESSION['cart'])) 
            {
                $cart_product = array_column($_SESSION['cart'],'product_id');

                if (in_array($product_id,$cart_product) ) 
                {
                    echo "Product alredy addeds!";
                }
                else
                {
                    $count = count($_SESSION['cart']);

                    $_SESSION['cart'][$count] = array( 'product_id' => $product_id ,'product_name' => $row_product['product_name'] ,'product_price' => $row_product['product_price'] ,'product_detail'=>$row_product['product_detail'],'product_image'=>$row_product['product_image'],'quantity' => $quantity);

                    echo "Product add to Cart! ";
                }
            }
            // First time session cart create
            else
            {
                $_SESSION['cart'][0] = array( 'product_id' => $product_id ,'product_name' => $row_product['product_name'] ,'product_price' => $row_product['product_price'] ,'product_detail'=>$row_product['product_detail'],'product_image'=>$row_product['product_image'],'quantity' => $quantity);
                
                echo "Product add to Cart!";
            }

        }

        // Removce Product by remove button
        if (isset($_POST['remove_product'])) 
        {
        
            foreach($_SESSION['cart'] as $key=>$value)
            {
                if($value['product_id'] == $_POST['product_id'])
                {  
                    unset($_SESSION['cart'][$key]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']);
                
                    echo "<script>
                    window.location.href = 'cart.php';
                    </script>";
                }
            }
        }
        
        // Update Quantity
        if (isset($_POST['p_id'])) 
        {
            $pid = $_POST['p_id'];
            $qty = $_POST['p_qty'];
            $price = $_POST['p_price'];
        
            // Update Quantity
            if (isset($_SESSION['cart'][$pid])) {
                $_SESSION['cart'][$pid]['quantity']=$qty;
            }
        
        }
    }
}
?>