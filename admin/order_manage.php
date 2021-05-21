<?php 

    // Page title
    $page_title = 'Order Master-Admin';

    // Header file
    include 'top.php' ;

    if (!isset($_SESSION['email_admin'])) 
    {
        redirect('login_admin.php');
    }
?>
<!-- Your Content -->
<div id="container">
    <!-- Menu Button -->
    <button class="menu-btn">&#9776; Menu</button>    
    <a href="index.php" class="mx-3 text-decoration-none">Dashbord</a>/<a href="order_manage.php" class="mx-3 text-decoration-none">Order Manage</a>
        
    <div class="container-fluid">
        <div class="sub-container">
        <h2 class="mt-2 me-4">Orders</h2>
            <!-- data pass to myorder_pagination page -->
            <div class="order-data">
                <!-- order data -->
            </div>
        </div>
    </div>
</div>

<script>
    // pagination
    $(document).ready(function(){
        function loadpage(page){
            $.ajax({
                url : 'order_manage_pagination.php',
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

<?php include 'footer.php' ?>