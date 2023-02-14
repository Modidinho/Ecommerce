<?php
require_once "../setup/connect.php";
require_once "../middleware/MustAuthenticate.php";
require_once "../middleware/MustBeAdmin.php";
require_once "../middleware/MustPost.php";


$id = mysqli_real_escape_string($dbc,strip_tags($_POST['id']));
$item = mysqli_real_escape_string($dbc,strip_tags($_POST['item']));

if($item == 'category')
{
    $upload_dir = '../../media/products/category/';
    $uploadStatus = 1;
    $uploadedFile = '';
    $path_parts = pathinfo($_FILES["poster"]["name"]);
    $file_name = $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
    $file_type = strtolower($_FILES['poster']['type']);
    $file_size = $_FILES['poster']['size'];
    $allowed_extensions = array('gif','jpg','jpeg','png','webp');
    $max_file_size =  10485760;
    
    $target_file_path = $upload_dir . $file_name;
    
    
    
    
    if($file_size > $max_file_size)
     {
        exit("big-file");
      }
    $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    //check file type
    if (!in_array($extension, array('jpg', 'png', 'jpeg','webp')))
    {
        exit("invalid-format");
    }
    
    //upload the file
    if(!move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file_path))
    {
        exit("error-uploading");
    }
    $poster = $file_name;
    
    $sql = mysqli_query($dbc,"UPDATE product_categories SET file='".$poster."' WHERE id='".$id."'");
    
    if($sql)
    {
        echo "success";
    }
    else 
    {
        echo 'error';
    }
}
else if ($item == 'product')
{
    $upload_dir = '../../media/products/products/';
    $uploadStatus = 1;
    $uploadedFile = '';
    $path_parts = pathinfo($_FILES["poster"]["name"]);
    $file_name = $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
    $file_type = strtolower($_FILES['poster']['type']);
    $file_size = $_FILES['poster']['size'];
    $allowed_extensions = array('gif','jpg','jpeg','png','webp');
    $max_file_size =  10485760;
    
    $target_file_path = $upload_dir . $file_name;
    
    
    
    
    if($file_size > $max_file_size)
     {
        exit("big-file");
      }
    $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    //check file type
    if (!in_array($extension, array('jpg', 'png', 'jpeg','webp')))
    {
        exit("invalid-format");
    }
    
    //upload the file
    if(!move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file_path))
    {
        exit("error-uploading");
    }
    $poster = $file_name;
    
    $sql = mysqli_query($dbc,"UPDATE products SET file='".$poster."' WHERE id='".$id."'");
    
    if($sql)
    {
        echo "success";
    }
    else 
    {
        echo 'error';
    }
}
else 
{
    //
}


