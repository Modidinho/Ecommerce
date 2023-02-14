<?php
require_once("constants.php");

$dbc = mysqli_connect(SERVER_NAME,DB_USER,DB_PASS,DB_NAME) or die ("Failed to Connect!");
date_default_timezone_set('Africa/Nairobi');


$today = date("Y-m-d");

?>
