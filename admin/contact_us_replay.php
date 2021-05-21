<?php 

    // page title
    $page_title = 'Add Category-Admin' ;

    // header file
    include 'top.php'; 

    // SMTP connection
    use PHPMailer\phpmailer\PHPMailer;
    
    require_once '../PHPMailer/phpmailer/Exception.php';
    require_once '../PHPMailer/phpmailer/PHPMailer.php';
    require_once '../PHPMailer/phpmailer/SMTP.php';

    // null variable
    $name = '';
    $mobile = '';
    $email = '';
    $message = '';
    $id = '';
    $msg = '';

    // get id for upadate
    if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] != '') 
    {
        $id = get_safe_value($_GET['id']);
        
        $query_select = "SELECT * FROM contact_us WHERE contact_id = '$id' ";

        $result_select = mysqli_query($conn, $query_select);

        $row_get = mysqli_fetch_assoc($result_select);

        $name = get_safe_value($row_get['name']); ;

        $mobile = get_safe_value($row_get['mobile']); ;

        $email = get_safe_value($row_get['email']); ;

        $message = $row_get['message']; ;
            
    }else{
        redirect('logout_admin.php');
    }

    if (isset($_POST['submit'])) 
    {
        $name = get_safe_value($_POST['name']);
        $mobile = get_safe_value($_POST['mobile']);
        $email = get_safe_value($_POST['email']);
        $message = str_replace("\n", '<br />', $_POST['message']);

        $mail = new PHPMailer(true);

        try{
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'dcart0509@gmail.com';
            $mail->Password = '@Shopping@0509';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = '587';
    
            $mail->setFrom('dcart0509@gmal.com');
            $mail->addAddress($email);
    
            $mail->isHTML(true);
            $mail->Subject = 'Dcart account varification';
            $mail->Body = $message;
    
            $mail->send();
           
            echo "<script>alert('Message successfully placed.')</script>";
         
            $query_update = "UPDATE contact_us SET status = 1 WHERE contact_id = $id ";
            
            $result_update = mysqli_query($conn,$query_update);

            if ($result_update) 
            {
                redirect('contact_us.php');
            }
            else
            {
                redirect('contact_us.php');
            }
                
        }
        catch (Exception $e){
            echo "<script>alert('".$e->getMessage()."')</script>";
        }        
    }
?>
    
<!-- Your Content -->
<div id="container">
            
    <!-- Menu Button -->
    <button class="menu-btn">&#9776; Menu</button>    
    <a href="index.php" class="mx-3 text-decoration-none">Dashbord</a>/ <a href="contact_us.php" class="mx-3 text-decoration-none">Contact-us</a>/
        
    <div class="container border rounded-3 p-4 mt-4 mb-4">
        <div class="row">
            <div class="col-sm-8 offset-2">
            <h3>Message Replay</h3>
                <form method="post" enctype="multipart/form-data">
                <div class="form-group mt-2 mb-2 text-danger" >
                        <h5><?php echo $msg; ?></h5>
                    </div>
                
                    <div class="form-group">
                        <label for="category_name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control mb-2" value="<?php echo $name ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="category_name" class="form-label">Mobile</label>
                        <input type="text" name="mobile" class="form-control mb-2" value="<?php echo $mobile ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="category_name" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control mb-2" value="<?php echo $email ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="category_name" class="form-label">Message</label>
                        
                        <textarea type="text" name="message" class="form-control mb-2"  rows="10"  required></textarea>
                    </div>
                
                    <div class="form-group">
                        
                        <button type="submit" name="submit" class="btn bg-primary col-sm-5 text-white  mt-3" required>Send Message</button>

                    </div>
                    
                </form>    
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>