<?php 

    // database connection
    include '../conn.php';

    // function file
    include '../function.php';

    // product limit in page 
    $limit_par_page = 10;

    if (isset($_POST['page_no'])) 
    {
        $page = $_POST['page_no'];
        
    }
    else
    {
        $page = 1;
        
    }

    $offset = ($page - 1) * $limit_par_page;
    
    $query_select_product = "SELECT product.*,sub_category.sub_category_name,category.category_name FROM product 
                                                INNER JOIN sub_category ON sub_category.sub_category_id = product.sub_category_id 
                                                INNER JOIN category ON category.category_id = product.category_id 
                                                ORDER BY product_id DESC LIMIT {$offset},{$limit_par_page} ";

    $result_select_product = mysqli_query($conn , $query_select_product);

    if (mysqli_num_rows($result_select_product) > 0) 
    {
        ?>
        <table class="table">
                    <thead class="text-center">
                        <tr>
                        <th scope="col" width='1%'>#</th>
                        <th scope="col"  width='6%'>Category</th>
                        <th scope="col"  width='6%'>Sub Category</th>
                        <th scope="col" width='13%'>Product Name</th>
                        <th scope="col" width='5%'>Product Price</th>
                        <th scope="col" width='5%'>Best Seller</th>
                        <th scope="col" width='25%'>Product Detail</th>
                        <th scope="col" width='10%'>Product Image</th>
                        <th scope="col" width='10%'>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php 
                                
                                $i = 1;

                                while($row = mysqli_fetch_assoc($result_select_product))
                                {
                            ?>        
                                <tr>
                                <th scope="row" class="text-center"><?php echo $i; ?></th>
                                <td  class="text-center"><?php echo $row['category_name'] ?></td>
                                <td  class="text-center"><?php echo $row['sub_category_name'] ?></td>
                                <td class="text-center"><?php echo $row['product_name'] ?></td>
                                <td class="text-center"><strong><?php echo $row['product_price'] ?> ₹</strong></td>
                                <td class="text-center">
                                    <?php if ($row['best_seller'] == 1) 
                                    {
                                        echo 'Yes';
                                    }
                                    else{
                                        echo 'No';
                                    } 
                                    ?>
                                </td>
                                <td><div class="details"><?php echo str_replace("\n", '<br />',  $row['product_detail']); ?></div></td>
                                <td class="text-center"><a target="_blank" href="<?php echo DISPLAY_IMAGE.'/'.$row['product_image']; ?>"><img src="<?php echo DISPLAY_IMAGE.'/'.$row['product_image']; ?>" style="width: 100px; height:100px;"></a></td>
                                <td class="text-center">
                                    <?php
                                        $type = "delete";
                                        $href1 = "product_manage.php?id=".urlencode(base64_encode($row['product_id']*1122334455));
                                        $href2 = "?id=".urlencode(base64_encode($row['product_id']*1122334455)).'&type='.urlencode(base64_encode($type));
                                    ?>
                                    <a href="<?php echo $href1; ?>" role="button" class="btn bg-primary my-2" >Edit</a>
                                    <a href="<?php echo $href2; ?>&type=delete" role="button" class="btn bg-danger my-2" >Delete</a>
                                </td>
                                </tr>
                            <?php
                                    $i++;
                                }
                            ?>
                    </tbody>
                </table>
                <!-- pagination button -->
                <div class="d-flex justify-content-center " id="pagination">
                <?php 
                    $result_select_all_product = mysqli_query($conn,"SELECT * FROM product");

                    $total_record = mysqli_num_rows($result_select_all_product);

                    $total_page = ceil($total_record/$limit_par_page);
                ?>
                    <nav aria-label="...">
                        <ul class="pagination">
                        <?php
                    
                            // First Page button
                            if ($page > 1) 
                            {
                        ?>
                                <li class="page-item ">
                                    <a class="page-link " href="" id="<?php  echo $page_no = 1 ;?>" aria-current="page" >First</a>
                                </li>
                                <li class="page-item ">
                                    <a class="page-link " href="" id="<?php echo ($page-1) ;?>" aria-current="page" >Privous</a>
                                </li>      
                        <?php
                            }
                            
                            // all page buttons
                            if ($total_page <= 10) 
                            {
                            
                                for ($i=1; $i <= $total_page; $i++) 
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
                                    <li class="page-item <?php echo $class; ?> ">
                                        <a class="page-link " href="" id="<?php echo $i;?>" aria-current="page" ><?php echo $i;?></a>
                                    </li>
                            <?php 
                                }
                            
                            }

                            if ($total_page > 10) 
                            {
                                if ($page <= 4) 
                                { 
                                    for ($i=1; $i <= 8; $i++) 
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
                                        <li class="page-item <?php echo $class; ?> ">
                                            <a class="page-link " href="" id="<?php echo $i;?>" aria-current="page" ><?php echo $i;?></a>
                                        </li>
                                <?php 
                                    }
                                ?>
                                    <li class="page-item <?php echo $class; ?> ">
                                        <a class="page-link " href="" id="" aria-current="page" >...</a>
                                    </li>
                                    <li class="page-item <?php echo $class; ?> ">
                                        <a class="page-link " href="" id="<?php echo $total_page - 1 ;?>" aria-current="page" ><?php echo $total_page - 1;?></a>
                                    </li>
                                    <li class="page-item <?php echo $class; ?> ">
                                        <a class="page-link " href="" id="<?php echo $total_page;?>" aria-current="page" ><?php echo $total_page;?></a>
                                    </li>
                                <?php
                                }
                            
                                elseif ($page > 4 && $page < $total_page - 4) 
                                {
                            ?>
                                    <li class="page-item <?php echo $class; ?> ">
                                        <a class="page-link " href="" id="<?php echo $page_no = 1?>" aria-current="page" > 1</a>
                                    </li>
                                    <li class="page-item <?php echo $class; ?> ">
                                        <a class="page-link " href="" id="<?php echo $page_no = 2 ;?>" aria-current="page" >2</a>
                                    </li>
                                    <li class="page-item <?php echo $class; ?> ">
                                        <a class="page-link " href="" id="" aria-current="page" >...</a>
                                    </li>
                                <?php

                                    for ($i = $page - 2; $i <= $page + 2 ; $i++) 
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
                                            <li class="page-item <?php echo $class; ?> ">
                                                <a class="page-link <?php echo $class?>" href="" id="<?php echo $i;?>" aria-current="page" ><?php echo $i;?></a>
                                            </li>
                                    <?php 
                                        
                                    }
                                    ?>
                                        <li class="page-item <?php echo $class; ?> ">
                                            <a class="page-link " href="" id="" aria-current="page" >...</a>
                                        </li>
                                        <li class="page-item <?php echo $class; ?> ">
                                            <a class="page-link " href="" id="<?php echo $total_page - 1 ;?>" aria-current="page" ><?php echo $total_page - 1;?></a>
                                        </li>
                                        <li class="page-item <?php echo $class; ?> ">
                                            <a class="page-link " href="" id="<?php echo $total_page;?>" aria-current="page" ><?php echo $total_page;?></a>
                                        </li>
                                <?php
                                }

                                else
                                { 
                            ?>
                                    <li class="page-item <?php echo $class; ?> ">
                                        <a class="page-link " href="" id="<?php echo $page_no = 1?>" aria-current="page" > 1</a>
                                    </li>
                                    <li class="page-item <?php echo $class; ?> ">
                                        <a class="page-link " href="" id="<?php echo $page_no = 2 ;?>" aria-current="page" >2</a>
                                    </li>
                                    <li class="page-item <?php echo $class; ?> ">
                                        <a class="page-link " href="" id="" aria-current="page" >...</a>
                                    </li>
                                <?php
                                    for ($i= $total_page - 6 ; $i <= $total_page ; $i++) 
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
                                            <li class="page-item <?php echo $class; ?> ">
                                                <a class="page-link <?php echo $class?>" href="" id="<?php echo $i;?>" aria-current="page" ><?php echo $i;?></a>
                                            </li>
                                    <?php 
                                            
                                    }
                                }
                            }
                            // Next and Last page button
                            if ($total_page > $page) 
                            {
                        ?>
                                <li class="page-item ">
                                    <a class="page-link " href="" id="<?php echo ($page+1) ;?>" aria-current="page" >Next</a>
                                </li>
                                <li class="page-item ">
                                    <a class="page-link " href="" id="<?php echo ($page = $total_page) ;?>" aria-current="page" >Last</a>
                                </li>
                        <?php
                            }
                        ?>
                        </ul>
                    </nav>      
                </div>
                <script>
                    // product details show more and show less
                    $(document).ready(function(){
                        var showChar = 100;
                        var ellipsestext = "...";
                        var moretext = "more";
                        var lesstext = "less";

                        $('.details').each(function() {
                        
                            var content = $(this).html();

                            if(content.length > showChar) 
                            {
                                var c = content.substr(0, showChar);
                                var h = content.substr(showChar, content.length - showChar);
                                
                                var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
                                
                                $(this).html(html);
                                
                            }
                        });

                        $(".morelink").click(function(){
                            if($(this).hasClass("less")) 
                            {
                                $(this).removeClass("less");
                                $(this).html(moretext);
                            } else 
                            {
                                $(this).addClass("less");
                                $(this).html(lesstext);
                            }
                            $(this).parent().prev().toggle();
                            $(this).prev().toggle();
                            return false;
                        });
                        
                    });
                </script>
        <?php
    }
    else
    {
        ?>
            <h3 class="text-center mt-3">No Record Found!</h3>
        <?php
    }
?>