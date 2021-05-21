<?php 

    //page  title
    $page_title = "Sub Category-Admin";

    include 'top.php';

    $search = '';
    
    if (isset($_GET['id']) && $_GET['id'] != '' && isset($_GET['type']) && ($_GET['type']=='delete' || $_GET['type']=='active' || $_GET['type']=='deactive')) 
    {
        $type = get_safe_value(urldecode(base64_decode($_GET['type'])));

        $get_id = get_safe_value(urldecode(base64_decode($_GET['id'])));

        $id = $get_id/1122334455;

        if ($type == 'active') 
        {
            $quary_update = "UPDATE sub_category SET status = 1 WHERE sub_category_id = '$id' ";

            $result_update = mysqli_query($conn, $quary_update);
        }

        if ($type == 'deactive') 
        {
            $quary_update = "UPDATE sub_category SET status = '0' WHERE sub_category_id = '$id' ";

            $result_update = mysqli_query($conn, $quary_update);
        }

        if ($type == 'delete') 
        {
            $query_delete = "DELETE FROM sub_category WHERE sub_category_id = '$id' ";

            $result_delete = mysqli_query($conn, $query_delete);
        }
    }
    if (isset($_GET['search']) && $_GET['search'] != '') 
    {
        $search = get_safe_value($_GET['search']);
    }
?>

<!-- Your Content -->   
<div id="container">
    <!-- Menu Button -->
    <button class="menu-btn">&#9776; Menu</button>    
    <a href="index.php" class="mx-3 text-decoration-none">Dashbord</a>/<a href="sub_category.php" class="mx-3 text-decoration-none">Sub Category Manage</a>
    
    <div class="container-fluid">
        <div class="sub-container"> 
            <div class="d-flex justify-content-between mb-3 mt-2">
                <!-- page title -->
                <h2 class="mx-2 mt-1">Sub Category</h2>
                <!-- search box -->
                <div class="mt-1 col-md-4">
                    <form action="" method="get">
                        <input class="form-control col-md-12 me-2 " name="search" type="search" id="search" placeholder="Search Sub Category" onchange="if(this.value != ''){ this.form.submit()}" aria-label="Search">
                    </form>
                </div>
                <!-- total sub category -->
                <?php 
                    $result_total_sub_category = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM sub_category"));
                ?>
                <h5 class="mt-2 mx-2">Total Sub Category : <?php echo $result_total_sub_category ?>
                <!-- add new sub category btn -->
                <a href="sub_category_manage.php" class='btn bg-info mx-3 mt-2' role="button">Add Sub Category</a>
            </div>
            <?php
                if ($search != '') 
                {
                    $query_select = "SELECT sub_category.*, category.category_name FROM sub_category INNER JOIN category ON sub_category.category_id = category.category_id WHERE (sub_category.sub_category_name LIKE '%$search%' OR category.category_name LIKE '%$search%' ) ORDER BY sub_category_id DESC ";

                    $result_select = mysqli_query($conn , $query_select);
                    
                    if (mysqli_num_rows($result_select) > 0) 
                    { 
                ?>
                        <table class="table">
                            <thead class="text-center">
                                <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Image <small style="color:grey">(click on Images)</small></th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php 
                                    
                                    $i = 1;

                                    while($row = mysqli_fetch_assoc($result_select))
                                    {
                                ?>        
                                    <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $row['category_name'] ?></td>
                                    <td><?php echo $row['sub_category_name'] ?></td>
                                    <td><a target="_blank" href="<?php echo DISPLAY_IMAGE.'/sub_category/'.$row['sub_category_image'] ?>"><img src="<?php echo DISPLAY_IMAGE.'/sub_category/'.$row['sub_category_image'] ?>" alt="" width="125" height="150"></a></td>
                                    <td>
                                        <?php

                                            if ($row['status'] == 0) 
                                            {
                                                $type1 = 'active';
                                                $href1 = "?id=".urlencode(base64_encode($row['sub_category_id']*1122334455))."&type=".urlencode(base64_encode($type1));
                                        ?>
                                            <a href="<?php echo $href1; ?>" role="button" class="btn bg-warning" >Deactive</a>            
                                        <?php 
                                            }
                                            else
                                            {
                                                $type2 = 'deactive';
                                                $href2 = "?id=".urlencode(base64_encode($row['sub_category_id']*1122334455))."&type=".urlencode(base64_encode($type2));
                                        ?>
                                            <a href="<?php echo $href2; ?>" role="button" class="btn bg-success" >active</a>
                                        <?php 
                                            }
                                            $type3 = 'delete';
                                            $href3 = "sub_category_manage.php?id=".urlencode(base64_encode($row['sub_category_id']*1122334455));
                                            $href4 = "?id=".urlencode(base64_encode($row['sub_category_id']*1122334455))."&type=".urlencode(base64_encode($type2));
                                        ?>

                                        <a href="<?php echo $href3; ?>" role="button" class="btn bg-primary" >Edit</a>
                                        <a href="<?php echo $href4; ?>" role="button" class="btn bg-danger" >Delete</a>
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
            <!-- data pass to sub_category_pagination page -->
            <div id="table-data">
                <!-- sub category data -->
            </div>
            <?php 
                }
            ?>
        </div>
    </div>
</div>
<!-- pagination script -->
<script>
    $(document).ready(function(){
        function pageload(page){

            $.ajax({
                url : 'sub_category_pagination.php',
                type : 'post',
                data : {
                    page_no : page,
                },
                success : function(data){                   
                    $('#table-data').html(data);
                }
            });
        }
        
        pageload();

        // pagination button
        $(document).on('click','#pagination a', function(e){
            e.preventDefault();

            var page_no = $(this).attr('id');

            pageload(page_no);
        });

            
    });
    
</script>

<!-- footer -->
<?php include 'footer.php'; ?>