<?php
require_once "../setup/connect.php";
require_once "../middleware/MustAuthenticate.php";
require_once "../middleware/MustPost.php";
$user_id = $_SESSION['user_id'];

if(isset($_POST['account-update']))
{
  $first_name = mysqli_real_escape_string($dbc,strip_tags($_POST['first_name']));
  $last_name = mysqli_real_escape_string($dbc,strip_tags($_POST['last_name']));
  $phone_number = mysqli_real_escape_string($dbc,strip_tags($_POST['phone_number']));
  $address = mysqli_real_escape_string($dbc,strip_tags($_POST['address']));
  
  $sql = mysqli_query($dbc,"UPDATE users SET first_name='".$first_name."', last_name='".$last_name."', phone_number='".$phone_number."', address='".$address."' WHERE user_id='".$user_id."'");
  
  
  if($sql)
  {
    exit("success");
  }
  else
  {
   echo "error";
  }
}

if(isset($_POST['update-user-password']))
{
  $current_password = mysqli_real_escape_string($dbc,strip_tags($_POST['current_password']));
  $password = mysqli_real_escape_string($dbc,strip_tags($_POST['password']));
  $confirm_password = mysqli_real_escape_string($dbc,strip_tags($_POST['confirm_password']));

  $sql = mysqli_query($dbc,"SELECT * FROM users WHERE email='".$_SESSION['email']."' ");
  $row = mysqli_fetch_array($sql);
  $verify_password = password_verify($current_password, $row['password']);

  if($verify_password == false )
  {
    exit('invalid-password');
  }

  
  if(strlen($password) < 6)
  {
      exit('short-password');
  }
  
  if($password != $confirm_password)
  {
      exit('password-mismatch');
  }

  
  $password = password_hash($password,PASSWORD_DEFAULT);
  $update = mysqli_query($dbc,"UPDATE users SET password='".$password."' WHERE email='".$_SESSION['email']."'");

  if($update)
  {
      exit("success");
  }
  else 
  {
      exit("error" .mysqli_error($dbc));
  }
}



 ?>