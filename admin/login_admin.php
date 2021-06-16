<?php 
    
    // database connection
    include '../conn.php';

    // function file
    include '../function.php';

    //  mail connection
    use PHPMailer\phpmailer\PHPMailer;

    require_once '../PHPMailer/phpmailer/Exception.php';
    require_once '../PHPMailer/phpmailer/PHPMailer.php';
    require_once '../PHPMailer/phpmailer/SMTP.php';

    //alrady sesion create
    if (isset($_SESSION['email_admin'])) {
        redirect('index.php');
      }

    //page title
    $page_title = "Login-Admin";
    
    // null variable
    $msg = '';

    //Post Method
    if (isset($_POST['login'])) 
    {
        $username = get_safe_value($_POST['username']);

        $password = get_safe_value(md5($_POST['password']));

        $query = "SELECT * FROM admin WHERE (username = '$username' OR email = '$username' OR mobile = '$username') AND password = '$password' AND status = 1 ";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);

            $email = $row['email'];

            $_SESSION['email_admin'] = $row['email'];
            
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
                    $mail->Body = "<b>ThankYou for sign-in.</b> Are you Dcart Logistics(seller)?
                                    <div style='display:flex; margin:10px 0 10px 0'>
                                        <h4 style='margin:0 10px 0 10px; color:green'><a href='http://localhost/Dcart/admin/index.php' role='button' class='btn btn-outline-success'>Yes, I'm</a></h4>
                                        <h4 style='margin:0 10px 0 10px; color:red'><a href='http://localhost/Dcart/admin/logout_admin.php' role='button' class='btn btn-outline-success'>No, I am not</a></h4>
                                    </div> ";
                
                    $mail->send();
                    echo "<script>alert('Please check your email and varify your account')</script>";
                    
                    redirect('index.php');

                } catch (Exception $e){
                    echo "<script>alert('".$e->getMessage()."')</script>";
                }
           
        }
        else{
            $msg = "Username or Password are not metched , Please check it!";
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

    <title><?php echo $page_title." | ".WEBSITE_NAME ; ?></title>
  </head>
  <body>
    
    <div class="container mt-5 mb-4">
        <div class="row">
            <div class="text-center">
                <?php include '../logo.php';?>
            </div>
            <div class="col-sm-6 offset-3 p-4 border rounded-3">
            
            <div>
                <h3>Login Associate Account</h3>
                <h5 class="text-danger"><?php echo $msg ?></h5>
            </div>
                <form method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email/Username/Mobile</label>
                        <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" autocomplete="on">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" autocomplete="on">
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
                    <a href="forgot_password_admin.php">Forgot Password?</a>
                </div>
                <div class="mt-4">
                    <span>New Associate?</span><a href="registration_admin.php" class="btn bg-primary text-white" role="button">Create New Account</a>
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

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
   
  </body>
</html>