<?php

require_once('../setup/connect.php');
require_once('../middleware/MustPost.php');

if(isset($_POST['register']))
{
    require_once('RegisterController.php');
}
else if(isset($_POST['login']))
{
    require_once('LoginController.php');
}
else if(isset($_POST['verifyaccount']))
{
    require_once('AccountVerificationController.php');
}
else if(isset($_POST['logout']))
{
    require_once('LogoutController.php');
}
else if (isset($_POST['reset_password']))
{
    require_once('PasswordResetController.php');
}

    
    
