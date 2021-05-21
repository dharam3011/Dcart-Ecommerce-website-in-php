<?php 

    // page title
    $page_title = 'Add Category-Admin' ;

    // header file
    include 'top.php'; 

    // null variables
    $category_id = '';

    $category_name = '';

    $id = '';

    $msg = '';

    // get id and old details for upadate
    if (isset($_GET['id']) && $_GET['id'] > 0) 
    {
        $id = get_safe_value($_GET['id']);
        
        $query_select = "SELECT * FROM category WHERE category_id = '$id' ";

        $result_select = mysqli_query($conn, $query_select);

        $row_get = mysqli_fetch_assoc($result_select);

        $category_name = get_safe_value($row_get['category_name']); ;

        $category_image_get = get_safe_value($row_get['category_image']); 
    }

    // POST Method
    if (isset($_POST['submit'])) 
    {
        $category_name = trim(get_safe_value($_POST['category_name']));    
        
        $category_image = $_FILES['category_image']['name'];

        $category_image_tmp = $_FILES['category_image']['tmp_name'];

        $category_image_type = $_FILES['category_image']['type'];

        // for Duplicate category
        if($id=='') 
        {
            $query = "SELECT * FROM category WHERE category_name = '$category_name'";
        }
        else
        {
            $query = "SELECT * FROM category WHERE category_name = '$category_name' AND category_id != '$id' ";
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
                if ($category_image_type != 'image/jpeg' && $category_image_type != 'image/png') 
                {
                    $msg = "Please check it, Image type is not reqired!";
                }
                else
                {
                    // insert category and image
                    $query_insert = "INSERT INTO category (category_name,category_image,status) VALUES ('$category_name','$category_image',1)";

                    $result_ins = mysqli_query($conn, $query_insert);

                    // updoad image seleted folder
                    move_uploaded_file($category_image_tmp,UPLOAD_IMAGE.'/category/'.$category_image);

                    redirect('category.php');
                }
            }
            // if ID is not eqal to NULL , execute update query 
            else
            {
                // Other dateils is update and image not update
                if ($category_image == '') 
                {
                    $category_image = $category_image_get;

                    $query_update = "UPDATE category SET category_name='$category_name', category_image='$category_image' WHERE category_id = '$id' ";

                    mysqli_query($conn, $query_update);

                    redirect('category.php');
                }
                // update all details
                else
                {
                    // image type error msg
                    if ($category_image_type != "image/jpeg" && $category_image_type != "image/png") 
                    {
                        $msg = "Please check it, Image type is not reqired!";
                    }
                    else
                    {
                        // old image remove from folder
                        $old_image = $category_image_get;

                        unlink(UPLOAD_IMAGE."/category/".$old_image); //file remove function

                        // update category and image
                        $query_update = "UPDATE category SET category_name='$category_name', category_image='$category_image' WHERE category_id = '$id' ";

                        mysqli_query($conn, $query_update);

                        // updoad image seleted folder
                        move_uploaded_file($category_image_tmp,UPLOAD_IMAGE.'/category/'.$category_image);

                        redirect('category.php');
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
            $content_title = 'Add New Category' ;
        }
        else
        {
            $content_title = 'Update Category' ;
        }
    ?>
    <!-- Menu Button -->
    <button class="menu-btn">&#9776; Menu</button>    
    <a href="index.php" class="mx-3 text-decoration-none">Dashbord</a>/<a href="category.php" class="mx-3 text-decoration-none">Category Manage</a>/<a href="category_manage.php" class="mx-3 text-decoration-none"><?php echo $content_title ?></a>
      
    <div class="container border rounded-3 p-4 mt-4 mb-4">
        <div class="row">
            <div class="col-sm-8 offset-2">
            
            <h3><?php echo $content_title; ?></h3>
                <form method="post" enctype="multipart/form-data">
                <div class="form-group mt-2 mb-2 text-danger" >
                        <h5><?php echo $msg; ?></h5>
                    </div>
                    <!-- category -->
                    <div class="form-group">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" name="category_name" class="form-control mb-2" value="<?php echo $category_name ?>" required>
                    </div>
                    <!-- category image -->
                    <div class="form-group">
                        <label for="category_image" class="form-label">Category Image</label>
                        <input type="file" name="category_image" class="form-control mb-2" value="<?php echo $category_image ?>" >
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn bg-primary col-sm-5 text-white  mt-3" required><?php echo $content_title ?></button>
                    </div>
                </form>    
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>