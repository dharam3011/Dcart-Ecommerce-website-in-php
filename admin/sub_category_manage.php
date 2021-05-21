<?php 
$page_title = 'Add Sub Category-Admin' ;

    include 'top.php'; 

    $sub_category_id = '';

    $category_id = '';

    $sub_category_name = '';

    $category_name = 'Select Category...';

    $id = '';

    $msg = '';

    // get id for upadate
    if (isset($_GET['id']) && $_GET['id'] != '') 
    {
        $get_id=get_safe_value(urldecode(base64_decode($_GET['id'])));

        $id = $get_id/1122334455;
        
        $query_select = "SELECT sub_category.*, category.category_name FROM sub_category 
                                                INNER JOIN category ON sub_category.category_id = category.category_id
                                                WHERE sub_category_id = '$id' ";

        $result_select = mysqli_query($conn, $query_select);

        $row_get = mysqli_fetch_assoc($result_select);

        $sub_category_name = get_safe_value($row_get['sub_category_name']); 

        $sub_category_image_get = get_safe_value($row_get['sub_category_image']); 

        $category_id = get_safe_value($row_get['category_id']); 

        $category_name = get_safe_value($row_get['category_name']); 
    }

    if (isset($_POST['submit'])) 
    {
        $sub_category_id = trim(get_safe_value($_POST['sub_category_id']));    
        
        $sub_category_name = trim(get_safe_value($_POST['sub_category_name']));

        $category_id = trim(get_safe_value($_POST['category_id']));    

        $sub_category_image = $_FILES['sub_category_image']['name'];

        $sub_category_image_tmp = $_FILES['sub_category_image']['tmp_name'];

        $sub_category_image_type = $_FILES['sub_category_image']['type'];

        if($id=='') // for Duplicate Product
        {
            $query = "SELECT * FROM sub_category WHERE category_id = '$category_id' AND sub_category_name = '$sub_category_name'";
        }
        else
        {
            $query = "SELECT * FROM sub_category WHERE category_id = '$category_id' AND sub_category_name = '$sub_category_name' AND sub_category_id != '$id' ";
        }

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
                if ($sub_category_image_type != 'image/jpeg' && $sub_category_image_type != 'image/png') 
                {
                    $msg = "Please check it, Image type is not reqired!";
                }
                else
                {
                    // insert category and image
                    $query_insert = "INSERT INTO sub_category (category_id,sub_category_name,sub_category_image,status) VALUES ('$category_id','$sub_category_name','$sub_category_image',1)";

                    $result_ins = mysqli_query($conn, $query_insert);

                    // updoad image seleted folder
                    move_uploaded_file($sub_category_image_tmp,UPLOAD_IMAGE.'/sub_category/'.$sub_category_image);

                    redirect('sub_category.php');
                }
            }
            // if ID is not eqal to NULL , execute update query 
            else
            {
                // Other dateils is update and image not update
                if ($sub_category_image == '') 
                {
                    $sub_category_image = $sub_category_image_get;

                    $query_update = "UPDATE sub_category SET category_id = '$category_id',sub_category_name='$sub_category_name', sub_category_image='$sub_category_image' WHERE sub_category_id = '$id' ";

                    mysqli_query($conn, $query_update);

                    redirect('sub_category.php');
                }
                // update all details
                else
                {
                    // image type error msg
                    if ($sub_category_image_type != "image/jpeg" && $sub_category_image_type != "image/png") 
                    {
                        $msg = "Please check it, Image type is not reqired!";
                    }
                    else
                    {
                        // old image remove from folder
                        $old_image = $sub_category_image_get;

                        unlink(UPLOAD_IMAGE."/sub_category/".$old_image); //file remove function

                        // update sub_category and image
                        $query_update = "UPDATE sub_category SET category_id = '$category_id', sub_category_name='$sub_category_name', sub_category_image='$sub_category_image' WHERE sub_category_id = '$id' ";

                        mysqli_query($conn, $query_update);

                        // updoad image seleted folder
                        move_uploaded_file($sub_category_image_tmp,UPLOAD_IMAGE.'/sub_category/'.$sub_category_image);

                        redirect('sub_category.php');
                    }
                }
            }
        }
    }

?>

<!-- Your Content -->
<div id="container">
    <?php 
        if($id == '')
        {
            $content_title = 'Add New Sub Category' ;
        }
        else
        {
            $content_title = 'Update Sub Category' ;
        }
    ?>
    <!-- Menu Button -->
    <button class="menu-btn">&#9776; Menu</button>    
    <a href="index.php" class="mx-3 text-decoration-none">Dashbord</a>/<a href="sub_category.php" class="mx-3 text-decoration-none">Sub Category Manage</a>/<a href="sub_category_manage.php" class="mx-3 text-decoration-none"><?php echo $content_title ?></a>
    
    <div class="container border rounded-3 p-4 mt-3 mb-4">
        <div class="row">
            <div class="col-sm-8 offset-2">
            <h3><?php echo $content_title ?></h3>
                <form method="post" enctype="multipart/form-data">
                    <!-- error message -->
                    <div class=" form-group mt-2 mb-2 text-danger " >
                        <h5 class="error_msg"><?php echo $msg; ?></h5>
                    </div>
                    <!-- category -->
                    <div class="form-group">
                        <label for="category_name" class="form-label">Category Name</label>
                        <select name="category_id" class="form-select mb-2 validation" id="category" required>
                            <option value="<?php echo $category_id;?>"><?php echo $category_name;?></option>
                    <?php 
                        $result_select_category = mysqli_query($conn,"SELECT * FROM category ");

                        while ($row_category = mysqli_fetch_assoc($result_select_category)) 
                        {      
                    ?>
                            <option value="<?php echo $row_category['category_id'];?>"><?php echo $row_category['category_name'];?></option>
                    <?php
                        }
                    ?>
                    </select>
                    </div>
                    <!-- sub category -->
                    <div class="form-group">
                        <label for="sub_category_name" class="form-label">Sub Category Name</label>
                        <input type="text" name="sub_category_name" class="form-control mb-2 validation" value="<?php echo $sub_category_name ?>" required>
                    </div>
                    <!-- sub category Image-->
                    <div class="form-group">
                        <label for="sub_category_image" class="form-label">Image</label>
                        <input type="file" name="sub_category_image" class="form-control mb-2" >
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn bg-primary col-sm-5 text-white  mt-3 velidate_btn" onclick="validation()"><?php echo $content_title ?></button>
                    </div>
                </form>    
            </div>
        </div>
    </div>
</div>

<!--  jQuery Form validation -->
<script>
    function validation(){
        
        var validation =  $('.validation').val();

        if (validation == '') 
        {
            $('.error_msg').text('Please requried all field!');
        }
    }

</script>
<!-- footer -->
<?php include 'footer.php'; ?>