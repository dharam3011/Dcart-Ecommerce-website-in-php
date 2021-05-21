<?php 

    // database connection
    include '../conn.php';

    // function file
    include '../function.php';

    // show order in one page
    $limit_par_page = 10;

    // crate page no
    if (isset($_POST['page_no'])) 
    {
        $page = $_POST['page_no'];
    }
    else
    {
        $page = 1;
    }

    // offset
    $offset = ($page-1)*$limit_par_page;

    $query_select_order = "SELECT `order`.*, address.*, order_status.* FROM `order` 
    INNER JOIN address ON (order.address_id = address.address_id) 
    INNER JOIN order_status ON (order.order_status = order_status.order_status_id)  
    WHERE `order`.payment_type != 'paymentGetway' ORDER BY order_id DESC LIMIT {$offset},{$limit_par_page} ";

    $result_select_order = mysqli_query($conn , $query_select_order);

    if (mysqli_num_rows($result_select_order) > 0) 
    {
?>

    <table class="table">
        <thead class="">
            <tr>
            <th>#</th>
            <th>Order Id</th>
            <th>Order Date</th>
            <th>Address</th>
            <th>Oredr Total Price</th>
            <th>Payment Type</th>
            <th>Payment Status</th>
            <th>Order Status</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody class="">
                <?php 
                    
                    $i = 1;

                    while($row_order = mysqli_fetch_assoc($result_select_order))
                    {
                ?>        
                    <tr>
                    <th scope="row"><?php echo $i; ?></th>
                    <!-- order id -->
                    <td><?php echo $row_order['order_id'] ?></td>
                    <!-- order date -->
                    <td><?php echo get_date($row_order['order_date']) ?></td>
                    <!-- address Dropdown -->
                    <td class="text-left">
                    <div class="myorder-dropdown">
                        <a href="#" class=" myorder-dropbtn" onmouseover="myorderDropdown(<?php echo $row_order['order_id']?>)">
                        <?php echo $row_order['fname'].' '.$row_order['lname']; ?>
                        </a>
                        <div id="myDropdown<?php echo $row_order['order_id'] ?>" class="myorder-dropdown-content" >
                            <p><?php echo $row_order['fname'].' '.$row_order['lname']; ?></p>
                            <p><?php echo $row_order['address_1'] ?></p>
                            <?php 
                                if ($row_order['address_2']) 
                                {
                            ?>
                                <p class="product-card-text"><?php echo $row_order['address_2']; ?></p>
                            <?php
                                } 
                            ?>
                            <p><?php echo $row_order['city'].', '.$row_order['state'].', '.$row_order['pin'];; ?></p>
                            <p><?php echo $row_order['country'] ?></p>
                            <p>Mobile : <?php echo $row_order['mobile'] ?></p>
                        </div>
                    </div>
                    </td>
                    <!-- total price -->
                    <td><strong><?php echo $row_order['grand_total'] ?> ₹</strong></td>
                    <!-- payment method -->
                    <td><?php echo $row_order['payment_type'] ?></td>
                    <!-- payment status -->
                    <td>
                    <?php
                            if ($row_order['payment_status'] == 'Success') 
                            {
                                ?>
                                    <strong class="text-success active"><?php echo $row_order['payment_status'] ?></strong>
                                <?php
                            }
                            elseif ($row_order['payment_status'] == 'failed') 
                            {
                                ?>
                                    <strong class="text-danger active"><?php echo $row_order['payment_status'] ?></strong>
                                <?php
                            }
                            else
                            {
                                ?>
                                    <strong class=" active"><?php echo $row_order['payment_status'] ?></strong>
                                <?php
                            }
                        ?>
                    </td>
                    <!-- order status -->
                    <td>
                        <?php
                            if ($row_order['order_status'] == 'complete') 
                            {
                                ?>
                                    <strong class="text-success active"><?php echo $row_order['order_status'] ?></strong>
                                <?php
                            }
                            elseif ($row_order['order_status'] == 'cancled') 
                            {
                                ?>
                                    <strong class="text-danger active"><?php echo $row_order['order_status'] ?></strong>
                                <?php
                            }
                            else
                            {
                                ?>
                                    <strong class=" active"><?php echo $row_order['order_status'] ?></strong>
                                <?php
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            $hrefDetails = 'order_detail_manage.php?orderId='.urlencode(base64_encode($row_order['order_id']*12345)).'&addedon='.urlencode(base64_encode($row_order['added_on']));
                        ?>   
                        <a href="<?php echo $hrefDetails;?>">View Order Deatils</a>
                    </td>
                    </tr>
                <?php
                        $i++;

                    }
                ?>
            </tbody>
        </table>
        <!-- <div classs="product-hr"></div> -->
        <!-- pagination button -->
        <div class="d-flex justify-content-center " id="pagination">
        <?php 
            $result_all_order = mysqli_query($conn, "SELECT * FROM `order` WHERE payment_type != 'paymentGetway'");

            $total_record = mysqli_num_rows($result_all_order);

            $total_page = ceil($total_record/$limit_par_page);
        ?>
        <ul class="pagination">
            <?php 
                // First and Previous page
                if ($page > 1) 
                {
                    ?>
                        <li class="page-item">
                            <a class="page-link" id="<?php echo $page_no = 1?>" href="">First</a>
                        </li>    
                        <li class="page-item">
                            <a class="page-link" id="<?php echo $page - 1?>" href="">Previous</a>
                        </li>    
                    <?php
                }
                // less then 10 page
                if ($total_page <= 10) 
                {
                    for ($i=1; $i <= $total_page; $i++) 
                    { 
                        if ($page == $i) 
                        {
                            $class = 'active';
                        }        
                        else
                        {
                            $class = '';
                        }
                        ?>
                            <li class="page-item <?php echo $class ?>">
                                <a class="page-link" id="<?php echo $i ?>" href=""><?php echo $i ?></a>
                            </li>
                        <?php
                    }    
                }
                //  greater then 10 page
                elseif ($total_page > 10) 
                {
                    // less then 4 page
                    if ($page <= 4) 
                    {
                        for ($i=1; $i < 8; $i++) 
                        { 
                            if ($page == $i) 
                            {
                                $class = 'active';
                            }        
                            else
                            {
                                $class = '';
                            }
                        ?>
                            <li class="page-item <?php echo $class;?>">
                                <a href="" class="page-link" id="<?php echo $i ?>"><?php echo $i ?></a>
                            </li>
                        <?php   
                        }
                        ?>
                        <li class="page-item ">
                            <a href="" class="page-link" id="">...</a>
                        </li>
                        <li class="page-item ">
                            <a href="" class="page-link" id="<?php echo $total_page - 1 ?>"><?php echo $total_page - 1 ?></a>
                        </li>
                        <li class="page-item ">
                            <a href="" class="page-link" id="<?php echo $total_page; ?>"><?php echo $total_page; ?></a>
                        </li>
                    <?php
                    }    
                    // greter then 4 page and less then total - 4 page
                    elseif ($page > 4 && $page < $total_page - 4) 
                    {
                    ?>
                        <li class="page-item ">
                            <a href="" class="page-link" id="<?php echo $page_no = 1 ?>">1</a>
                        </li>
                        <li class="page-item ">
                            <a href="" class="page-link" id="<?php echo $page_no = 2 ; ?>">2</a>
                        </li>
                        <li class="page-item ">
                            <a href="" class="page-link" id="">...</a>
                        </li>
                    <?php       
                        for ($i= $page - 2; $i < $page + 2; $i++) 
                        { 
                            if ($i == $page) 
                            {
                                $class = 'active';
                            }    
                            else
                            {
                                $class = '';
                            }
                        ?>
                            <li class="page-item <?php echo $class;?>">
                                <a href="" class="page-link" id="<?php echo $i ?>"><?php echo $i ?></a>
                            </li>
                        <?php
                        }
                        ?>
                        <li class="page-item ">
                            <a href="" class="page-link" id="">...</a>
                        </li>
                        <li class="page-item ">
                            <a href="" class="page-link" id="<?php echo $total_page - 1 ?>"><?php echo $total_page - 1 ?></a>
                        </li>
                        <li class="page-item ">
                            <a href="" class="page-link" id="<?php echo $total_page; ?>"><?php echo $total_page; ?></a>
                        </li>
                    <?php   
                    }
                    // Last 6 page
                    else
                    {
                    ?>
                        <li class="page-item ">
                            <a href="" class="page-link" id="<?php echo $page_no = 1 ?>">1</a>
                        </li>
                        <li class="page-item ">
                            <a href="" class="page-link" id="<?php echo $page_no = 2 ; ?>">2</a>
                        </li>
                        <li class="page-item ">
                            <a href="" class="page-link" id="">...</a>
                        </li>
                    <?php
                        for ($i = $total_page - 6; $i <= $total_page  ; $i++) 
                        { 
                            if ($i == $page) 
                            {
                                $class = 'active';
                            }    
                            else
                            {
                                $class = '';
                            }
                        ?>
                            <li class="page-item <?php echo $class;?>">
                                <a href="" class="page-link" id="<?php echo $i ?>"><?php echo $i ?></a>
                            </li>
                        <?php
                        }
                    }
                }
                // Last and Next page
                if ($total_page > $page) 
                {
                    ?>
                        <li class="page-item">
                            <a class="page-link" id="<?php echo $page + 1?>" href="">Next</a>
                        </li>    
                        <li class="page-item">
                            <a class="page-link" id="<?php echo $total_page ?>" href="">Last</a>
                        </li>    
                    <?php
                    }
                ?>
            </ul>
        </div>
    <?php
    }
    else
    {
        echo "<h3 class='mt-3'>No Record Found</h3>";
    }
    ?>