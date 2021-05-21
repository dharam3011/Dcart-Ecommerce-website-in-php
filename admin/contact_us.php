<?php 

// Page title
$page_title = 'Contact Us-Admin';

// Header file
include 'top.php' ;

if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['type']) && $_GET['type']=='delete') 
{
    $type=get_safe_value($_GET['type']);

    $id=get_safe_value($_GET['id']);

    if ($type == 'delete') 
    {
        $query_delete = "DELETE FROM contact_us WHERE contact_id = '$id' ";

        $result_delete = mysqli_query($conn, $query_delete);
    }
}

$querDCy_select = "SELECT * FROM contact_us ORDER BY contact_id DESC";

$result_select = mysqli_query($conn , $querDCy_select);


?>
<div id="container">
    <div class="container-fluid">
            <div class="d-flex">
                <h2>Contact-us</h2>
                <span class="mt-2 mx-3"><a href="index.php">Dashbord</a> <strong>/</strong></span>
            </div>      
            <table class="table">
                <thead class="text-center">
                    <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Added On</th>
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
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['mobile'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['message'] ?></td>
                            <td><?php echo get_date($row['added_on']) ?></td>

                            <td>
                                <?php
                                    if ($row['status'] == 0) 
                                    {
                                ?>
                                <a href="contact_us_replay.php?id=<?php echo $row['contact_id']; ?>" role="button" class="btn bg-primary" >Replay Pandding</a>            
                                <?php 
                                    }
                                    else
                                    {
                                ?>
                                <a href="#" class="btn btn-success  disabled"  role="button" aria-disabled="true">Replay Success</a>
                                <?php 
                                    }
                                ?>

                                <a href="?id=<?php echo $row['contact_id']; ?>&type=delete" role="button" class="btn bg-danger" >Delete</a>
                            </td>
                            </tr>
                        <?php
                                $i++;

                            }
                        ?>
                </tbody>
            </table>
        </div>
    
</div>
<?php include 'footer.php' ?>