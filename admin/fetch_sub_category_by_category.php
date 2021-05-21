<?php 
include '../conn.php';
    // Get the sub category values in product page and data pass by jQuery-ajax
    if (isset($_POST['cate_id'])) 
    {
        $cate_id = $_POST['cate_id'];
    
        $result_sub_category = mysqli_query($conn, "SELECT * FROM sub_category WHERE category_id = '$cate_id' ORDER BY sub_category_name ASC");
        if (mysqli_num_rows($result_sub_category)) 
        {
            while($row_sub = mysqli_fetch_assoc($result_sub_category)) 
            { 
        ?>
            <option value="<?php echo $row_sub['sub_category_id'] ?>"><?php echo $row_sub['sub_category_name'] ?></option>
        <?php 
            }    
        }
    }
    
?>