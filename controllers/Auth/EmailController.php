<?php

require_once('../setup/EmailSettings.php');
require_once('../setup/connect.php');

if(isset($_POST['register']))
{
    $email = mysqli_real_escape_string($dbc,strip_tags($_POST['email']));


    $row = mysqli_fetch_array(mysqli_query($dbc, "SELECT * FROM users_verification_codes WHERE email='".$email."' ORDER BY id DESC LIMIT 1 "));
     
    $verification_code = $row['verification_code'];
    
    $mail->addAddress($email);
    
    $mail->Subject = 'Account Verification Code for Taitan Farm';
    $mail->Body    = 'Use this code to confirm your account.<br/> '.$verification_code.' ';
    $mail->AltBody = 'Use this code to confirm your account.<br/> '.$verification_code.' ';
    $sendmail =   $mail->send();
    if($sendmail)
    {
        exit("success");
    }
    else 
    {
        echo  $mail->ErrorInfo;
    }
}




if(isset($_POST['resend']))
{
    $email = mysqli_real_escape_string($dbc,strip_tags($_POST['email']));

    $sql = mysqli_query($dbc, "SELECT * FROM users WHERE email='".$email."' ");

    $row = mysqli_fetch_array($sql);


    if(mysqli_num_rows($sql) > 0)
    {
        //$verification_code = base64_encode(openssl_random_pseudo_bytes(30));
        $verification_code = rand(100000,999999);


        $insert1 = mysqli_query($dbc,"INSERT INTO users_verification_codes (email,verification_code) VALUES ('".$email."','".$verification_code."')");


        $mail->addAddress($email);

        $mail->Subject = 'Account Verification Code for Taitan Farm';
        $mail->Body    = 'Use this code to confirm your account.<br/> '.$verification_code.' ';
        $mail->AltBody = 'Use this code to confirm your account.<br/> '.$verification_code.' ';
        $sendmail =   $mail->send();
        if($sendmail)
        {
            exit("success");
        }
        else 
        {
            echo  $mail->ErrorInfo;
        }


    }
    else 
    {
        exit('account-does-not-exist');
    }


}

if(isset($_POST['forgot-password-send-email']))
{
    $email = mysqli_real_escape_string($dbc,strip_tags($_POST['email']));

    $sql = mysqli_query($dbc, "SELECT * FROM users WHERE email='".$email."' ");

    if(mysqli_num_rows($sql) > 0)
    {
        $verification_code = rand(100000,999999);

        $update = mysqli_query($dbc,"UPDATE users_password_requests SET expiry_status=1 WHERE email='".$email."'");

        $insert1 = mysqli_query($dbc,"INSERT INTO users_password_requests (email,reset_code) VALUES ('".$email."','".$verification_code."')");
        

        $mail->addAddress($email);

        $mail->Subject = 'Password Reset Code for Taitan Farm';
        $mail->Body    = 'Use this code to reset your password.<br/> '.$verification_code.' ';
        $mail->AltBody = 'Use this code to reset your password.<br/> '.$verification_code.' ';

        $sendmail =   $mail->send();
        if($sendmail)
        {
            echo "success";
        }
        else 
        {
            echo  $mail->ErrorInfo;
        }


    }
    else 
    {
        exit('account-does-not-exist');
    }


}

if(isset($_POST['reset_password']))
{
    $reset_code = mysqli_real_escape_string($dbc,strip_tags($_POST['reset_code']));

    $sql_email = mysqli_query($dbc,"SELECT email FROM users_password_requests WHERE reset_code='".$reset_code."'");

    $row_email = mysqli_fetch_array($sql_email);

    $email = $row_email['email'];

    if(mysqli_num_rows($sql_email) > 0)
    {
        $mail->addAddress($email);

        $mail->Subject = 'Password Update for Taitan Farm';
        $mail->Body    = 'Your password has been successfully updated.<br/>Please contact support if this was not you';
        $mail->AltBody = 'Your password has been successfully updated.<br/>Please contact support if this was not you';
        $sendmail =   $mail->send();
        if($sendmail)
        {
            echo "success";
        }
        else 
        {
            echo  $mail->ErrorInfo;
        }


    }
    else 
    {
        exit('account-does-not-exist');
    }

}

if(isset($_POST['update-user-password']))
{
    session_start();
    $email = $_SESSION['email'];

        $mail->addAddress($email);

        $mail->Subject = 'Password Update for Taitan Farm';
        $mail->Body    = 'Your password has been successfully updated.<br/>Please contact support if this was not you';
        $mail->AltBody = 'Your password has been successfully updated.<br/>Please contact support if this was not you';
        $sendmail =   $mail->send();
        if($sendmail)
        {
            echo "success";
        }
        else 
        {
            echo  $mail->ErrorInfo;
        }


}

?>