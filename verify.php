<?php 

    // database connection
    include 'conn.php';

    // connect some function
    include 'function.php';

    
    if(isset($_POST['submit']))
    {
        $varify_otp = get_safe_value($_POST['v_otp']);
        
        $email = base64_decode($_SESSION['verify_email_user']);

        if ($varify_otp == $_SESSION['otp']) 
        {
            // forgot password verification
            if ($pg == 'forgot_password') 
            {
                unset($_SESSION['otp']);
                redirect('change_password_process.php');
            }

            // forgot password verification
            if ($pg == 'change_password') 
            {
                unset($_SESSION['otp']);
                redirect('change_password_process.php');
            }

            // registration verification
            if ($pg == 'registration') 
            {
                $result_update_status = mysqli_query($conn, "UPDATE user SET status = 1 WHERE email = '$email'");
                
                if($result_update_status)
                {
                    unset($_SESSION['verify_email_user']);
                    unset($_SESSION['otp']);
                    echo "<script>alert('Successfully create account, Now you can login')</script>";
                    redirect('login.php');
                }
            }
        }
        else
        {   
            echo "<script>alert('Somthing wrong!, please wait.. or Resand try after some time.')</script>";
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- External CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pushy.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <title><?php echo 'verify | '.WEBSITE_NAME ?></title>
  </head>
  <body>
  
  <div class="container mt-5">
        <div class="row">
            <div class="text-center">
                <?php include 'logo.php';?>
            </div>
            <div class="col-sm-4 offset-4 p-4 border rounded-3">
            
            <div>
                <h3>Varified Your Code</h3>
                <h5><span class="text-danger"><?php // echo $msg ?></span></h5>
            </div>
                <form method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">OTP</label>
                        <input type="text" name="v_otp" class="form-control" placeholder="Enter OTP">
                    </div>

                    <button type="submit" name='submit' class="btn btn-primary createBtn">Verify code</button>
                </form>
                <div class="d-flex justify-content-center mt-3">
                    <a href="resend_email.php" type="submit" role="button">Resend OTP</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

</body>
</html>
