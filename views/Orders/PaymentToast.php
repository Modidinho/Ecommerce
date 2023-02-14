<?php 

if(isset($_GET['payment_success']))
{
    ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong><i class="fas fa-check-circle"></i> Payment Successfully Made!</strong> You have successfully completed paying for the order. You can dismiss this alert
  
  <button type="button" class="close" data-dismiss="alert" onclick="location.replace('<?php echo app_url ;?>');">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php
}

?>


