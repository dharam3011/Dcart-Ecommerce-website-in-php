<?php

session_start();

include '../function.php';

if(isset($_SESSION['email_admin']))
{
    session_start();

    session_unset();

    redirect('login_admin.php');
}
else
{
    redirect('login_admin.php');
}

?>