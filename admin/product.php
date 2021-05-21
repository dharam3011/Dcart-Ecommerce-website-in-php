<?php 

    //page  title
    $page_title = "Product Master-Admin";

    // header file
    include 'top.php';

    $search = '';

    if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['type']) && $_GET['type']=='delete') 
    {
        $type=get_safe_value($_GET['type']);

        $id=get_safe_value($_GET['id']);

        if ($type == 'delete') 
        {
            $query_delete = "DELETE FROM product WHERE product_id = '$id' ";

            $result_delete = mysqli_query($conn, $query_delete);
        }
    }
    // search box
    if (isset($_GET['search']) && $_GET['search'] != '')
    {
        $search = get_safe_value($_GET['search']);
    }
?>
<!-- Your Content -->
<div id="container">
    <!-- Menu Button -->
    <button class="menu-btn">&#9776; Menu</button>    
    <a href="index.php" class="mx-3 text-decoration-none">Dashbord</a>/<a href="product.php" class="mx-3 text-decoration-none">Product Manage</a>
        
    <div class="container-fluid">
        <div class="sub-container" >
            <div class="d-flex justify-content-between mb-3 mt-2">
                <!-- page title -->
                <h2 class="mt-1">Products</h2>
                <!-- search box -->
                <div class="mt-1 col-md-4">
                    <form action="" method="get">
                        <input class="form-control col-md-12 mx-2" type="search" name="search" id="search" onchange="if(this.value != ''){ this.form.submit() }" placeholder="Search Products" aria-label="Search">
                    </form>
                </div>
                <!-- total products -->
                <?php 
                    $result_total_products = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM product"));
                ?>
                <h5 class="mt-2">Total Products : <?php echo $result_total_products ?></h5>
                <!-- add new product btn -->
                <a href="product_manage.php" class='btn bg-info mx-3 mb-1' role="button">Add Product</a>
            </div>
            <!-- search data -->
            <?php
                if ($search != '') 
                {
                    $query_select_product = "SELECT product.*,sub_category.sub_category_name,category.category_name FROM product 
                    INNER JOIN sub_category ON sub_category.sub_category_id = product.sub_category_id 
                    INNER JOIN category ON category.category_id = product.category_id 
                    WHERE (product.product_name LIKE '%$search%' OR product.product_detail LIKE '%$search%' OR sub_category.sub_category_name LIKE '%$search%' OR category.category_name LIKE '%$search%' )
                    ORDER BY product_id DESC  ";

                    $result_select_product = mysqli_query($conn , $query_select_product);

                    if (mysqli_num_rows($result_select_product) > 0) 
                    {
                    ?>
                    <table class="table">
                        <thead class="text-center">
                        <tr>
                        <th scope="col" width='1%'>#</th>
                        <th scope="col"  width='6%'>Category</th>
                        <th scope="col"  width='6%'>Sub Category</th>
                        <th scope="col" width='13%'>Product Name</th>
                        <th scope="col" width='5%'>Product Price</th>
                        <th scope="col" width='25%'>Product Detail</th>
                        <th scope="col" width='10%'>Product Image</th>
                        <th scope="col" width='10%'>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 

                        $i = 1;

                        while($row = mysqli_fetch_assoc($result_select_product))
                        {
                        ?>        
                        <tr>
                        <th scope="row" class="text-center"><?php echo $i; ?></th>
                        <td  class="text-center"><?php echo $row['category_name'] ?></td>
                        <td  class="text-center"><?php echo $row['sub_category_name'] ?></td>
                        <td class="text-center"><?php echo $row['product_name'] ?></td>
                        <td class="text-center"><strong><?php echo $row['product_price'] ?> ₹</strong></td>
                        <td><div class="details"><?php echo str_replace("\n", '<br />',  $row['product_detail']); ?></div></td>
                        <td class="text-center"><a target="_blank" href="<?php echo DISPLAY_IMAGE.'/'.$row['product_image']; ?>"><img src="<?php echo DISPLAY_IMAGE.'/'.$row['product_image']; ?>" style="width: 100px; height:100px;"></a></td>
                        <td class="text-center">
                            <?php
                                $type = "delete";
                                $href1 = "product_manage.php?id=".urlencode(base64_encode($row['product_id']*1122334455));
                                $href2 = "?id=".urlencode(base64_encode($row['product_id']*1122334455)).'&type='.urlencode(base64_encode($type));
                            ?>
                            <a href="<?php echo $href1; ?>" role="button" class="btn bg-primary my-2" >Edit</a>
                            <a href="<?php echo $href2; ?>&type=delete" role="button" class="btn bg-danger my-2" >Delete</a>
                        </td>
                        </tr>
                        <?php
                            $i++;
                        }
                        ?>
                        </tbody>
                    </table>
                <?php
                    }
                    else
                    {
                    ?>
                        <h3 class="text-center mt-3">No Record Found!</h3>
                    <?php
                    }
                }
                else
                {
            ?>
            <!-- data pase to product_pagination page -->
            <div id="table-data">
                <!-- product data -->
            </div>
            <?php 
                }
            ?>
        </div>
    </div>
</div>

<!-- Pagination script -->
<script>
    $(document).ready(function() {
        
        //pagitation
        function loadpage(page){
            $.ajax({
                url : 'product_pagination.php',
                type : 'post',
                data : {
                    page_no : page
                },
                success : function(data){
                    $("#table-data").html(data);
                }
            });
        };
        loadpage();

        // pagitation btn
        $(document).on('click','#pagination a', function(e){
            e.preventDefault();

            var page_id = $(this).attr('id');
            
            loadpage(page_id);
        });
    
    });
</script>
<!-- footer -->
<?php include 'footer.php'; ?>