<?php
require_once "../setup/connect.php";
require_once "../middleware/MustAuthenticate.php";
require_once "../middleware/MustBeAdmin.php";
require_once "../middleware/MustPost.php";


if(isset($_POST['admin_update_user_account']))
{
  $first_name = mysqli_real_escape_string($dbc,strip_tags($_POST['first_name']));
  $last_name = mysqli_real_escape_string($dbc,strip_tags($_POST['last_name']));
  $phone_number = mysqli_real_escape_string($dbc,strip_tags($_POST['phone_number']));
  $address = mysqli_real_escape_string($dbc,strip_tags($_POST['address']));
  $role = mysqli_real_escape_string($dbc,strip_tags($_POST['role']));
  $verification = mysqli_real_escape_string($dbc,strip_tags($_POST['verification']));
  $id = mysqli_real_escape_string($dbc,strip_tags($_POST['id']));



  $sql = mysqli_query($dbc,"UPDATE users SET first_name='".$first_name."', last_name='".$last_name."', phone_number='".$phone_number."',
                                              address='".$address."', role='".$role."', is_verified='".$verification."' WHERE user_id='".$id."'");
  
  if($sql)
  {
    exit("success");
  }
  else
  {
   echo "error".mysqli_error($dbc);
  }
}

else 
{
    echo "nan";
}

 ?>
