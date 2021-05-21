<?php

// page title
$page_title = 'Order Details-Admin';

// header file
include 'top.php';

// get Order Id from url
if (isset($_GET['orderId']) && $_GET['orderId'] != "") 
{
    $id = get_safe_value(urldecode(base64_decode($_GET['orderId'])));

    $order_date = get_safe_value(urldecode(base64_decode($_GET['addedon'])));
    
    $order_id = ($id/12345);
}
// else
// {
    // 404 page error
// }
?>
    <!-- Your Content -->
<div id="container">
    <!-- Menu Button -->
    <button class="menu-btn">&#9776; Menu</button>    
    <a href="index.php" class="mx-3 text-decoration-none">Dashbord</a>/<a href="order_manage.php" class="mx-3 text-decoration-none">odrer Manage</a>/<a href="order_detail_manage.php" class="mx-3 text-decoration-none">odrer detail Manage</a>
    
    <div class="container-md mt-4 mb-5" style="min-height:412px">
        <h2 class="mb-3">Order Details</h2>
        <div class="d-md-flex">
            <h6 class="me-4">PLACE ORDER : <small><?php echo get_date($order_date);?></small></h6>
            
            <h6 class="me-4">Order Id : <small><?php echo $order_id;?></small> </h6>
        </div>
        <hr>

        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <!-- show address -->
                    <?php 

                        $query_select_order = "SELECT `order`.*, address.*, order_status.* FROM `order` 
                                                INNER JOIN address ON (order.address_id = address.address_id) 
                                                INNER JOIN order_status ON (order.order_status = order_status.order_status_id) WHERE `order`.order_id = '$order_id'";

                        $result_select_order = mysqli_query($conn,$query_select_order);

                        while ($row_order = mysqli_fetch_assoc($result_select_order)) 
                        {
                    ?>
                    <div class="col-md-3">
                        <h5 class="card-title">Shpping address</h5>
                        <input type="hidden" id="selectAddress" value="<?php echo $row_order['address_id'] ?>">
                        <p class="card-title mb-2"><?php echo $row_order['fname'].' '.$row_order['lname']; ?></p>
                        <p class="card-text"><?php echo $row_order['address_1']; ?></p>
                        <p class="card-text"><?php echo $row_order['address_2']; ?></p>
                        <p class="card-text"><?php echo $row_order['city'].', '.$row_order['pin']; ?></p>
                        <p class="card-text"><?php echo $row_order['state'].', '.$row_order['country']; ?></p>
                        <p class="card-text">Mobile : <?php echo $row_order['mobile']; ?></p>      
                    </div>
                    <!-- Payment Method -->
                    <div class="col-md-3">
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
                    <!-- Payment Method -->
                    <div class="col-md-3">
                        <h5>Order Status</h5>
                        <!-- <form action="../place_order.php"  method="post"> -->
                        <h6>
                            <?php 
                                $result_order_status = mysqli_query($conn, "SELECT * FROM order_status ORDER BY order_status_id");
                            ?>
                            <input type='hidden' name='order_id' id='order_id' value="<?php echo $row_order['order_id']; ?>">
                            <select name="order_status_id" id="order_status_id" class="form-select" onchange="updateOrderStatus()"  autocomplete="">
                                <option value=""><?php echo $row_order['order_status'] ?></option>
                            <?php
                                while ($row_order_status = mysqli_fetch_assoc($result_order_status)) 
                                {
                            ?>
                                    <option value="<?php echo $row_order_status['order_status_id'];?>"><?php echo $row_order_status['order_status'];?></option>       
                            <?php     
                                }
                            ?>
                            </select>    
                         </h6>
                         
                         </form>
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
                            <hr>
                            <li class="list-unstlyed d-flex justify-content-between ">
                                <h5>Total :</h5>
                                <strong><h5><?php echo $row_order['grand_total']; ?> ₹</h5></strong>
                            </li>
                        </ul>
                    </div>
                    <?php 
                        }
                    ?>
                </div>    
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-3">Delivered 23-04-2021</h4>
                <?php
                    $query_select_order_detail = "SELECT order_detail.*, product.product_name, product.product_price, product.product_image FROM order_detail INNER JOIN product ON product.product_id = order_detail.product_id WHERE order_id = '$order_id'";

                    $result_select_order_detail = mysqli_query($conn,$query_select_order_detail);

                    while ($row_order_detail = mysqli_fetch_assoc($result_select_order_detail)) 
                    {
                ?>
                <hr class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <img src="../images/<?php echo $row_order_detail['product_image'] ?>" alt="" class="border" width="150" height="150">
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
    <script >
        function update(){
            alert('hii');
        }
    </script>
    <!-- extranal JS -->
    <script src="../js/add.js"></script>
<?php include 'footer.php'; ?>