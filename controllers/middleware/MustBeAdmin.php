<?php

if(!($_SESSION['role'] == "admin"))
{
  exit("403");
}

 ?>
