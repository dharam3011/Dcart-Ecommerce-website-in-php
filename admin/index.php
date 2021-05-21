<?php 

// Page title
$page_title = 'Dashbord-admin';

// Header file
include 'top.php' ?>

<!-- Your Content -->
<div id="container">
    <!-- Menu Button -->
    <button class="menu-btn">&#9776; Menu</button>    
    <a href="index.php" class="mx-3 text-decoration-none">Dashbord</a>/            

    <div class="container mt-3">
    <div class="row">
        <!-- today sale -->
        <div class="col-sm-4 mb-4">
            <div class="card bg-light">
                <div class="row">
                    <div class="col-4 d-flex justify-content-lg-center align-items-center" >
                        <i class="fa fa-shopping-cart text-info" style="font-size:36px"></i>
                    </div>
                    <div class="col-8">
                        <div class="card-body ">
                        <?php 
                            $date = date_default_timezone_set('Asia/Kolkata');

                            $today = date("Y-m-d G:i:s");

                            $result_salse_today = mysqli_query($conn, "SELECT * FROM `order` WHERE order_date = '$today' AND payment_type != 'paymentGetway' ");
                        ?>
                            <h4 class="card-title text-left"><strong><?php echo mysqli_num_rows($result_salse_today) ?></strong></h4>
                            <h6 class="card-title text-left">Sales Today</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- total sales -->
        <div class="col-sm-4 mb-4">
            <div class="card bg-light ">
                <div class="row">
                    <div class="col-4 d-flex justify-content-lg-center align-items-center">
                        <i class="fa fa-shopping-cart text-secondary" style="font-size:36px"></i>
                    </div>
                    <div class="col-8 ">
                        <div class="card-body ">
                        <?php 
                            $result_total_salse = mysqli_query($conn, "SELECT * FROM `order` WHERE payment_type != 'paymentGetway' ");
                        ?>
                            <h4 class="card-title text-left"><strong><?php echo mysqli_num_rows($result_total_salse) ?></strong></h4>
                            <h6 class="card-title text-left">Total Sales</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- totla Earning -->
        <div class="col-sm-4 mb-4">
            <div class="card bg-light">
                <div class="row">
                    <div class="col-4 d-flex justify-content-lg-center align-items-center">
                        <i class="fas fa-rupee-sign fa-fw text-success" style="font-size:36px"></i>
                    </div>
                    <div class="col-8 ">
                        <div class="card-body ">
                        <?php 
                         $total = 0;
                            $result_total_earning = mysqli_query($conn, "SELECT * FROM `order` WHERE payment_status = 'Success' AND payment_type != 'paymentGetway' ");

                            while($row = mysqli_fetch_assoc($result_total_earning))
                            {
                                $total = $total + $row['grand_total'];
                            }
                        ?>
                            <h4 class="card-title text-left"><strong><?php echo $total ?></strong></h4>
                        <?php
                            
                        ?>
                            <h6 class="card-title text-left">Total Earning</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- panding order -->
        <div class="col-sm-4 mb-4">
            <div class="card bg-light">
                <div class="row">
                    <div class="col-4 d-flex justify-content-lg-center align-items-center">
                        <i class="fa fa-shopping-bag fa-fw text-danger" style="font-size:36px"></i>
                    </div>
                    <div class="col-8 ">
                        <div class="card-body ">
                        <?php 
                            $result_pending_order = mysqli_query($conn, "SELECT `order`.*, order_status.order_status FROM `order` INNER JOIN order_status ON `order`.order_status = order_status.order_status_id WHERE payment_status = 'Success' AND order_status.order_status = 'pending' ");
                        ?>
                            <h4 class="card-title text-left"><strong><?php echo mysqli_num_rows($result_pending_order) ?></strong></h4>
                            <h6 class="card-title text-left">Pending Orders</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- total product -->
        <div class="col-sm-4 mb-4">
            <div class="card bg-light">
                <div class="row">
                    <div class="col-4 d-flex justify-content-lg-center align-items-center" >
                        <i class="fab fa-product-hunt fa-fw text-warning" style="font-size:36px"></i>
                    </div>
                    <div class="col-8 ">
                        <div class="card-body ">
                        <?php 
                            $result_total_product = mysqli_query($conn, "SELECT * FROM product");
                        ?>
                            <h4 class="card-title text-left"><strong><?php echo mysqli_num_rows($result_total_product) ?></strong></h4>
                            <h6 class="card-title text-left">Total Products</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  user -->
        <div class="col-sm-4 mb-4">
            <div class="card bg-light">
                <div class="row">
                    <div class="col-4 d-flex justify-content-lg-center align-items-center" >
                        <i class="fa fa-user fa-fw text-info" style="font-size:36px"></i>
                    </div>
                    <div class="col-8 ">
                        <div class="card-body ">
                        <?php 
                            $result_total_user = mysqli_query($conn, "SELECT * FROM user");
                        ?>
                            <h4 class="card-title text-left"><strong><?php echo mysqli_num_rows($result_total_user) ?></strong></h4>
                            <h6 class="card-title text-left">Users</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- chart script -->
    <div class="mt-3 mb-3">
        <!-- <h3>Monthly Sales Chart</h3> -->
        <div id="chartContainer" style="height: 300px; width: 1100px;"></div>
    </div>
</div>

<script>
    <?php 
      $date = date_default_timezone_set('Asia/Kolkata');
      $thisyear = date("Y");
      
    ?>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Monthly Sales"
	},
	axisY: {
		title: "Sales"
	},
	data: [{        
		type: "column",  
		showInLegend: true, 
		legendMarkerColor: "grey",
		legendText: "Months",
		dataPoints: [      
      
			{ y: <?php echo  mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `order` WHERE payment_status = 'Success' AND payment_type != 'paymentGetway' AND DATE_FORMAT(order_date, '%Y-%M') = DATE_FORMAT('$thisyear-01-00 00:00:00', '%Y-%M') ")); ?>, label: "Jan" },
			{ y: <?php echo  mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `order` WHERE payment_status = 'Success' AND payment_type != 'paymentGetway' AND DATE_FORMAT(order_date, '%Y-%M') = DATE_FORMAT('$thisyear-02-00 00:00:00', '%Y-%M') ")); ?>,  label: "Feb" },
			{ y: <?php echo  mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `order` WHERE payment_status = 'Success' AND payment_type != 'paymentGetway' AND DATE_FORMAT(order_date, '%Y-%M') = DATE_FORMAT('$thisyear-03-00 00:00:00', '%Y-%M') ")); ?>,  label: "Mar" },
			{ y: <?php echo  mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `order` WHERE payment_status = 'Success' AND payment_type != 'paymentGetway' AND DATE_FORMAT(order_date, '%Y-%M') = DATE_FORMAT('$thisyear-04-00 00:00:00', '%Y-%M') ")); ?>,  label: "Apr" },
			{ y: <?php echo  mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `order` WHERE payment_status = 'Success' AND payment_type != 'paymentGetway' AND DATE_FORMAT(order_date, '%Y-%M') = DATE_FORMAT('$thisyear-05-00 00:00:00', '%Y-%M') ")); ?>,  label: "May" },
			{ y: <?php echo  mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `order` WHERE payment_status = 'Success' AND payment_type != 'paymentGetway' AND DATE_FORMAT(order_date, '%Y-%M') = DATE_FORMAT('$thisyear-06-00 00:00:00', '%Y-%M') ")); ?>, label: "Jun" },
			{ y: <?php echo  mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `order` WHERE payment_status = 'Success' AND payment_type != 'paymentGetway' AND DATE_FORMAT(order_date, '%Y-%M') = DATE_FORMAT('$thisyear-07-00 00:00:00', '%Y-%M') ")); ?>,  label: "Jul" },
			{ y: <?php echo  mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `order` WHERE payment_status = 'Success' AND payment_type != 'paymentGetway' AND DATE_FORMAT(order_date, '%Y-%M') = DATE_FORMAT('$thisyear-08-00 00:00:00', '%Y-%M') ")); ?>,  label: "Aug" },
            { y: <?php echo  mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `order` WHERE payment_status = 'Success' AND payment_type != 'paymentGetway' AND DATE_FORMAT(order_date, '%Y-%M') = DATE_FORMAT('$thisyear-09-00 00:00:00', '%Y-%M') ")); ?>,  label: "Sep" },
            { y: <?php echo  mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `order` WHERE payment_status = 'Success' AND payment_type != 'paymentGetway' AND DATE_FORMAT(order_date, '%Y-%M') = DATE_FORMAT('$thisyear-10-00 00:00:00', '%Y-%M') ")); ?>,  label: "Oct" },
            { y: <?php echo  mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `order` WHERE payment_status = 'Success' AND payment_type != 'paymentGetway' AND DATE_FORMAT(order_date, '%Y-%M') = DATE_FORMAT('$thisyear-11-00 00:00:00', '%Y-%M') ")); ?>,  label: "Nov" },
            { y: <?php echo  mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `order` WHERE payment_status = 'Success' AND payment_type != 'paymentGetway' AND DATE_FORMAT(order_date, '%Y-%M') = DATE_FORMAT('$thisyear-12-00 00:00:00', '%Y-%M') ")); ?>,  label: "Dec" },
		]
	}]
});
chart.render();

}
</script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<?php include 'footer.php' ?>