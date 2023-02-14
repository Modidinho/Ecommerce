<?php

    $email = mysqli_real_escape_string($dbc,strip_tags($_POST['email']));
    $password = mysqli_real_escape_string($dbc,strip_tags($_POST['password']));
    $confirm_password = mysqli_real_escape_string($dbc,strip_tags($_POST['confirm_password']));
    
    $verification_code = rand(100000,999999);
    //$verification_code = uniqid ();
    
    
    $sql = mysqli_query($dbc,"SELECT user_id FROM users WHERE email='".$email."'");
    
    if(mysqli_num_rows($sql) > 0)
    {
        exit('duplicate-email');
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
    $insert = mysqli_query($dbc,"INSERT INTO users (email,password) VALUES ('".$email."','".$password."')");
    $insert1 = mysqli_query($dbc,"INSERT INTO users_verification_codes (email,verification_code) VALUES ('".$email."','".$verification_code."')");
    if($insert && $insert1)
    {
        exit("success");
    }
    else 
    {
        exit("error" .mysqli_error($dbc));
    }


?>