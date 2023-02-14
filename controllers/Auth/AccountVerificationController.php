<?php
session_start();
require_once('../setup/connect.php');
require_once('../middleware/MustPost.php');

$verification_code = mysqli_real_escape_string($dbc,strip_tags($_POST['verification_code']));

$sql = mysqli_query($dbc, 'SELECT * FROM users_verification_codes WHERE verification_code= "'.$verification_code.'" ');

if(mysqli_num_rows($sql) == 0)
{
    exit('invalid');
}


$row = mysqli_fetch_array($sql);

$email = $row['email'];

if($row['is_verified'] == 1)
{
    exit("already-verified" );
}
else 
{
    $update= mysqli_query($dbc,"UPDATE users SET is_verified=1 WHERE email='".$email."'");
    $update1= mysqli_query($dbc,"UPDATE users_verification_codes SET is_verified=1 WHERE verification_code='".$verification_code."'");

    if($update && $update1)
    {
        exit("success" );
    }
}



?>