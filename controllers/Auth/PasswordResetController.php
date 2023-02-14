<?php

    $reset_code = mysqli_real_escape_string($dbc,strip_tags($_POST['reset_code']));
    $password = mysqli_real_escape_string($dbc,strip_tags($_POST['password']));
    $confirm_password = mysqli_real_escape_string($dbc,strip_tags($_POST['confirm_password']));
    
    if(strlen($password) < 6)
    {
        exit('short-password');
    }
    
    if($password != $confirm_password)
    {
        exit('password-mismatch');
    }

    $check_code = mysqli_query($dbc,"SELECT email FROM users_password_requests WHERE reset_code='".$reset_code."' && expiry_status=0");
    if(mysqli_num_rows($check_code) == 0)
    {
        exit('no-code');
    }

    $email = mysqli_fetch_array($check_code);
    $email = $email['email'];


    
    
    $password = password_hash($password,PASSWORD_DEFAULT);
    $update = mysqli_query($dbc,"UPDATE users SET password='".$password."' WHERE email='".$email."'");
    $update1 = mysqli_query($dbc,"UPDATE users_password_requests SET expiry_status=1 WHERE email='".$email."'");

    if($update && $update1)
    {
        exit("success");
    }
    else 
    {
        exit("error" .mysqli_error($dbc));
    }


?>