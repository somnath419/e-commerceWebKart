                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php
require 'includes/common.php';
?>
<?php
 if (!isset($_SESSION['email']))
{ header('location: index.php'); 

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cart | Life Style Store</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
         <?php
        include 'includes/header.php';
        ?>
        
        <?php
        
 $userid=$_SESSION['u_id'];
 $usersa_check="SELECT status,item_id,u_name,p_name,p_price FROM users_items
     INNER JOIN products ON products.p_id=users_items.item_id
INNER JOIN users ON users.u_id=users_items.user_id
WHERE user_id='$userid' AND status='Added to Cart'";
$select_query_result = mysqli_query($con, $usersa_check) or die(mysqli_error($con));
$total_rows_fetched = mysqli_num_rows($select_query_result);

 

$sum=0;
$num=1;

 ?>
        
        <div class="container-fluid" id="content">
        
            <div class="row decor_bg">
                <div class="col-md-6 col-md-offset-3">
                    <table class="table table-striped">
                        <?php 
                        if($total_rows_fetched==0 ){   ?> 
                        <div class='jumbotron'>
                            <h2><?php echo"Add items to the cart first.";?></h2>
                            <h3><a href="products.php">Click here </a>to get to products page.</h3> 
                        </div><?php } else {?>
                    
                           <thead>
                            <tr>
                                <th>Item Number</th>
                                <th>Item Name</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                           </thead>
                           <tbody>
                        <?php   while( $row= mysqli_fetch_array($select_query_result)) {
                            
                            $item_id=$row['item_id'];
                            $item_name=$row['p_name'];
                            $item_price=$row['p_price'];
                            $sum=$sum+$item_price;
                            ?>
                             <tr>
                                <td><?php echo$num; $num++;?></td>
                                <td><?php echo$item_name;?></td>
                                <td><?php echo$item_price;?> </td>
                                <td><a href="cart_remove.php?id=<?php echo$item_id; ?>" class="remove_item_link"> Remove</a></td>
                            </tr>
                        <?php  } ?>
                            <tr>
                                <td></td>
                                <td>Total Price:</td>
                                <td><?php echo$sum; ?></td>
                                <td> <a href="success.php" class="btn btn-primary ">Confirm Order</a></td>
                                
                            </tr>
                            
                        </tbody>
                        
                       <?php }?>
                    </table>
                </div>
            </div>
        </div>
        
       <?php
        require "includes/footer.php";
       ?>
    </body>
</html>