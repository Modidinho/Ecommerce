<?php
require_once "../setup/connect.php";
require_once "../middleware/MustAuthenticate.php";
require_once "../middleware/MustPost.php";


$user_id = $_SESSION['user_id'];


$sql = mysqli_query($dbc,"SELECT SUM(quantity) AS quantity FROM orders WHERE user_id='".$user_id."' && status='pending'");

if($sql)
{
    $count = mysqli_num_rows($sql);

    if($count > 0)
    {
        $quantity = mysqli_fetch_array($sql);
        echo $quantity['quantity'];
        exit();
    }
    else 
    {
        
    }
    

    
}
else
{
 echo "error";
}

 ?>
