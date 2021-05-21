
<?php 

    // page title
    $page_title = 'Profile-Admin';

    // header file
    include 'top.php';

    $msg ='';

    $email = $_SESSION['email_admin'];

    $old_profile = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image, name FROM admin WHERE email = '$email'"));

    $old_img = $old_profile['image'];    

    if (isset($_POST['submit'])) 
    {
        $name =  $_POST['name'];

        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_type = $_FILES['image']['type'];

        
        if ($image == '') 
        {
            $query_update_profile = "UPDATE admin SET image = '$old_img', name = '$name' WHERE email = '$email'";

            $result_update_profile = mysqli_query($conn, $query_update_profile);

            move_uploaded_file($image_tmp,UPLOAD_IMAGE.'/profile/'.$image);
        }
        else
        {

            if ($image_type != 'image/jpeg' && $image_type != 'image/png') 
            {
                $msg = "Image type not required!";
            }
            else
            {
                if ($image != 'placeholder.png' && $old_img != '') 
                {
                    unlink(UPLOAD_IMAGE.'/profile/'.$old_img);
                }

                $query_update_profile = "UPDATE admin SET image = '$image', name = '$name' WHERE email = '$email'";

                $result_update_profile = mysqli_query($conn, $query_update_profile);

                move_uploaded_file($image_tmp,UPLOAD_IMAGE.'/profile/'.$image);
            }
        }
    }

    $query_select_profile = "SELECT image, name FROM admin WHERE email = '$email'";

    $result_select_profile = mysqli_query($conn, $query_select_profile);

    $row_profile = mysqli_fetch_assoc($result_select_profile);          
        
?>

<div id="container">
<!-- Menu Button -->
<button class="menu-btn">&#9776; Menu</button>    
    <a href="index.php" class="mx-3 text-decoration-none">Dashbord</a>/<a href="profile.php" class="mx-3 text-decoration-none">Profile</a>/
<div class="container ">
        <div class="row">
            
            <div class="col-sm-5 offset-3 p-4 border rounded-3">
            
            <div>
                <h3 class="text-center">Edit Profile</h3>
                <h5><span class="text-danger"><?php echo $msg ?></span></h5>
            </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <div class="profile d-flex justify-content-lg-center image">
                            <img src="../images/profile/<?php echo $row_profile['image'] ?>" id="profileDisplay"  >
                        </div>
                        <div class="d-flex justify-content-center">
                            <a class="btn  btn-outline-info mx-2" onclick="Click()">Edit</a>
                            <a class="btn  btn-outline-danger" onclick="removeProfile()">Remove</a>
                        </div>
                        <input type="file" name="image" class="my-2" id="profileImage" class="form-control" onchange="displayImage(this)"  style="display:none">            

                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input type="text" name="name" id class="form-control" placeholder="name" value="<?php echo $row_profile['name'] ?>">                        
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name='submit' class="btn btn-primary col-sm-5  createBtn" onclick="create()">Save Profile</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

<!-- profile change script -->
<script>
    
    function Click(){
        var x = document.getElementById("profileImage");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

</script>
<script>

function displayImage(f) {
           var filePath = $('#profileImage').val();
           var reader = new FileReader();
           reader.onload = function (e) {
               $('#profileDisplay').attr('src',e.target.result);
           };
           reader.readAsDataURL(f.files[0]);           
        }

        function removeProfile(){
            $.ajax({
                url : 'profile_edit.php',
                type : 'post',
                data : {
                    removeProfile : 'yes' ,
                },
                success : function(data){
                    window.location.href="profile.php"                    ;
                }
            });
        }
</script>
<?php include 'footer.php' ?>