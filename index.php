<?php 
require_once("controllers/setup/connect.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title id="page-title"><?php echo app_name;?></title>
    <link rel="stylesheet" href="assets/libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/mdb.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" media="print" onload="this.media='all'" href="assets/libs/css/select2.min.css" />
    <link rel="stylesheet" media="print" onload="this.media='all'" href="assets/libs/css/select2-material-theme.css">
    <link rel="stylesheet" media="print" onload="this.media='all'" href="assets/libs/css/toastr.min.css" />
    <link rel="stylesheet" media="print" onload="this.media='all'" href="assets/libs/css/pace-theme-flash.css" />
    <link rel="stylesheet" media="print" onload="this.media='all'" href="assets/libs/css/summernote-bs4.min.css">
    <link rel="stylesheet" media="print" onload="this.media='all'" href="assets/libs/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" media="print" onload="this.media='all'" href="assets/libs/css/hover-min.css" />
    <link rel="stylesheet" media="print" onload="this.media='all'" href="assets/libs/css/datatables.min.css" />
    <link rel="stylesheet" media="print" onload="this.media='all'" href="assets/libs/css/sweetalert2.min.css" />
    <link rel="stylesheet" media="print" onload="this.media='all'" href="assets/libs/css/animate.min.css" />
    <link rel="stylesheet" media="print" onload="this.media='all'" href="assets/css/addons-pro/cards-extended.min.css">
    <link rel="stylesheet" media="print" onload="this.media='all'" href="assets/css/addons-pro/steppers.min.css">
    <link rel="stylesheet" media="print" onload="this.media='all'" href="assets/css/style.css?v=<?php echo time();?>">
    <link rel="icon" href="<?php echo app_logo;?>" type="image/x-icon" />


</head>

<body class="fixed-sn white-skin">
    <div class="pace  pace-inactive">
        <div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div>
    </div>

    <!-- Main Navigation -->
    <header>
        <?php require_once('views/Layouts/NavBar.php');?>
    </header>
    <!-- Main Navigation -->
    <br /><br /><br />
    <!-- Main layout -->
    <div class="main">

        <div class="container-fluid">
            <?php  require_once('views/Orders/PaymentToast.php');?>
            <div id="dynamic-content" class="row mb-3"></div>
            <div id="dynamic-content-1" class="row mb-3"></div>
        </div>



        <?php
        
            require_once('views/HomePage/HomePageModals.php');

            ?>

    </div>
    <!-- Main layout -->



    <!-- SCRIPTS -->
    <script src="assets/libs/js//jquery.min.js"></script>
    <script src="assets/libs/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/mdb.min.js"></script>
    <script src="assets/js/addons-pro/steppers.min.js"></script>
    <script src="assets/libs/js/toastr.min.js"></script>
    <script src="assets/libs/js/select2.min.js"></script>
    <script src="assets/libs/js/jquery.timeago.js"></script>
    <script src="assets/libs/js/bootstrap-datepicker.js"></script>
    <script src="assets/libs/js/summernote-bs4.min.js"></script>
    <script src="assets/libs/js/pdfmake.min.js"></script>
    <script src="assets/libs/js//vfs_fonts.js"></script>
    <script src="assets/libs/js/datatables.min.js"></script>
    <script src="assets/libs/js//jquery.blockUI.min.js"></script>
    <script src="assets/libs/js/sweetalert2@10.js"></script>
    <script data-pace-options='{ "ajax": true }' src='assets/libs/js//pace.min.js'></script>
    <script src="controllers/validation.js?v=<?php echo time();?>"></script>
    <script src="controllers/routes.js?v=<?php echo time();?>"></script>
    <script src="controllers/custom.js?v=<?php echo time();?>"></script>
    <script src="controllers/forms.js?v=<?php echo time();?>"></script>



</body>

</html>