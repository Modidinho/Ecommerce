<?php
require_once "../setup/connect.php";
require_once "../middleware/MustAuthenticate.php";
require_once "../middleware/MustPost.php";
$user_id = $_SESSION['user_id'];

$sql_sum = mysqli_query($dbc,"SELECT SUM(total) AS total FROM orders WHERE user_id='".$user_id."' && status='pending'");
$sum = mysqli_fetch_array($sql_sum);

if(isset($_POST['payment_option']))
{
  if($_POST['payment_option'] == 'cash')
  {
    $payment_option = mysqli_real_escape_string($dbc,strip_tags($_POST['payment_option']));
    $email = $_SESSION['email'];
    $desc = 'Order';
    $type = 'MERCHANT';
    $reference = microtime(true);;
    $first_name = $user['first_name'];
    $last_name = $user['last_name'];
    $amount = $sum['total'];
    $amount = number_format($amount, 2);
    $email = $_SESSION['email'];
    $phonenumber = $user['phone_number'];
  
  //save the form details to the database
  
  //check for duplicate reference number
  $sql = mysqli_query($dbc,"SELECT reference FROM payments WHERE reference='".$reference."'") or die (mysqli_error($dbc));
  $count = mysqli_num_rows($sql);
  if($count > 0)
  {
  //do not insert
  }
  else
  {
  //insert
  $sql1 = mysqli_query($dbc,"INSERT INTO payments
                                      (payment_option,description, type,reference, first_name,last_name,amount,email,phone_number)
                              VALUES
                  ('".$payment_option."','".$desc."','".$type."','".$reference."','".$first_name."','".$last_name."','".$amount."','".$email."','".$phonenumber."')
      ");
  
      $payment_id = mysqli_insert_id($dbc);

     $update_orders = mysqli_query($dbc,"UPDATE orders SET payment_id='".$payment_id."', status='processing' WHERE status='pending' && user_id='".$user_id."' ");
    
  
  if($sql1 && $update_orders)
  {
      exit('success');
  }
  else 
      {
          exit('error' . mysqli_error($dbc));
      }
  
  }
  }
  else if ($_POST['payment_option'] == 'eft')
  {
      require_once('pesapal-iframe.php');
  }
}


 ?>