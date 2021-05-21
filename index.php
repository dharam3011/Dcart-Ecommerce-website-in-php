<?php

// page title
$page_title = 'Home';

// header file
    include 'header.php';

    $name = '';
    
    if (isset($_SESSION['email_user'])) 
    {
        if (isset($_SESSION['cart']) ) 
        {
            foreach($_SESSION['cart'] as $key => $value)
            {
                $name = $value['product_name'];            
            }
            if ($name != '' ) 
            {
                redirect('manage_cart.php');
            }    
        }
    }

?>
<div class="container-fluid content mrg">
    <h1 class="m-1">New Arrivals</h1>
    <div class="row d-flex">
        <?php
            $product_arr = get_product('4');
                foreach($product_arr as $product)
                {   
                    $new_arrival_product_id = $product['product_id'];
                    $href1 = "product.php?product_id=".urlencode(base64_encode($new_arrival_product_id*1122334455));
                
            ?>
            <div class="col-sm-3 pb-4">
                <form action="manage_cart.php" method="POST" >
                    <div class="product-card" style="max-width: 17rem;min-height:400px" >
                        <div class="product-img">
                            <a href="<?php echo $href1 ;?>"><img src="<?php echo DISPLAY_IMAGE.'/'.$product['product_image']; ?>" class="product-img-<?php echo $product['category_name']; ?>" alt=""  ></a>
                            
                        </div>
                        <div class="product-card-body ">
                            <div class="product-titles">
                        <?php 
                        
                            $product = $product['product_name'];
                            $product_name = substr($product,0,24).'...';
                        ?>
                            
                            <a href="<?php echo $href1 ;?>" class="text-decoration-none">
                                <h6><?php echo $product_name ?></h6>
                            </a>
                            </div>
                            <div class="">
                            <?php  //= $product['product_id']; ?>
                                <a href="#"  type='submit' class="which-list " ><i class="fa fa-fw fa-heart text-secondary"  aria-hidden="true"></i></a>
                                <a href="#" role="button" onclick="addToCart(<?php echo $new_arrival_product_id; ?>)" ><i class='fas fa-fw fa-cart-arrow-down text-dark'></i></a>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php 
                }
            ?>
    </div>
</div>


<div class="container-fluid mrg">
    <h1 class="m-1">Best Saler</h1>
    <div class="row d-flex">
        <?php
            $product_arr = get_product('8','','','','','yes');
                foreach($product_arr as $product)
                {
                    $best_seller_product_id = $product['product_id'];

                    $href1 = "product.php?product_id=".urlencode(base64_encode($product['product_id']*1122334455));
                
            ?>
            <div class="col-sm-3 pb-4">
            <form action="manage_cart.php" method="POST" >
                <div class="product-card" style="max-width: 17rem;min-height:400px" >
                    <div class="product-img">
                        <!-- best seller teg -->
                        <?php 
                            if ($product['best_seller'] == 1) 
                            {
                                echo '<h6 class="bg-success text-white px-2 col-md-5">Best seller</h6>';
                            } 
                        ?>
                        <a href="<?php echo $href1 ;?>"><img src="<?php echo DISPLAY_IMAGE.'/'.$product['product_image']; ?>" class="product-img-<?php echo $product['category_name']; ?>" alt=""  ></a>
                    </div>
                    <div class="product-card-body ">
                        <div class="product-titles">
                    <?php 
                        $product = $product['product_name'];
                        $product_name = substr($product,0,23).'...';
                    ?>
                        
                        <a href="<?php echo $href1 ;?>" class="text-decoration-none">
                            <h6><?php echo $product_name ?></h6>
                        </a>
                        </div>
                        <div class="">
                        <a href="" class="which-list "><i class="fa fa-fw fa-heart text-secondary"  aria-hidden="true"></i></a>
                        <input type="hidden" id="quantity<?php echo $best_seller_product_id ?>" value="1">
                        <a href="#" role="button" onclick="addToCart(<?php echo $best_seller_product_id; ?>)" ><i class='fas fa-fw fa-cart-arrow-down text-dark'></i></a>
                    </div>
                    </div>
                    </div>
                </form>
            </div>
            <?php 
                }
            ?>
    </div>
</div>

<!-- extranal JS -->
<script src="js/add.js"></script>

<?php include 'footer.php' ?>