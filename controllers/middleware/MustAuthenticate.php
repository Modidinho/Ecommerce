<?php
session_start();
if(!isset($_SESSION['user_id']))
{
  $message ="<div class='alert alert-info w-100'>
                 <a class='waves-effect waves-light link log-in-link' href='#'>
                   <i class='fas fa-info-circle '></i> Please Login to continue
              </a>
            </div>" ;
  exit($message);
}

$user = mysqli_fetch_array(mysqli_query($dbc,"SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'"));
 ?>
