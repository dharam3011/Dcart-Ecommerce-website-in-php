<?php 

    //page  title
    $page_title = "Category-Admin";

    include 'top.php';

    if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['type']) && ($_GET['type']=='delete' || $_GET['type']=='active' || $_GET['type']=='deactive')) 
    {
        $type=get_safe_value($_GET['type']);

        $id=get_safe_value($_GET['id']);

        if ($type == 'active') 
        {
            $quary_update = "UPDATE category SET status = 1 WHERE category_id = '$id' ";

            $result_update = mysqli_query($conn, $quary_update);
        }

        if ($type == 'deactive') 
        {
            $quary_update = "UPDATE category SET status = '0' WHERE category_id = '$id' ";

            $result_update = mysqli_query($conn, $quary_update);
        }

        if ($type == 'delete') 
        {
            $query_delete = "DELETE FROM category WHERE category_id = '$id' ";

            $result_delete = mysqli_query($conn, $query_delete);
        }
    }

    $querDCy_select = "SELECT category.* FROM category ORDER BY category_name ASC";

    $result_select = mysqli_query($conn , $querDCy_select);

?>
    <!-- Your Content -->
<div id="container">
            
    <!-- Menu Button -->
    <button class="menu-btn">&#9776; Menu</button>    
    <a href="index.php" class="mx-3 text-decoration-none">Dashbord</a>/
            
    <div class="container-fluid" >
        <div class="sub-container">
            <div class="d-flex justify-content-between mb-3 mt-2">
                <h2>Category</h2>
                <a href="category_manage.php" class='btn bg-info mx-3 mt-3' role="button">Add Category</a>
            </div>
            <table class="table overflow-x: 1000px;">
                <thead class="text-center">
                    <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Image</th>
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
                        <td><a target="_blank" href="<?php echo DISPLAY_IMAGE.'/category/'.$row['category_image'] ?>"><img src="<?php echo DISPLAY_IMAGE.'/category/'.$row['category_image'] ?>" alt="" width="125" height="125"></a></td>
                        <td>
                            <?php
                                if ($row['status'] == 0) 
                                {
                            ?>
                                <a href="?id=<?php echo $row['category_id']; ?>&type=active" role="button" class="btn bg-warning" >Deactive</a>            
                            <?php 
                                }
                                else
                                {
                            ?>
                                <a href="?id=<?php echo $row['category_id']; ?>&type=deactive" role="button" class="btn bg-success" >active</a>
                            <?php 
                                }
                            ?>

                            <a href="category_manage.php?id=<?php echo $row['category_id']; ?>" role="button" class="btn bg-primary" >Edit</a>
                            <a href="?id=<?php echo $row['category_id']; ?>&type=delete" role="button" class="btn bg-danger" >Delete</a>
                        </td>
                        </tr>
                    <?php
                            $i++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php

    include 'footer.php';

?>