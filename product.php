
<?php

    // page title
    $page_title = 'Produt-Details';

    // header file
    include 'header.php';

    if (isset($_GET['product_id']) && $_GET['product_id'] != '') 
    {
        $id = urldecode(base64_decode($_GET['product_id']));
        
        $product_id = $id/1122334455;

        $query_select = "SELECT product.*,category.category_name FROM product INNER JOIN category ON product.category_id = category.category_id WHERE product_id ='$product_id' ";

        $result_select = mysqli_query($conn, $query_select);

        $row = mysqli_fetch_assoc($result_select);
        
    }
?>

    <div class="container content" style="margin:40px 140px;">
        <div class="product-card " style="max-width: 1200px; min-height:500px;">
            <div class="row g-0">
                <div class="col-md-4 product-img p-2">
                    <img src="<?php echo DISPLAY_IMAGE.'/'.$row['product_image']; ?>" class="class="product-img-<?php echo $row['category_name']; ?>" style="height:25rem">
                </div>
                <div class="col-md-8 ">
                    <div class="product-card-body m-2">
                        
                        <h5 class="product-card-title" style="height:3rem"><?php echo $row['product_name']; ?></h5>

                        <h5 class="product-card-title mt-3" ><strong>Price : <?php echo $row['product_price'] ; ?> ₹</strong></h5>

                        Qty : <input type="number" name="quantity" id="quantity<?php echo $product_id ?>" class="rounded-3" max='10' min='1' value="1">

                        <h6 class="product-card-title mt-3">Details :</h6>

                        <p class="product-card-text details" ><?php echo str_replace("\n", '<br />',  $row['product_detail']); ?></p>

                        <button type="submit" name="add_to_cart" class="product-btn bg-primary col-sm-8 mb-3" onclick="addToCart(<?php echo $product_id ?>)" >Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- external JS -->
<script src="js/add.js"></script>

<!-- footer -->
<?php include 'footer.php' ?>