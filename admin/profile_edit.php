<?php 

    include '../conn.php';

    include '../function.php';

    $email = $_SESSION['email_admin'];

    $old_profile = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image, name FROM admin WHERE email = '$email'"));

    $old_img = $old_profile['image'];    

    if (isset($_POST['removeProfile'])) 
    {
        if ($image != 'placeholder.png' && $old_img != '') 
        {
            unlink(UPLOAD_IMAGE.'/profile/'.$old_img);
        }

        $query_remove_profile = "UPDATE admin SET image = 'placeholder.png', name = '$name' WHERE email = '$email'";

        $result_remove_profile = mysqli_query($conn, $query_remove_profile);
    }
?>