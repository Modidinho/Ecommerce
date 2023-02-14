<?php 

if(!isset($_SESSION['is_logged_in']))
{
    require_once('NavBarNoAuth.php');
}
else if (isset($_SESSION['is_logged_in']) && $_SESSION['role'] == 'admin')
{
    require_once('NavBarAdmin.php');
}
else if (isset($_SESSION['is_logged_in']) && $_SESSION['role'] == 'user')
{
    require_once('NavBarUser.php');
}
?>