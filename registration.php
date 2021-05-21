<?php 

    // database connection
    include 'conn.php';

    // connect some function
    include 'function.php';

    //  mail connection
    use PHPMailer\phpmailer\PHPMailer;

    require_once 'PHPMailer/phpmailer/Exception.php';
    require_once 'PHPMailer/phpmailer/PHPMailer.php';
    require_once 'PHPMailer/phpmailer/SMTP.php';

    $msg = "";

    $msg2 = "";

    $alert = '';

    $red_val = '';

    //POST Method
    if (isset($_POST['submit'])) 
    {
        
        $name = get_safe_value($_POST['name']);

        $username = get_safe_value($_POST['username']);

        $mobile = get_safe_value($_POST['mobile']);

        $email = get_safe_value($_POST['email']);

        $password = get_safe_value(md5($_POST['password']));

        $cpassword = get_safe_value(md5($_POST['cpassword']));

        // Validation
        if ($name == '' || $username == '' || $mobile == '' || $email == '' || $password == '') 
        { 
            $msg = "Please required the all field"; 
        }
        else
        {
            // confirm password
            if ($password == $cpassword) 
            {
                if (strlen($password) > 5) 
                {
                    $query_select = "SELECT * FROM user WHERE username = '$username' OR email = '$email' OR mobile = '$mobile' ";

                    $result_select = mysqli_query($conn, $query_select);

                    if (!mysqli_num_rows($result_select)) 
                    {
                        $query_insert = "INSERT INTO user (name,username,mobile,email,password,image,status) VALUES ('$name','$username','$mobile','$email','$password','palceholde.png',1) ";

                        $result_insert = mysqli_query($conn, $query_insert);
                        
                        if ($result_insert) 
                        {
                            $otp = rand(111111,999999);

                            $_SESSION['otp'] = $otp; 

                            $_SESSION['verify_email'] = base64_encode($email);

                            $mail = new PHPMailer(true);
                        
                            try{
                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com';
                                $mail->SMTPAuth = true;
                                $mail->Username = 'dcart0509@gmail.com'; // Gmail address which you want to use as SMTP server
                                $mail->Password = '@Shopping@0509'; // Gmail address Password
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                $mail->Port = '587';
                            
                                $mail->setFrom('dcart0509@gmail.com'); // Gmail address which you used as SMTP server
                                $mail->addAddress($email); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)
                            
                                $mail->isHTML(true);
                                $mail->Subject = 'Dcart account varification';
                                $mail->Body = "To authenticate, please use the following One Time Password(OTP) :
                                                <h3> $otp </h3>
                                                Don't share this OTP with anyone. Our customer service tame  will never ask you for your password, OTP, any other details.<br>
                                                We hope to dee you again soon.";
                            
                                $mail->send();
                                echo "<script>alert('Please check your email and varify your account')</script>";
                                $pg = 'registration';
                                $href = "verify.php?pg=".urlencode(base64_encode($pg));
                                redirect($href);

                            } catch (Exception $e){
                                echo "<script>alert('".$e->getMessage()."')</script>";
                            }
                        }
                        else
                        {
                            echo "<script>Something wrong, Please try again after some time.</script>";
                        }
                    }
                    else 
                    {
                        $msg = "User already exist, Please caheck it!";
                    }

                }
                else 
                {
                    $msg = 'Passwords must be at least 6 characters.';
                }
            }
            else {
                $msg = 'Passwords are not metch';
            }
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

    <title><?php echo 'Registration | '.WEBSITE_NAME ?></title>
  </head>
  <body>
  
  <div class="container mt-5 registration-page">
        <div class="row">
            <div class="text-center">
                <?php include 'logo.php';?>
            </div>
            <div class="col-sm-6 offset-3 p-4 border rounded-3">
            
            <div>
                <h3>Create New User Account</h3>
                <h5><span class="text-danger"><?php echo $msg ?></span></h5>
            </div>
                <form method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" >
                        
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp">
                        
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Mobile</label>
                        <input type="text" name="mobile" class="form-control" id="mobile" aria-describedby="emailHelp">
                        
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" autocomplete="on">
                        <div id="" class="form-text ">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control password" id="password" autocomplete="on">
                        <div id="" class="form-text passwordError"><span>Passwords must be at least 6 characters or more</span></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                        <input type="password" name="cpassword" class="form-control password" id="cpassword" autocomplete="on">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="checkpassword">
                        <label class="form-check-label" for="exampleCheck1">Show Password</label>
                    </div>
                    
                    <button type="submit" name='submit' class="btn btn-primary col-sm-5 createBtn" onclick="create()">Create Account</button>
                </form>
                <div class="mt-4">
                <span>Already have an accoun? </span><a href="login.php">sign in</a>
                </div>
                <div class="mt-4">
                    <span>Bussiness with Ecom? </span><a href="admin/registration_admin.php" class="btn bg-primary text-white" role="button">Create New Bussiness Account</a>
                </div>
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function(){

            // password more then 5 charector
            $('#password').on('change',function(){
                var password = $('#password').val().length;    
                
                if (password <= 5) 
                {
                    $('.passwordError').html("<span class='text-danger'>Passwords must be at least 6 characters or more.</span>") ;
                    $('.createBtn').attr('disabled', true);
                }
                if (password > 5) 
                {
                    $('.passwordError').html("<span class=''>Passwords must be at least 6 characters or more.</span>") ;
                    $('.createBtn').attr('disabled', false);
                }
            });    

            // password hide and show
            $('#checkpassword').on('click',function(){
                var x = $('.password').attr('type');
                
                if (x == 'password') {
                     x = $('.password').attr('type','text');
                }
                else
                {
                    x = $('.password').attr('type','password');
                }
            });

        });
   </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

</body>
</html>
