<?php 
    // page title
    $page_title = " Product-Admin";

    // header file
    include 'top.php' ;
    
    // null variables
    $category_id = '';

    $category_name = 'Select Category';

    $sub_category_id = '';

    $sub_category_name = 'Select Sub Category';

    $product_name = '';

    $product_price = '';

    $product_detail = '';

    $product_image = '';

    $best_seller = '';

    $meta_title = '';

    $meta_desc = '';

    $meta_keyword = '';

    $id = '';

    $msg = '';

    // get id and old details for upadate
    if (isset($_GET['id']) && $_GET['id'] != '') 
    {
        $get_id = urldecode(base64_decode($_GET['id']));
        
        $id = $get_id/1122334455;
        $query_select = "SELECT product.*,category.category_name,sub_category.sub_category_name FROM product 
                                        INNER JOIN category ON product.category_id = category.category_id
                                        INNER JOIN sub_category ON product.sub_category_id = sub_category.sub_category_id WHERE product_id = '$id' ";

        $result_select = mysqli_query($conn, $query_select);

        $row_get = mysqli_fetch_assoc($result_select);

        $category_id = get_safe_value($row_get['category_id']);

        $category_name = get_safe_value($row_get['category_name']);

        $sub_category_id = get_safe_value($row_get['sub_category_id']); 

        $sub_category_name = get_safe_value($row_get['sub_category_name']); 

        $product_name = get_safe_value($row_get['product_name']);

        $product_price = get_safe_value($row_get['product_price']);

        $product_detail = $row_get['product_detail'];

        $product_image_get = get_safe_value($row_get['product_image']);

        $best_seller = get_safe_value($row_get['best_seller']);

        $meta_title = get_safe_value($row_get['meta_title']);

        $meta_desc = get_safe_value($row_get['meta_desc']);

        $meta_keyword = get_safe_value($row_get['meta_keyword']);
    }

    // POST Method
    if (isset($_POST['submit'])) 
    {
        $category_id = get_safe_value($_POST['category_id']);

        $sub_category_id = get_safe_value($_POST['sub_category_id']); 

        $product_name = get_safe_value($_POST['product_name']);

        $product_price = get_safe_value($_POST['product_price']);

        $product_detail = $_POST['product_detail'];
        
        $product_image = $_FILES['image']['name'];

        $product_image_tmp = $_FILES['image']['tmp_name'];

        $product_image_type = $_FILES['image']['type'];

        $best_seller = get_safe_value($_POST['best_seller']);

        $meta_title = get_safe_value($_POST['meta_title']);

        $meta_desc = get_safe_value($_POST['meta_desc']);

        $meta_keyword = get_safe_value($_POST['meta_keyword']);

        // for Duplicate Product
        if($id=='') 
        {
            $query = "SELECT * FROM product WHERE product_name='$product_name'";
        }
        else
        {
            $query = "SELECT * FROM product WHERE product_name='$product_name' AND product_id!='$id'";
        }

        // error massage 
        if(mysqli_num_rows(mysqli_query($conn, $query)) > 0)
        {
            $msg="Please check it, Product already added !";
        }
        else
        {
            // if ID is eqal to NULL , execute insert query        
            if ($id == '')  
            {
                // image type error msh
                if ($product_image_type != 'image/jpeg' && $product_image_type != 'image/png') 
                {
                    $msg = "Please check it, Image type is not reqired!";
                }
                else
                {
                    // insert category and image
                    $query_insert = "INSERT INTO product (category_id,sub_category_id,product_name,product_price,product_detail,product_image,best_seller,meta_title,meta_desc,meta_keyword,status) 
                                    VALUES ('$category_id','$sub_category_id','$product_name','$product_price','$product_detail','$product_image','$best_seller','$meta_title','$meta_desc','$meta_keyword',1)";

                    $result_insert = mysqli_query($conn, $query_insert);

                    // updoad image seleted folder
                    move_uploaded_file($product_image_tmp,UPLOAD_IMAGE.'/'.$product_image);    
                    
                    redirect('product.php');
                }
            }
            // if ID is not eqal to NULL , execute update query 
            else 
            {
                // Other dateils is update and image not update
                if ($product_image == '') 
                {
                    $product_image = $product_image_get;
                    
                    $query_update = "UPDATE product SET category_id = '$category_id',sub_category_id = '$sub_category_id', product_name = '$product_name',product_price = '$product_price', 
                                        product_detail= '$product_detail', product_image = '$product_image',best_seller = '$best_seller',meta_title='$meta_title',meta_desc = '$meta_desc', meta_keyword = '$meta_keyword' WHERE product_id = '$id' ";

                    mysqli_query($conn, $query_update);

                    redirect('product.php');
                }
                // update all details
                else
                {
                    // image type error msg
                    if ($product_image_type != 'image/jpeg' && $product_image_type != 'image/png' ) 
                    {
                        $msg = "Please check it, Image type is not reqired !";
                    }
                    else
                    {   
                        // Old Image Remove from the folder 
                        $old_img = $product_image_get;

                        unlink(UPLOAD_IMAGE."/".$old_img); //file remove function

                        // update category and image
                        $query_update = "UPDATE product SET category_id = '$category_id',sub_category_id = '$sub_category_id', product_name = '$product_name',product_price = '$product_price', product_detail= '$product_detail', 
                                                product_image = '$product_image' ,best_seller = '$best_seller',meta_title='$meta_title',meta_desc = '$meta_desc', meta_keyword = '$meta_keyword' WHERE product_id = '$id' ";

                        mysqli_query($conn, $query_update);

                        // updoad image seleted folder
                        move_uploaded_file($product_image_tmp,UPLOAD_IMAGE.'/'.$product_image);    

                        redirect('product.php');
                    }
                }
            }    
        }
    }

?>
<!-- Your Content -->
<div id="container" >
    <?php 
        if($id == '')
        {
            $content_title = 'Add New Product' ;
        }
        else
        {
            $content_title = 'Update Product' ;
        }
    
    ?>
    <!-- Menu Button -->
    <button class="menu-btn">&#9776; Menu</button>    
    <a href="index.php" class="mx-3 text-decoration-none">Dashbord</a>/<a href="product.php" class="mx-3 text-decoration-none">Product Manage</a>/<a href="product_manage.php" class="mx-3 text-decoration-none"><?php echo $content_title ?></a>
    
    <div class="container border rounded-3 p-4 mt-4 mb-4">
        <div class="row">
            <div class="col-sm-8 offset-2">
            <h3><?php echo $content_title ?></h3>
                <form method="post" enctype="multipart/form-data">
                <div class="form-group mt-2 mb-2 text-danger" >
                    <h5><?php echo $msg ; ?></h5>
                </div>
                <div class="form-group">
                    <label for="category_name" class="form-label">Category</label>
                    <select name="category_id" class="form-select mb-2" id="category" onchange="selectCat()" required>
                        <option value="<?php echo $category_id ?>"><?php echo $category_name ?></option>
                        <?php 
                            $result_category = mysqli_query($conn, "SELECT * FROM category ORDER BY category_name ASC");
                            while($row = mysqli_fetch_assoc($result_category)) 
                            {
                                
                        ?>
                        <option value="<?php echo $cate_id  = $row['category_id']; ?>"><?php echo $row['category_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                        <label for="Product_name" class="form-label">Sub Category</label>
                        <select name="sub_category_id" class="form-select " id="sub_category_dropdown" required>
                            <option value="<?php echo $sub_category_id ?>"><?php echo $sub_category_name ?></option>
                        </select>
                        <?php 
                            if ($id != '') {
                               echo '<span class="mb-2"><small class="text-secondary">If you update Sub Category, first of all reset Category</small> </span>';
                            }
                            else
                            {
                                echo '<span class="mb-2"><small class="text-secondary">First of all select category</small> </span>';
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="Product_name" class="form-label">Product Name</label>
                        <input type="text" name="product_name" class="form-control mb-2" value="<?php echo $product_name ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="Product_name" class="form-label">Product Price</label>
                        <input type="text" name="product_price" class="form-control mb-2" value="<?php echo $product_price ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="Product_name" class="form-label">Product Detail</label>
                        <textarea name="product_detail" rows="5" class="form-control " required><?php echo str_replace('<br />', "\n", $product_detail); ?></textarea>
                        <small class="text-secondary">Don't use the special character like (quotes ' )</small>
                    </div>
                    <div class="form-group">
                        
                        <label for="Product_name" class="form-label">Best Seller</label>
                        <select name="best_seller" class="form-select mb-2" id="best_seller" required>
                            <option value="" >select</option>
                            <?php 
                            if ($best_seller == 1) 
                            {
                                echo '<option value="1" selected>Yes</option>
                                    <option value="0" >No</option>';
                            }
                            elseif ($best_seller != '') 
                            {
                                echo '<option value="1" >Yes</option>
                                <option value="0" selected>No</option>';
                            }
                            else
                            {
                                echo '<option value="1" >Yes</option>
                                <option value="0" >No</option>';
                            }
                        ?>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Product_name" class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control mb-2" value="<?php echo $meta_title ?>" placeholder="product title" required>
                    </div>
                    <div class="form-group">
                        <label for="Product_name" class="form-label">Meta Description</label>
                        <input type="text" name="meta_desc" class="form-control " value="<?php echo $meta_desc ?>" placeholder="product sort description" required>
                        <small class="text-secondary mb-2">maximum 200 charecter</small>
                    </div>
                    <div class="form-group">
                        <label for="Product_name" class="form-label">Meta Keyword</label>
                        <input type="text" name="meta_keyword" class="form-control mb-2" value="<?php echo $meta_keyword ?>" placeholder="product keyword">
                    </div>
                    
                    <div class="form-group">
                        <label for="Product_name" class="form-label">Product Image</label>
                        <input type="file" name="image" class="form-control mb-2" value="<?php echo $product_image ?>" >
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn bg-primary col-sm-5 text-white  mt-3" required><?php echo $content_title ?></button>
                    </div>
                </form>    
            </div>
        </div>
    </div>
</div>
<script>
    function selectCat(){
        var category_id = $('#category').val();
        $.ajax({
            url : 'fetch_sub_category_by_category.php',
            type : 'post',
            data : {
                cate_id : category_id
            },
            success : function(data,restult){
                $("#sub_category_dropdown").html(data);
                // alert(data)
            }
        });
    }
</script>
<?php include 'footer.php' ?>