<?php
require_once "../setup/connect.php";
require_once "../middleware/MustAuthenticate.php";
require_once "../middleware/MustBeAdmin.php";
require_once "../middleware/MustPost.php";


if(isset($_POST['add-product']))
{
  $product_name = mysqli_real_escape_string($dbc,strip_tags($_POST['product_name']));
  $description = mysqli_real_escape_string($dbc,strip_tags($_POST['product_description']));
  $price= mysqli_real_escape_string($dbc,strip_tags($_POST['price']));
  $category_id = mysqli_real_escape_string($dbc,strip_tags($_POST['category_id']));

  $sql = mysqli_query($dbc,"INSERT INTO products (product_name,description,price,category_id)
                                                VALUES ('".$product_name."','".$description."','".$price."','".$category_id."')");
  
  if($sql)
  {
    exit("success");
  }
  else
  {
   echo "error".mysqli_error($dbc);
  }
}
else if(isset($_POST['edit-product']))
{
  $id = mysqli_real_escape_string($dbc,strip_tags($_POST['id']));
  $product_name = mysqli_real_escape_string($dbc,strip_tags($_POST['product_name']));
  $description = mysqli_real_escape_string($dbc,strip_tags($_POST['product_description']));
  $price= mysqli_real_escape_string($dbc,strip_tags($_POST['price']));
  $category_id = mysqli_real_escape_string($dbc,strip_tags($_POST['category_id']));
  $active = mysqli_real_escape_string($dbc,strip_tags($_POST['active']));

  $sql = mysqli_query($dbc,"UPDATE products SET product_name='".$product_name."', description='".$description."', price='".$price."',
                                              category_id='".$category_id."', active='".$active."' WHERE id='".$id."' ");
  
  if($sql)
  {
    exit("success");
  }
  else
  {
   echo "error".mysqli_error($dbc);
  }
}
else if(isset($_POST['add-product-category']))
{
  $category_name = mysqli_real_escape_string($dbc,strip_tags($_POST['category_name']));

  $sql = mysqli_query($dbc,"INSERT INTO product_categories (category_name)
                                                VALUES ('".$category_name."')");
  
  if($sql)
  {
    exit("success");
  }
  else
  {
   echo "error".mysqli_error($dbc);
  }
}

else if(isset($_POST['edit-product-category']))
{
  $id = mysqli_real_escape_string($dbc,strip_tags($_POST['id']));
  $category_name = mysqli_real_escape_string($dbc,strip_tags($_POST['category_name']));
  $active = mysqli_real_escape_string($dbc,strip_tags($_POST['active']));
  
  $sql = mysqli_query($dbc,"UPDATE product_categories SET category_name='".$category_name."', active='".$active."' WHERE id='".$id."' ");
  
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
