<?php

// database connection
include 'conn.php';

// function file
include 'function.php';

$user_id = '';
$address_id = '';
$cod = '';
if(isset($_POST['address1']))
{
    $address_id = get_safe_value($_POST['address_id']);
    $fname = get_safe_value($_POST['fname']);
    $lname = get_safe_value($_POST['lname']);
    $address1 = get_safe_value($_POST['address1']);
    $address2 = get_safe_value($_POST['address2']);
    $mobile = get_safe_value($_POST['mobile']);
    $email = get_safe_value($_POST['email']);
    $city = get_safe_value($_POST['city']);
    $state = get_safe_value($_POST['state']);
    $country = get_safe_value($_POST['country']);
    $pin = get_safe_value($_POST['pin']);
    $user_id = $_SESSION['user_id'];
    // for Update adderss
    if ($address_id != '' ) 
    {
        
        $query_update = "UPDATE address SET fname='$fname',lname='$lname',address_1='$address1',address_2='$address2',mobile='$mobile',email='$email',city='$city',state='$state',country='$country',pin='$pin' WHERE address_id = '$address_id' ";

        $result_update = mysqli_query($conn,$query_update); 
        
        if($result_update){
            echo 'update address, Please check it!';
            
        }

    }
    // insert New address
    if($address_id == '' )
    {
        $result_select =mysqli_query($conn ,"SELECT * FROM address WHERE user_id = '$user_id' ORDER BY user_id ");

        $row = mysqli_num_rows($result_select);
        
        // 8 address limit, after that not save in database
        if ( $row > 0 && $row < 8) 
        {
            
            $query_insert = "INSERT INTO address (fname,lname,user_id,address_1,address_2,mobile,email,city,state,country,pin,status) VALUES ('$fname','$lname','$user_id','$address1','$address2','$mobile','$email','$city','$state','$country','$pin',1)";

            $result_insert = mysqli_query($conn,$query_insert);

            if ($result_insert) 
            {
                echo "Address successfully added";
            }    
        }
        else
        {
            echo 'First of all you are delete old address after that add new address!';
        }
        
    }
}

if (isset($_POST['payment_type'])) 
{
    if($_POST['payment_type'] = 'COD')
    {
        $_SESSION['payment_type'] = $_POST['payment_type'].'(Case on Delivery)';
    }
    if($_POST['payment_type'] = 'netbanking')
    {
        $_SESSION['payment_type'] = $_POST['payment_type'];
    }
    echo $_SESSION['payment_type'];
}

if (isset($_POST['address_id'])) 
{
    $_SESSION['address_id'] = $_POST['address_id'];

}


?>