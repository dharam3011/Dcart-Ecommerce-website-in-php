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

    $type = "";

    if (isset($_SESSION['email_user'])) {
        redirect('index.php');
    }

    // get type into url because after login cart's paroduct direct store in database
    if(isset($_GET['type']) && $_GET['type'] != '')
    {
      $type = urldecode(base64_decode($_GET['type']));
    }

    //POST Method
    if (isset($_POST['login'])) 
    {
        
        $username = get_safe_value($_POST['username']);

        $password = get_safe_value(md5($_POST['password']));

        // Validation
        if (empty($username) && empty($password)) { $msg = "Please required the all field"; }

           
        $query_select = "SELECT * FROM user WHERE (username = '$username' OR email = '$username' OR mobile = '$username') AND password = '$password' AND status = 1 ";

        $result_select = mysqli_query($conn, $query_select);

        if (mysqli_num_rows($result_select)) 
        {

            $row = mysqli_fetch_assoc($result_select);

            $email = $row['email'];

            $_SESSION['email_user'] = $row['email'];

            $_SESSION['user_id'] = $row['id'];

            if ($type == 'checkout') 
            {
                redirect('checkout.php');
            }
            else
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
                    $mail->Subject = 'Dcart login varification';
                    $mail->Body = "<b>ThankYou for sign-in.</b> Are you Dcart user?
                                    <div style='display:flex; margin:10px 0 10px 0'>
                                        <h4 style='margin:0 10px 0 10px; color:green'><a href='http://localhost/Dcart/index.php' role='button' class='btn btn-outline-success'>Yes, I'm</a></h4>
                                        <h4 style='margin:0 10px 0 10px; color:red'><a href='http://localhost/Dcart/logout.php' role='button' class='btn btn-outline-success'>No, I am not</a></h4>
                                    </div> ";
                
                    $mail->send();
                    echo "<script>alert('Please check your email and varify your account')</script>";
                    
                    redirect('index.php');

                } catch (Exception $e){
                    echo "<script>alert('".$e->getMessage()."')</script>";
                }
            }
        }
        else 
        {
            
            $msg = "Username OR Password not metch, Please check it!";

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

    <title>Login | <?php echo WEBSITE_NAME ?></title>
  </head>
  <body>
  <div class="container mt-5">
        <div class="row">
            <div class="text-center">
                <?php include 'logo.php';?>
            </div>
            <div class="col-sm-6 offset-3 p-4 border rounded-3">
            
            <div>
                <h3>Login Account</h3>
                <h5 class="text-danger"><?php echo $msg; ?></h5>
            </div>
                <form method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email/Username/Mobile</label>
                        <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" autocomplete="">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" autocomplete="">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="checkpassword">
                        <label class="form-check-label" for="exampleCheck1">Show Password</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" name='login' class="btn btn-primary col-sm-3">Login</button>
                </form>
                <div class="mt-4">
                    <a href="forgot_password.php">Forgot Password?</a>
                </div>
                <div class="mt-4">
                    <span>If new User? </span><a href="registration.php" class="btn bg-primary text-white" role="button">Create New Account</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){

            // password hide and show
            $('#checkpassword').on('click',function(){
                var x = $('#password').attr('type');
                
                if (x == 'password') {
                        x = $('#password').attr('type','text');
                }
                else
                {
                    x = $('#password').attr('type','password');
                }
            });

        })
    </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

</body>
</html>
