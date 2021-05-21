<?php

    // session
    session_start();

    // database connection
    $conn = mysqli_connect('localhost','root','','Dcart');

    if(!isset($conn))
    {
        echo "alert('Connection Failed')";
    }
    
    // Constant For Hedding of Website
    define('WEBSITE_NAME', 'Dcart');

    // Constant for images path (upload path)
    define('UPLOAD_IMAGE',$_SERVER['DOCUMENT_ROOT'].'/Dcart/images');

    // Constant for images path (display path)
    define('DISPLAY_IMAGE','http://localhost/Dcart/images');
?>
