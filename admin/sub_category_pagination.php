<?php 

    // database connaction
    include '../conn.php';

    // function file
    include '../function.php';

    // sub category limit on page
    $limit_par_page = 10;

    // page no
    if (isset($_POST['page_no'])) 
    {
        $page = $_POST['page_no'];
    }
    else
    {
        $page = 1;
    }

    $offset = ($page - 1)*$limit_par_page;

    $query_select = "SELECT sub_category.*, category.category_name FROM sub_category INNER JOIN category ON sub_category.category_id = category.category_id  ORDER BY sub_category_id DESC LIMIT  {$offset},{$limit_par_page} ";

    $result_select = mysqli_query($conn , $query_select);
    
    if (mysqli_num_rows($result_select) > 0) 
    { 
?>
        <table class="table">
            <thead class="text-center">
                <tr>
                <th>#</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Image <small style="color:grey">(click on Images)</small></th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php 
                    
                    $i = 1;

                    while($row = mysqli_fetch_assoc($result_select))
                    {
                ?>        
                    <tr>
                    <th scope="row"><?php echo $i; ?></th>
                    <td><?php echo $row['category_name'] ?></td>
                    <td><?php echo $row['sub_category_name'] ?></td>
                    <td><a target="_blank" href="<?php echo DISPLAY_IMAGE.'/sub_category/'.$row['sub_category_image'] ?>"><img src="<?php echo DISPLAY_IMAGE.'/sub_category/'.$row['sub_category_image'] ?>" alt="" width="125" height="150"></a></td>
                    <td>
                        <?php

                            if ($row['status'] == 0) 
                            {
                                $type1 = 'active';
                                $href1 = "?id=".urlencode(base64_encode($row['sub_category_id']*1122334455))."&type=".urlencode(base64_encode($type1));
                        ?>
                            <a href="<?php echo $href1; ?>" role="button" class="btn bg-warning" >Deactive</a>            
                        <?php 
                            }
                            else
                            {
                                $type2 = 'deactive';
                                $href2 = "?id=".urlencode(base64_encode($row['sub_category_id']*1122334455))."&type=".urlencode(base64_encode($type2));
                        ?>
                            <a href="<?php echo $href2; ?>" role="button" class="btn bg-success" >active</a>
                        <?php 
                            }
                            $type3 = 'delete';
                            $href3 = "sub_category_manage.php?id=".urlencode(base64_encode($row['sub_category_id']*1122334455));
                            $href4 = "?id=".urlencode(base64_encode($row['sub_category_id']*1122334455))."&type=".urlencode(base64_encode($type2));
                        ?>

                        <a href="<?php echo $href3; ?>" role="button" class="btn bg-primary" >Edit</a>
                        <a href="<?php echo $href4; ?>" role="button" class="btn bg-danger" >Delete</a>
                    </td>
                    </tr>
                <?php
                        $i++;
                    }
                ?>
            </tbody>
        </table>
        <!-- pagination button -->
        <div class="d-flex justify-content-center" id="pagination">
        <?php 
            $result_select_all_sub_category = mysqli_query($conn,"SELECT * FROM sub_category");

            $total_record = mysqli_num_rows($result_select_all_sub_category);

            $total_page = ceil($total_record/$limit_par_page)
        ?>
            <ul class="pagination">
                <!-- First page and Previous page button -->
                <?php
                    if ($page > 1) 
                    {
                        ?>
                            <li class="page-class">
                                <a href="" class="page-link" id="<?php echo $page_no = 1 ?>">First</a>
                            </li>
                            <li class="page-class">
                                <a href="" class="page-link" id="<?php echo $page - 1 ?>">Previous</a>
                            </li>
                        <?php        
                    }

                    // for less then 10 page
                    if ($total_page <= 10) 
                    { 
                        for ($i=1; $i < $total_page; $i++) 
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
                    // for greater then 10 page
                    elseif ($total_page > 10) 
                    {  
                        // for less then 4 page
                        if ($page <= 4) 
                        { 
                            for ($i=1; $i < 8 ; $i++) 
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
                        // for greater then 4 page and less then total page (-4) page
                        elseif ($page > 4 &&  $page < $total_page - 4) 
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
                            for ($i = $page - 2; $i < $page + 2 ; $i++) 
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
                        // last 6 page
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

                    // Last page and Next page button
                    if ($total_page > $page) 
                    {
                        ?>
                            <li class="page-class">
                                <a href="" class="page-link" id="<?php echo $page + 1 ?>">Next</a>
                            </li>
                            <li class="page-class">
                                <a href="" class="page-link" id="<?php echo $page = $total_page ?>">Last</a>
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