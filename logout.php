<?php
    // connect database
    include 'conn.php';

    //connect function file
    include 'function.php';

    // database connection close
    mysqli_close($conn);

    // distory the all session
    session_destroy();

    redirect('index.php');
?>