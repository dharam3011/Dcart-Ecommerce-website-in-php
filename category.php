
<?php 

    // page title
    $page_title = 'category'; 

    // header file
    include 'header.php';

    // null variables
    $cat_id = '';
    $sort_order_cat = '';
    $price_low_selected = '';
    $price_high_selected = '';
    $new_selected = '';
    $old_selected = '';

    // get method
    if((isset($_GET['id']) && $_GET['id'] != '' && isset($_GET['catName']) && $_GET['catName'] != '' ) || (isset($_GET['sp']) && $_GET['sp' != '']))
    {
        // category id
        $get_cat_id = $_GET['id'];

        $decode_cat_id = get_safe_value(urldecode(base64_decode($_GET['id'])));

        $cat_id = $decode_cat_id/1122334455;

        // category name
        $get_catName = $_GET['catName'];

        $category_name =  get_safe_value(urldecode(base64_decode($_GET['catName'])));

        // sort product
        if (isset($_GET['sp'])) 
        {
            $sort_product = get_safe_value($_GET['sp']);    

            if ($sort_product == 'price_low') 
            {
                $sort_order_cat = " ORDER BY product.product_price DESC ";
                $price_low_selected = 'selected';
            }
            if ($sort_product == 'price_high') 
            {
                $sort_order_cat = " ORDER BY product.product_price ASC ";
                $price_high_selected = 'selected';
            }
            if ($sort_product == 'new') 
            {
                $sort_order_cat = " ORDER BY product_id DESC ";
                $new_selected = 'selected';
            }
            if ($sort_product == 'old') 
            {
                $sort_order_cat = " ORDER BY product_id ASC ";
                $old_selected = 'selected';
            }
        }
        
    }
    
?>

<div class="container-fluid content pt-5" style="min-height: 546px;">
        <div class="d-flex justify-content-lg-between mt-2 mb-3 ">
            <!-- heading -->
            <h1 class="mt-3"><?php echo $category_name ; ?></h1>
            <!-- prodct sorted -->
            <div class="col-sm-3 mt-3">
                <form action="" method="get">
                    <input type="hidden" name="id" id="sCatId" value="<?php echo $get_cat_id; ?>">
                    <input type="hidden" name="catName" id="catName" value="<?php echo $get_catName; ?>">
                    <select name="sp" id="sort_product" onchange="if(this.value !=''){ this.form.submit() }" class="form-select my-2 ">
                    <option value="">Default Sorting</option>
                    <option value="price_high" <?php echo $price_high_selected ?> >Sort by price low to high</option>
                    <option value="price_low" <?php echo $price_low_selected ?> >Sort by price high to low</option>
                    <option value="new" <?php echo $$new_selected ?> >Sort by new product</option>
                    <option value="old" <?php echo $old_selected ?> >Sort by old product</option>
                </select>
                </form>
            </div>
        </div>
        <div class="row ">
        <?php
    
            $product_arr = get_product('',$cat_id,'',$sort_order_cat);

                foreach($product_arr as $product)
                {
                    $product_id = $product['product_id'];
                    
                    $href1 = "product.php?product_id=".urlencode(base64_encode($product['product_id']*1122334455));
            ?>
                <div class="col-sm-3 pb-4">
                    <form action="manage_cart.php" method="POST" >
                    <div class="product-card" style="max-width: 17rem;height:400px" >
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
                            $product_name = substr($product,0,35).'...';
                        ?>
                            
                            <a href="<?php echo $href1 ;?>" class="text-decoration-none">
                                <h6><?php echo $product_name ?></h6>
                            </a>
                            </div>
                            <div class="">
                                <a href="" class="which-list "><i class="fa fa-fw fa-heart text-secondary"  aria-hidden="true"></i></a>
                                <input type="hidden" id="quantity<?php echo $product_id ?>" value="1">
                                <a href="#" role="button" onclick="addToCart(<?php echo $product_id; ?>)" ><i class='fas fa-fw fa-cart-arrow-down text-dark'></i></a>
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

    <!-- external JS -->
    <script src="js/add.js"></script>
<?php include 'footer.php' ?>