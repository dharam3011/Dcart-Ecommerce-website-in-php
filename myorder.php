<?php

// page title
$page_title = 'My-Order';

// header file
include 'header.php';

if (!isset($_SESSION['email_user'])) 
{
    redirect('login.php');
}

?>
    <div class="container mt-2 mb-5 content" style="min-height:412px">
    <a href="index.php" class="text-decoration-none">Home</a> ><a href="myorder.php" class="text-decoration-none">My-Order</a> ><a href="order_detail.php" class="text-decoration-none">Order Detail</a>
        <div class="d-flex justify-content-between mt-1 ">
            <h2>My Order</h2> 
            <!-- total order -->
            <?php
                $total_order = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `order` WHERE (payment_status = 'success' OR ( payment_status = 'pending' AND payment_type = 'COD') )"));
            ?>
            <h5 class="my-2 mx-2">Total Order : <?php echo $total_order ?></h5>
        </div>
        <div class="product-hr"></div>
        
        <!-- data pass to myorder_pagination page -->
        <div class="order-data">
            <!-- order data -->
        </div>
        
        </div>
        
<!-- Extername JS -->
<!-- <script src="js/add.js"></script> -->
<script>
    // pagination
    $(document).ready(function(){
        function loadpage(page){
            $.ajax({
                url : 'myorder_pagination.php',
                type : 'post',
                data : {
                    page_no : page,
                },
                success : function(data) {
                    $('.order-data').html(data);
                }
            });
        }
        loadpage();
    
        // pagination button
        $(document).on('click','#pagination a',function(e){
            e.preventDefault();

            var page_no = $(this).attr('id');

            loadpage(page_no);
        });
    });
</script>
<?php include 'footer.php'; ?>