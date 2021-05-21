<?php 

// Page title
$page_title = 'User Master-Admin';

// Header file
include 'top.php' ;

if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['type']) && $_GET['type']=='delete') 
{
    $type=get_safe_value($_GET['type']);

    $id=get_safe_value($_GET['id']);

    if ($type == 'delete') 
    {
        $query_delete = "DELETE FROM user WHERE id = '$id' ";

        $result_delete = mysqli_query($conn, $query_delete);
    }
}

$querDCy_select = "SELECT * FROM user ORDER BY name ASC";

$result_select = mysqli_query($conn , $querDCy_select);


?>
<!-- Your Content -->
<div id="container">
    <!-- Menu Button -->
    <button class="menu-btn">&#9776; Menu</button>    
    <a href="index.php" class="mx-3 text-decoration-none">Dashbord</a>/<a href="user_manage.php" class="mx-3 text-decoration-none">User Manage</a>
        
    <div class="container-fluid">
        <div class="sub-container">
            <h2>Users</h2>
            <table class="table">
                <thead class="text-center">
                    <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Mobile</th>
                    <th>Email</th>
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
                            <td><?php echo $row['username'] ?></td>
                            <td><?php echo $row['mobile'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo get_date($row['added_on']) ?></td>

                            <td>
                                <a href="?id=<?php echo $row['id']; ?>&type=delete" role="button" class="btn bg-danger" >Delete</a>
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
</div>

<?php include 'footer.php' ?>