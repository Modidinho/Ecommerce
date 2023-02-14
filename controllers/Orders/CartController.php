<?php
require_once "../setup/connect.php";
require_once "../middleware/MustAuthenticate.php";
require_once "../middleware/MustPost.php";

if(isset($_POST['add_product_to_cart']))
{
  $product_id = mysqli_real_escape_string($dbc,strip_tags($_POST['product_id']));
  $user_id = $_SESSION['user_id'];
  $amount = mysqli_real_escape_string($dbc,strip_tags($_POST['amount']));
  $quantity =1;

  $total = $amount * $quantity;
  $sql = mysqli_query($dbc,"INSERT INTO orders (product_id,user_id, quantity,amount,total)
                                                VALUES ('".$product_id."','".$user_id."','".$quantity."','".$amount."','".$total."')");
  
  if($sql)
  {
    exit("success");
  }
  else
  {
   echo "error";
  }
}
if(isset($_POST['update_cart_product_quantity']))
{
  $id = mysqli_real_escape_string($dbc,strip_tags($_POST['id']));
  $quantity = mysqli_real_escape_string($dbc,strip_tags($_POST['quantity']));

  $sql = mysqli_query($dbc,"UPDATE orders SET quantity='".$quantity."' WHERE id='".$id."'");

  $sql1 = mysqli_fetch_array(mysqli_query($dbc,"SELECT amount FROM orders WHERE id='".$id."'"));
  $amount = $sql1['amount'];

  $total = $amount * $quantity;

  $update_total = mysqli_query($dbc,"UPDATE orders SET total='".$total."' WHERE id='".$id."'");
  
  if($sql && $update_total)
  {
    exit("success");
  }
  else
  {
   echo "error";
  }
}

if(isset($_POST['remove_product_from_cart']))
{
  $id = mysqli_real_escape_string($dbc,strip_tags($_POST['id']));

  $sql = mysqli_query($dbc,"DELETE FROM orders WHERE id='".$id."'");

  if($sql)
  {
    exit('success');
  }
}
else 
{

}

 ?>
