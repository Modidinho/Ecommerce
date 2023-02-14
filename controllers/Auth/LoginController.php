<?php
session_start();
require_once('../setup/connect.php');
require_once('../middleware/MustPost.php');

$email = mysqli_real_escape_string($dbc,strip_tags($_POST['email']));
$password = mysqli_real_escape_string($dbc,strip_tags($_POST['password']));


$sql = mysqli_query($dbc,"SELECT * FROM users WHERE email='".$email."' ");

if(mysqli_num_rows($sql) > 0)
{
    $row = mysqli_fetch_array($sql);

    $confirm_password = password_verify($password, $row['password']);
    
    if($confirm_password == true)
    {

        if($row['is_verified']!=1)
        {
            exit('user-not-verified');
        }

        $_SESSION['is_logged_in'] = true;
        $_SESSION['email'] = $row['email'];
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['role'] = $row['role'];


        echo "success";
    }
    else 
    {
        exit('invalid-credentials');
    }
}
else 
{
    exit('invalid-credentials');
}




?>