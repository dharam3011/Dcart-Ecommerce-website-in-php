<?php

// page title
$page_title = 'Cart';

// header file
    include 'header.php';

?>
<span id="result"></span>
<div class="container-fluid mt-5 mb-5 " style="min-height: 412px;">
    <div class="row">
        <div class="col-sm-12">
            <h2 style="margin: 10px 10px;">My Cart</h2>
        </div>
    </div>
    <div class="row ">
        <div class="col-sm-9 mx-3">
           
        <?php 

            $t_item = 0;
            $t_price = 0;
            $p_name = '';

            if (isset($_SESSION['email_user'])) 
            {
                $query_select = "SELECT cart.quantity,product.* FROM cart INNER JOIN product ON cart.product_id=product.product_id ORDER BY cart_id DESC";

                $result_select = mysqli_query($conn,$query_select);
                
                while($value = mysqli_fetch_assoc($result_select))
                {
                    // count total item and price
                    $t_item =  $value['quantity'] + $t_item ; 
                    $t_price =  ($value['product_price']*$value['quantity']) + $t_price ; 
                    $p_name = $value['product_name'];
        ?>
            <form action="manage_cart.php" method="POST">
                <div class="product-card mb-3" style="max-width: 1380px;">
                    <div class="row g-0">
                        <div class="col-md-3 m-3">
                            <img src="images/<?php echo $value['product_image']; ?>" style="max-width:230px; height:200px">
                        </div>
                        <div class="col-md-8">
                            <div class="product-card-body ">
                                <h5 class="product-card-title"><?php echo $value['product_name']; ?></h5>
                                <h5 class="product-card-title"> Price : <?php echo $value['product_price']; ?> ₹ <input type="hidden" id="<?php echo $value['product_id']; ?>price" value="<?php echo $value['product_price']; ?>" > </h5>
                                <?php 
                                    $product = $value['product_detail'];
                                    $product_detail = substr($product,0,300).'.....';
                                ?>
                                <p class="product-card-text"><?php echo $product_detail; ?></p>
                                <div class=''>
                                    <!-- hidden Product Name -->
                                    <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ?>">

                                    <!-- lable of quantity -->
                                    <h6 class='float-start m-1'>Qty : </h6> 
                                    
                                    <select class=" m-1 rounded-3 text-center d-inline float-start i_qty" id="<?php echo $value['product_id']; ?>qty" name="qty" onchange="update(<?php echo $value['product_id'] ?>)">  
                                        <option value="<?php echo $value['quantity'] ?>"><?php echo $value['quantity'] ?></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    
                                    <!-- Remove quantity Button -->
                                    <button type="submit" name='remove_product2' class="btn btn-outline-danger float-start m-1">Remove</button>
                                    
                                </form>

                                <h5 class='float-end p-2'>Subtotal : <?php echo $s_total = $value['product_price']*$value['quantity'] ?> </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
                
                // for hide/unhide total price and item
                if ($p_name != '') 
                {
            ?>
            </div>
            <div class="col-sm-2 mx-2 py-2 border rounded-3 " style="height:300px">
                <div style="height: 230px;">
                    <h5 class="p-1"> Total Item :<strong><?php echo $t_item ?></strong></h5>
                    <h6 class="p-1">Total price : <strong><?php echo $t_price ?> ₹</strong></h6>
                
                    <!-- Cuppon code -->
                    <div class="p-1">
                        <input type="text" class="form-control" name="promo_code" id="promo_code" placeholder="apply promo code">
                        <a href="#" class="text-decoration-none "><h6 class="mt-2 px-1">more Promo Codes?</h6></a>
                    </div>
                </div>
                <!-- Produce to Buy or checkout Button -->
                <div class="mt-2">
                <?php
                    if (isset($_SESSION['email_user'])) 
                    {
                        
                ?>
                    <form action="checkout.php" method="POST">
                        <button type="submit" name="checkout" onclick="chechout()" class="btn bg-primary text-white col-sm-12 " >Proceed to Buy</button>
                    </form>
            <?php
                    }
                }
                else
                {
            ?>
                    <h4 class="text-center mt-5 offset-3" >Cart is empty!</h4>
                    <a href="index.php" class='active ' ><h6 class="text-center offset-3">Continue Shopping</h6></a>
            <?php  
                }
            ?>
            </div>
        </div>
        <?php
        }
        else
        {
            // product store in  session cart (user not login)
            if (isset($_SESSION['cart'])) 
            {
                ?>
                
                <form action="manage_cart.php" name="myForm" method="POST"  enctype="multipart/form-data">
                <?php
        
                    $t_item = 0;
                    $t_price = 0;

                    foreach($_SESSION['cart'] as $key => $value)
                    {
                        $product_id = $value['product_id'];
                        $t_item =  $value['quantity'] + $t_item ; 
                        $t_price =  ($value['product_price']*$value['quantity']) + $t_price ; 
                        $p_name = $value['product_name'];
                ?>
                    <div class="product-card mb-3" style="max-width: 1380px;">
                        <div class="row g-0">
                            <div class="col-md-3 m-3">
                                <?php 
                                    $result_best_seller  = mysqli_query($conn, "SELECT best_seller FROM product WHERE product_id = '$product_id' AND best_seller = 1");

                                    if (mysqli_num_rows($result_best_seller) > 0) 
                                    {
                                        echo '<h6 class="bg-success text-white px-2 col-md-5">Best seller</h6>';                   
                                    }
                                ?>
                                <img src="images/<?php echo $value['product_image']; ?>" style="max-width:230px; height:200px">
                            </div>
                            <div class="col-md-8">
                                <div class="product-card-body ">
                                    <h5 class="product-card-title"><?php echo $value['product_name']; ?></h5>
                                    <h5 class="product-card-title"> Price : <?php echo $value['product_price']; ?> ₹ <input type="hidden" id="<?php echo $key; ?>price" name="product_price" value="<?php echo $value['product_price'] ?>"> </h5>
                                    <p class="product-card-text details"><?php echo $value['product_detail']; ?></p>
                                    <div class=''>
                                    <!-- hidden Product Name -->
                                        <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ?>">

                                        <!-- lable of quantity -->
                                        <h6 class='float-start m-1'>Qty : </h6> 
                                        
                                        <select class=" m-1 rounded-3 text-center d-inline float-start i_qty" id="<?php echo $key; ?>qty" name="qty" onchange="update(<?php echo $key; ?>);">  
                                            <option value="<?php echo $value['quantity'] ?>"><?php echo $value['quantity'] ?></option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>

                                        <!-- Remove quantity Button -->
                                        <button type="submit" name='remove_product' class="btn btn-outline-danger float-start m-1">Remove</button>

                                    <h5 class='float-end p-2'>Subtotal : <?php echo $s_total = $value['product_price']*$value['quantity'] ?> </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </form>
            </div>
            <?php 
                // for hide/unhide total price and item
                if($p_name != '')
                {
            ?>
            <div class="col-sm-2 mx-2 py-2 border rounded-3 cart-summary">
                <div style="min-height: 230px;">
                    <h5 class="p-1"> Total Item :<strong><?php echo $t_item ?></strong></h5>
                    <h6 class="p-1">Total price : <strong><?php echo $t_price ?> ₹</strong></h6>
                
                    <!-- Cuppon code -->
                    <div class="p-1">
                        <input type="text" class="form-control" name="promo_code" id="promo_code" placeholder="apply promo code">
                        <a href="#" class="text-decoration-none "><h6 class="mt-2 px-1">more Promo Codes?</h6></a>
                    </div>
                </div>
                <!-- Produce to Buy or checkout Button -->
                <div class="mt-2 ">
                    <form action="login.php" method="POST">
                    <?php 
                        $type = 'checkout';
                        $href1 =  "login.php?type=".urlencode(base64_encode($type)) ;
                    ?>                    
                    <a href="<?php echo $href1; ?>" class="btn bg-primary text-white col-md-12">Produce to Buy</a>
                </div>
            </div>
            <?php 
                    }
                    else
                    {
            ?>
                    <h4 class="text-center mt-5 " >Cart is empty!</h4>
                    <a href="index.php" class='active' ><h6 class="text-center ">Continue Shopping</h6></a>
            <?php  
                    }
                }
                else
                {
            ?>
                <h4 class="text-center mt-5 offset-3">Cart is empty!</h4>
                <a href="index.php" class='active ' ><h6 class="text-center offset-3">Continue Shopping</h6></a>
            <?php  
                }
            }
            ?>
        </div>
    </div>
</div>    

<script>
// Update item Quantity
function update(pid)
  {
    var price = jQuery("#"+pid+"price").val();    
    var qty = jQuery("#"+pid+"qty").val();    
    
    jQuery.ajax({
      url : 'manage_cart.php',
      type : 'post',
      data : { 
        p_price : price,
        p_id : pid,
        p_qty : qty
      },
      success : function(data,status){
       window.location.href='cart.php';
        // jQuery("#result").html(data);
      } 
    }); 
  } 
</script>


<?php include 'footer.php'; ?>