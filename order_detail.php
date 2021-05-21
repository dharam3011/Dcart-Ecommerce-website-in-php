<?php

// page title
$page_title = 'Order Details';

// header file
include 'header.php';

// get Order Id from url
if (isset($_GET['orderId']) && $_GET['orderId'] != "") 
{
    $id = get_safe_value(urldecode(base64_decode($_GET['orderId'])));

    $order_date = get_safe_value(urldecode(base64_decode($_GET['addedon'])));
    
    $order_id = ($id/12345);
}
?>
    <div class="container-md mt-3 content " >
        <a href="index.php" class="text-decoration-none">Home</a> ><a href="myorder.php" class="text-decoration-none">My-Order</a> ><a href="order_detail.php" class="text-decoration-none">Order Detail</a>
    </div>
    <div class="container-md mt-3 mb-5" style="min-height:412px">
        <h2 class="mb-3">Order Details</h2>
        <div class="d-md-flex">
            <h6 class="me-4">PLACE ORDER : <small><?php echo get_date($order_date);?></small></h6>
            
            <h6 class="me-4">Order Id : <small><?php echo $order_id;?></small> </h6>
        </div>
        <!-- horizontal line -->
        <div class="product-hr"></div>
        <!-- card -->
        <div class="product-card mb-4">
            <div class="product-card-body">
                <div class="row">
                    <!-- show address -->
                    <?php 
                        $user_id = $_SESSION['user_id'];

                        $query_select_order = "SELECT `order`.*, address.*, order_status.* FROM `order` 
                                                INNER JOIN address ON (order.address_id = address.address_id) 
                                                INNER JOIN order_status ON (order.order_status = order_status.order_status_id)  
                                                WHERE `order`.order_id = '$order_id' ";

                        $result_select_order = mysqli_query($conn,$query_select_order);

                        while ($row_order = mysqli_fetch_assoc($result_select_order)) 
                        {
                    ?>
                    <div class="col-md-4">
                        <h5 class="product-card-title">Shpping address</h5>
                        <input type="hidden" id="selectAddress" value="<?php echo $row_order['address_id'] ?>">
                        <p class="product-card-title mb-2"><?php echo $row_order['fname'].' '.$row_order['lname']; ?></p>
                        <p class="product-card-text"><?php echo $row_order['address_1']; ?></p>
                        <p class="product-card-text"><?php echo $row_order['address_2']; ?></p>
                        <p class="product-card-text"><?php echo $row_order['city'].', '.$row_order['pin']; ?></p>
                        <p class="product-card-text"><?php echo $row_order['state'].', '.$row_order['country']; ?></p>
                        <p class="product-card-text">Mobile : <?php echo $row_order['mobile']; ?></p>      
                    </div>
                    <!-- Payment Method -->
                    <div class="col-md-4">
                        <h5>Payment Method</h5>
                        <h6><?php 
                                if ($row_order['payment_type'] == 'COD') 
                                {
                                    echo $row_order['payment_type'].' <span class="text-muted">(Case on Delivery)</span>';
                                }
                                else 
                                {
                                    echo $row_order['payment_type'];
                                }
                         ?></h6>
                    </div>
                    <!-- Order Summary -->
                    <div class="col-md-3">
                        <h5 >Order Summary</h5>
                        <ul class="list-group">
                            <li class="list-unstlyed d-flex justify-content-between ">
                                <h6>Total Item : </h6>
                                <strong><?php echo $row_order['total_item']; ?></strong>
                            </li>
                            <li class="list-unstlyed d-flex justify-content-between ">
                                <h6>sub-Total :</h6>
                                <strong><?php echo $row_order['total_price']; ?> ₹</strong>
                            </li>
                            <li class="list-unstlyed d-flex justify-content-between ">
                                <h6>Shiping Charge :</h6>
                                <strong><?php echo $row_order['delivery_charge']; ?> ₹</strong>
                            </li>
                            <div class="product-hr"></div>
                            <li class="list-unstlyed d-flex justify-content-between ">
                                <h5>Total :</h5>
                                <strong><h5><?php echo $row_order['grand_total']; ?> ₹</h5></strong>
                            </li>
                        </ul>
                    </div>
                </div>    
            </div>
        </div>
        <div class="product-card">
            <div class="product-card-body">
                <?php if ($row_order['delivery_date'] != '0000-00-00 00:00:00') 
                {
                    ?>
                        <h4 class="product-card-title mb-3">Deliverd To : <?php get_date_time($row_order['delivery_date'])?></h4>
                    <?php
                } 
                else
                {
                    ?>
                        <h4 class="product-card-title mb-3">Aprox delivery in 5-7 Days</h4>
                    <?php
                }
                ?>
                
            <?php
                }
                // order detais
                    $query_select_order_detail = "SELECT order_detail.*, product.product_name, product.product_price, product.product_image FROM order_detail INNER JOIN product ON product.product_id = order_detail.product_id WHERE order_id = '$order_id'";

                    $result_select_order_detail = mysqli_query($conn,$query_select_order_detail);

                    while ($row_order_detail = mysqli_fetch_assoc($result_select_order_detail)) 
                    {
                ?>
                <div class="product-hr"></div>
                <div class="row">
                    <div class="col-md-3">
                        <img src="images/<?php echo $row_order_detail['product_image'] ?>" alt="" class="border" width="150" height="150">
                    </div>
                    <div class="col-md-9">
                        <h5 class="mb-3"><a href="#" class="text-decoration-none"><?php echo $row_order_detail['product_name'] ?></a></h5>
                        <h6 class="mb-3">Price : <?php echo $row_order_detail['product_price'] ?></h6>
                        <h6 class="mb-3">Qty : <?php echo $row_order_detail['qty'] ?></h6>
                        <a href="" class="btn btn-primary">Buy again</a>
                    </div>
                </div>
                <?php 
                    }
                ?>
            </div>
        </div>
    </div>

<?php include 'footer.php'; ?>