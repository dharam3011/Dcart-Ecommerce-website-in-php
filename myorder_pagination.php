<?php

    // database connection
    include 'conn.php';

    // function file
    include 'function.php';

    $user_id = $_SESSION['user_id'];

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
                            WHERE `order`.user_id = '$user_id' AND (payment_status = 'success' OR ( payment_status = 'pending' AND payment_type = 'COD') ) ORDER BY order_id DESC LIMIT {$offset},{$limit_par_page} ";

    $result_select_order = mysqli_query($conn,$query_select_order);
    
    if (mysqli_num_rows($result_select_order) > 0) 
    {
        while ($row_order = mysqli_fetch_assoc($result_select_order)) 
        {
        ?>
        <div class="product-card mb-2">
            <div class="product-card-header ">
                <div class="d-md-flex justify-content-md-between">
                    <div class=" d-md-flex col-md-11">
                        <div class=" col-md-2 my-2">
                            <h6>ORDER ID</h6>        
                            <small><?php echo $row_order['order_id'] ?></small>
                        </div>
                        <div class="col-md-2 my-2">
                            <h6>ORDER DATE</h6>        
                            <small><?php echo get_date($row_order['order_date']); ?></small>
                        </div>
                        <div class=" col-md-1 my-2">
                            <h6>TOTAL</h6>        
                            <small><?php echo $row_order['grand_total'];?> ₹</small>
                        </div>
                        <div class="mx-2 col-md-2 my-2">
                            <h6>SHIP TO</h6>        
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
                        </div>
                        <div class="col-md-2 my-2">
                            <h6>ORDER STATUS</h6>        
                            <strong><?php echo $row_order['order_status'] ?></strong>
                        </div>
                        <div class=" col-md-2 my-2">
                            <h6>PAYMENT STATUS</h6>        
                            <?php 
                            
                                if ($row_order['payment_status'] == "Success") 
                                {
                                    $class = 'text-success';
                                }
                            ?>
                            <strong class="<?php echo $class ?>"><?php echo $row_order['payment_status'] ?></strong>
                        </div>
                    </div>
                    <div class="me-2 my-2 d-flex align-items-center">
                    <?php
                        // encode url date send by link
                        $hrefedit = 'order_detail.php?&orderId='.urlencode(base64_encode($row_order['order_id']*12345)).'&addedon='.urlencode(base64_encode($row_order['added_on'])) ;
                    ?>
                        <h6><a href="<?php echo $hrefedit; ?>">View Details</a></h6>        
                    </div>
                </div>
            </div>
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
                
                // order detais
                    $order_id = $row_order['order_id'];

                    $query_select_order_detail = "SELECT order_detail.*, product.product_name, product.product_image FROM order_detail INNER JOIN product ON product.product_id = order_detail.product_id WHERE order_id = '$order_id'";

                    $result_select_order_detail = mysqli_query($conn,$query_select_order_detail);

                    while ($row_order_detail = mysqli_fetch_assoc($result_select_order_detail)) 
                    {
                ?>
                <hr class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <img src="images/<?php echo $row_order_detail['product_image'] ?>" alt="" class="border" width="150" height="150">
                    </div>
                    <div class="col-md-9">
                    <?php 
                        $href = "product.php?product_id=".urlencode(base64_encode($row_order_detail['product_id']*1122334455));
                    ?>
                        <h5 class="mb-3"><a href="<?php echo $href; ?>" class="text-decoration-none"><?php echo $row_order_detail['product_image'] ?></a></h5>
                        <a href="<?php echo $href; ?>" class="btn btn-primary">Buy again</a>
                    </div>
                </div>
                <?php 
                    }
                ?>
            </div>
        </div>
        <?php 
            }
        ?>
        <div classs="product-hr"></div>
        <?php 
            $result_all_order = mysqli_query($conn, "SELECT * FROM `order` WHERE (payment_status = 'success' OR ( payment_status = 'pending' AND payment_type = 'COD') )");

            $total_record = mysqli_num_rows($result_all_order);

            $total_page = ceil($total_record/$limit_par_page);

        ?>
        <div class="d-flex justify-content-center mt-4" id="pagination">
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
    ?>
        <h3 class="text-center mt-3">No Record Found</h3>
    <?php
    }
    ?>
