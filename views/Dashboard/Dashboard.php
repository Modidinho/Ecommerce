<?php
require_once "../../controllers/middleware/MustPost.php";
require_once "../../controllers/setup/connect.php";
require_once "../../controllers/middleware/MustAuthenticate.php";
require_once "../../controllers/middleware/MustBeAdmin.php";

$completed_payments_sql = mysqli_query($dbc,"SELECT SUM(amount) AS amount FROM payments WHERE pesapal_notification_type='COMPLETED'");
$completed_payments = mysqli_fetch_array($completed_payments_sql);

$pending_payments_sql = mysqli_query($dbc,"SELECT SUM(amount) AS amount FROM payments WHERE pesapal_notification_type!='COMPLETED' || pesapal_notification_type IS NULL");
$pending_payments = mysqli_fetch_array($pending_payments_sql);


$completed_orders_sql = mysqli_query($dbc,"SELECT SUM(quantity) AS quantity FROM orders WHERE status='COMPLETED'");
$completed_orders = mysqli_fetch_array($completed_orders_sql);

$incomplete_orders_sql = mysqli_query($dbc,"SELECT SUM(quantity) AS quantity FROM orders WHERE status!='COMPLETED'");
$incomplete_orders = mysqli_fetch_array($incomplete_orders_sql);

$total_products_sql = mysqli_query($dbc,"SELECT COUNT(*) AS total_products FROM products");
$total_products= mysqli_fetch_array($total_products_sql);

$total_products_value_sql = mysqli_query($dbc,"SELECT SUM(price) AS products_value FROM products ");
$total_products_value = mysqli_fetch_array($total_products_value_sql);

$total_users_sql = mysqli_query($dbc,"SELECT COUNT(*) AS total_users FROM users");
$total_users= mysqli_fetch_array($total_users_sql);

$total_users_not_verified_sql = mysqli_query($dbc,"SELECT COUNT(*) AS total_users_not_verified FROM users WHERE is_verified!=1");
$total_users_not_verified= mysqli_fetch_array($total_users_not_verified_sql);


$total_users_not_verified_percentage = ($total_users_not_verified['total_users_not_verified'] / $total_users['total_users'] ) * 100;
$total_users_not_verified_percentage = number_format($total_users_not_verified_percentage, 0);



$sql_orders = mysqli_query($dbc,"SELECT * FROM orders WHERE status!='pending' ORDER BY id DESC LIMIT 10");
$no = 1;
?>
<style>
.one {
    background-color: #006400;
}

.two {
    background-color: #00FF00;
}

.three {
    background-color: #FFFF00;
}

.four {
    background-color: #FFC200;
}

.five {
    background-color: #FF0000;
}

.white-skin .form-header,
.white-skin .card-header {
    background-color: white;
}

.btn {
    text-transform: unset !important;
}

.progress-group:hover {
    border: 2px solid rgb(158, 125, 8);
    margin-top: 3px;
    border-radius: 7px;
}

.card.card-cascade .view.view-cascade {
    border-radius: 0.25rem;
    box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 0.18), 0 4px 15px 0 rgba(0, 0, 0, 0.15);
}

.card.card-cascade .view.view-cascade.gradient-card-header {
    padding: 1.6rem 1rem;
    color: #fff;
    text-align: center;
}

.card.card-cascade .view.view-cascade.gradient-card-header .card-header-title {
    font-weight: 500;
}

.card.card-cascade .view.view-cascade.gradient-card-header .btn-floating {
    background-color: rgba(255, 255, 255, 0.2);
}

.card.card-cascade.wider {
    background-color: transparent;
    box-shadow: none;
}

.card.card-cascade.wider .view.view-cascade {
    z-index: 2;
}

.card.card-cascade.wider .card-body.card-body-cascade {
    z-index: 1;
    margin-right: 4%;
    margin-left: 4%;
    background: #fff;
    border-radius: 0 0 0.25rem 0.25rem;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
}

.card.card-cascade.wider .card-body.card-body-cascade .card-footer {
    margin-right: -1.25rem;
    margin-left: -1.25rem;
}

.card.card-cascade.wider.reverse .card-body.card-body-cascade {
    z-index: 3;
    margin-top: -1rem;
    border-radius: 0.25rem;
    box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 0.18), 0 4px 15px 0 rgba(0, 0, 0, 0.15);
}

.card.card-cascade.narrower {
    margin-top: 1.25rem;
}

.card.card-cascade.narrower .view.view-cascade {
    margin-top: -1.25rem;
    margin-right: 4%;
    margin-left: 4%;
}

.cascading-admin-card {
    margin-top: 1.25rem;
}

.cascading-admin-card .admin-up {
    margin-left: 4%;
    margin-right: 4%;
    margin-top: -1.25rem;
}

.cascading-admin-card .admin-up .fas,
.cascading-admin-card .admin-up .far,
.cascading-admin-card .admin-up .fab {
    padding: 1.7rem;
    font-size: 2rem;
    color: #fff;
    text-align: left;
    border-radius: 3px;
}

.cascading-admin-card .admin-up .data {
    float: right;
    margin-top: 2rem;
    text-align: right;
}

.cascading-admin-card .admin-up .data p {
    color: #999999;
    font-size: 12px;
}

.classic-admin-card .card-body {
    color: #fff;
    margin-bottom: 0;
    padding: 0.9rem;
}

.classic-admin-card .card-body p {
    font-size: 13px;
    opacity: 0.7;
    margin-bottom: 0;
}

.classic-admin-card .card-body h4 {
    margin-top: 10px;
}

.classic-admin-card .card-body .float-right .fas,
.classic-admin-card .card-body .float-right .far,
.classic-admin-card .card-body .float-right .fab {
    font-size: 3rem;
    opacity: 0.5;
}

.classic-admin-card .progress {
    margin: 0;
    opacity: 0.7;
}
</style>


<div class="container-fluid">

    <!-- Section: Analytical panel -->
    <section class="mt-md-4 pt-md-2 mb-5">

        <!-- First row -->
        <div class="row">

            <!-- First column -->
            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">

                <!-- Card -->
                <div class="card card-cascade cascading-admin-card">

                    <!-- Card Data -->
                    <div class="admin-up">
                        <i class="far fa-bags-shopping primary-color mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase">Orders</p>
                            <h4 class="font-weight-bold "><?php echo $completed_orders['quantity'];?></h4>
                        </div>
                    </div>

                    <!-- Card content -->
                    <div class="card-body card-body-cascade">
                        <p class="card-text">Incomplete Orders (<?php echo $incomplete_orders['quantity'];?>)</p>
                    </div>

                </div>
                <!-- Card -->

            </div>
            <!-- First column -->

            <!-- Second column -->
            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">

                <!-- Card -->
                <div class="card card-cascade cascading-admin-card">

                    <!-- Card Data -->
                    <div class="admin-up">
                        <i class="fas fa-list warning-color mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase">Products</p>
                            <h4 class="font-weight-bold "><?php echo $total_products['total_products'];?></h4>
                        </div>
                    </div>

                    <!-- Card content -->
                    <div class="card-body card-body-cascade">
                        <p class="card-text">Total Products Value (KES
                            <?php echo number_format($total_products_value['products_value']);?>)</p>
                    </div>

                </div>
                <!-- Card -->

            </div>
            <!-- Second column -->

            <!-- Third column -->
            <div class="col-xl-3 col-md-6 mb-md-0 mb-4">

                <!-- Card -->
                <div class="card card-cascade cascading-admin-card">

                    <!-- Card Data -->
                    <div class="admin-up">
                        <i class="far fa-money-bill-alt primary-color mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase">Payments (KES)</p>
                            <h4 class="font-weight-bold "><?php echo number_format($completed_payments['amount']);?>
                            </h4>
                        </div>
                    </div>

                    <!-- Card content -->
                    <div class="card-body card-body-cascade">
                        <p class="card-text">Pending Payments (<?php echo number_format($pending_payments['amount']);?>)
                        </p>
                    </div>

                </div>
                <!-- Card -->

            </div>
            <!-- Third column -->

            <!-- Fourth column -->
            <div class="col-xl-3 col-md-6 mb-0">

                <!-- Card -->
                <div class="card card-cascade cascading-admin-card">

                    <!-- Card Data -->
                    <div class="admin-up">
                        <i class="fas fa-users red accent-2 mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase">Users</p>
                            <h4 class="font-weight-bold "><?php echo $total_users['total_users'];?></h4>
                        </div>
                    </div>

                    <!-- Card content -->
                    <div class="card-body card-body-cascade">
                        <p class="card-text">Unverified Users
                            (<?php echo $total_users_not_verified['total_users_not_verified'];?>)</p>
                    </div>

                </div>
                <!-- Card -->

            </div>
            <!-- Fourth column -->

        </div>
        <!-- First row -->

    </section>
    <!-- Section: Analytical panel -->

    <!-- Section: data tables -->
    <section class="pb-3">

        <!-- Grid row -->
        <div class="row">

            <!-- Grid column -->
            <div class="col-lg-12 col-md-12">


                <!-- Panel -->
                <div class="card mb-lg-0 mb-4">

                    <div class="card-header white-text blue-gradient">
                        <h5 class="font-weight-500 my-1">Recent Orders</h5>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table admin-recent-orders-table">
                                <thead>
                                    <tr>
                                        <th class="font-weight-bold ">#</th>
                                        <th class="font-weight-bold ">Status</th>
                                        <th class="font-weight-bold ">Order ID</th>
                                        <th class="font-weight-bold ">Product</th>
                                        <th class="font-weight-bold ">Price</th>
                                        <th class="font-weight-bold ">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                      while($row_orders = mysqli_fetch_array($sql_orders))
                      {
                        if($row_orders['status'] == 'COMPLETED')
                        {
                            $badge_color = 'bg-success';
                        }
                        else 
                        {
                            $badge_color = 'bg-warning';
                        }

                        $product = mysqli_fetch_array(mysqli_query($dbc,"SELECT * FROM products WHERE id='".$row_orders['product_id']."'"));
                        ?>
                                    <tr>
                                        <td><?php echo $no++ ;?></td>
                                        <td class="<?php echo $badge_color;?>"><?php echo $row_orders['status'];?></td>
                                        <td onclick="ShowOrderDetails('<?php echo $row_orders['id'];?>');" class="text-info cursor-pointer"><?php echo $row_orders['id'];?></td>
                                        <td><?php echo $product['product_name'];?></td>
                                        <td><?php echo $row_orders['quantity'];?> x (KES
                                            <?php echo number_format($product['price']);?>)</td>
                                        <td>
                                            <?php 
                          $date=date_create($row_orders['time_recorded']);
                          echo date_format($date,"d M Y");
                        
                      ?>
                                        </td>
                                    </tr>

                                    <?php
                      }

                      ?>

                                </tbody>


                            </table>
                        </div>

                    </div>

                </div>
                <!-- Panel -->

            </div>
            <!-- Grid column -->



        </div>
        <!-- Grid row -->

    </section>
    <!-- Section: data tables -->

</div>

<script>
$('.admin-recent-orders-table').DataTable({
    initComplete: function() {
        this.api()
            .columns()
            .every(function() {
                var column = this;
                var select = $(
                        '<select class="select2 form-control"><option value=""></option></select>')
                    .appendTo($(column.header()))
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());

                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                    });

                column
                    .data()
                    .unique()
                    .sort()
                    .each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>');
                    });
            });
    },
});

$('.select2').select2({

});
</script>