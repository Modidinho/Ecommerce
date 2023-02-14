<?php
require_once "../../controllers/setup/connect.php";
require_once "../../controllers/Auth/MustAuthenticate.php";
?>
<div class="row justify-content-center">
    <div class="col-lg-4">
      <!-- Card -->
      <div class="card testimonial-card">

        <!-- Background color -->
        <div class="card-up cma-brand-color"></div>

        <!-- Avatar -->
        <div class="avatar mx-auto white">
          <img src="<?php echo $_SESSION['avatar'];?>" class="rounded-circle"
            alt="user avatar">
        </div>

        <!-- Content -->
        <div class="card-body">
          <!-- Name -->
          <h4 class="card-title m-0"><?php echo $_SESSION['name'];?></h4>
          <small class="text-muted text-center m-0"><?php echo $_SESSION['email'];?></small><br/>
          <small class="text-muted text-center"><?php echo ucfirst($_SESSION['role']);?> at <a href="#" onclick="GetAllHomePageContent();">CMMP</a></small>
          <hr>
          <!-- Quotation -->
          <?php
          $sql = mysqli_num_rows(mysqli_query($dbc,"SELECT user_id FROM updates_subscriptions WHERE user_id='".$_SESSION['user_id']."'"));
          if($sql > 0)
          {
            $subscribed = 'yes';
            $class = 'btn-danger';
            $message = 'Unsubscribe for Updates';
          }
          else
          {
            $subscribed = 'no';
            $class = 'btn-info';
            $message = 'Subscribe for Updates';
          }
           ?>
          <button type="button" class="btn <?php echo $class;?> btn-rounded btn-sm waves-effect waves-light btn-subscribe"
                  onclick="SubscribeForUpdates('<?php echo $subscribed;?>')"><span><?php echo $message;?></span><i class="fas fa-envelope ml-2"></i></button>
        </div>

      </div>
      <!-- Card -->
    </div>
</div>
