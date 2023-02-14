<?php
require_once "../setup/connect.php";
require_once "../middleware/MustAuthenticate.php";
require_once "../middleware/MustBeAdmin.php";
require_once "../middleware/MustPost.php";

if(isset($_POST['admin_update_payment']))
{
    $id = mysqli_real_escape_string($dbc,strip_tags($_POST['id']));
    $status = mysqli_real_escape_string($dbc,strip_tags($_POST['status']));

    $update_orders = mysqli_query($dbc,"UPDATE payments SET pesapal_notification_type='".$status."' WHERE id='".$id."' ");

    if($update_orders)
    {
        exit('success');
    }
    else 
    {
        exit('error' . mysqli_error($dbc));
    }
}


 ?>