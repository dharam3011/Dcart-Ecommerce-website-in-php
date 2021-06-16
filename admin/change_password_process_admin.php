<?php 

    // database connection
    include '../conn.php';

    // connect some function
    include '../function.php';

    //  mail connection
    use PHPMailer\phpmailer\PHPMailer;

    require_once '../PHPMailer/phpmailer/Exception.php';
    require_once '../PHPMailer/phpmailer/PHPMailer.php';
    require_once '../PHPMailer/phpmailer/SMTP.php';

    $msg = "";

    $msg2 = "";

    if (isset($_SESSION['verify_email'])) 
    {
        //POST Method
        if (isset($_POST['submit'])) 
        {
            $password = get_safe_value(md5($_POST['password']));

            $cpassword = get_safe_value(md5($_POST['cpassword']));

            $email = base64_decode($_SESSION['verify_email']);

            // Validation
            if (empty($password)) 
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
                        $query_select = "SELECT * FROM admin WHERE email = '$email' ";

                        $result_select = mysqli_query($conn, $query_select);

                        if (mysqli_num_rows($result_select) > 0) 
                        {
                            $query_update = "UPDATE admin SET `password` = '$password' WHERE email = '$email'";

                            $result_update = mysqli_query($conn, $query_update);
                            
                            if ($result_update) 
                            {
                                $mail = new PHPMailer(true);
                            
                                try{
                                    $mail->isSMTP();
                                    $mail->Host = 'smtp.gmail.com';
                                    $mail->SMTPAuth = true;
                                    $mail->Username = 'youremail@gmail.com'; // Gmail address which you want to use as SMTP server
                                    $mail->Password = 'your email password'; // Gmail address Password
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                    $mail->Port = '587';
                                
                                    $mail->setFrom('youremail@gmail.com'); // Gmail address which you used as SMTP server
                                    $mail->addAddress($email); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)
                                
                                    $mail->isHTML(true);
                                    $mail->Subject = 'Dcart security alert';
                                    $mail->Body = "To authenticate, Your Password was changed.";
                                
                                    $mail->send();
                                    unset($_SESSION['verify_email']);
                                    echo "<script>alert('Your Password Was changed!')</script>";
                                    
                                    if(isset($_SESSION['email_admin']))
                                    {
                                        redirect('logout_admin.php');    
                                    }
                                    else
                                    {
                                        redirect('login_admin.php');
                                    }

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
                            echo "<script>Something wrong!, User are not metched.</script>";
                            redirect('forgot_password_admin.php');
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
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/pushy.css">

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

        <title><?php echo 'Change Password-Admin | '.WEBSITE_NAME ?></title>
    </head>
    <body>
    
    <div class="container mt-5 mb-5">
            <div class="row">
                <div class="text-center">
                    <?php include '../logo.php';?>
                </div>
                <div class="col-sm-6 offset-3 p-4 border rounded-3">
                
                <div>
                    <h3>Change Password</h3>
                    <h5 class="text-danger"><?php echo $msg; ?></h5>
                </div>
                    <form method="post">
                        
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control password" id="password" autocomplete="on">
                            <div id="emailError" class="form-text passwordError"><span>Passwords must be at least 6 characters.</span></div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                            <input type="password" name="cpassword" class="form-control password" id="Password" autocomplete="on">
                        </div>                    
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="checkpassword">
                            <label class="form-check-label" for="exampleCheck1">Show Password</label>
                        </div>
                        <button type="submit" name='submit' class="btn btn-primary col-sm-5 changeBtn">Change Password</button>
                    </form>
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
                        $('.changeBtn').attr('disabled', true);
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
<?php 
    }
    else
    {
        echo "<script>Something wrong!</script>";      
        redirect('Error.php');
    }
?>