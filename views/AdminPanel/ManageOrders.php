<?php
require_once "../../controllers/middleware/MustPost.php";
require_once "../../controllers/setup/connect.php";
require_once "../../controllers/middleware/MustAuthenticate.php";
require_once "../../controllers/middleware/MustBeAdmin.php";

$sql_orders = mysqli_query($dbc,"SELECT * FROM orders ORDER BY id DESC");
$no = 1;

?>


<!-- Grid column -->
<div class="col-md-12">


    <!-- Panel -->
    <div class="card mb-lg-0 mb-4">

        <div class="card-header white-text blue-gradient">
            <h5 class="font-weight-500 my-1">Manage Orders</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table admin-manage-orders-table">
                    <thead>
                        <tr>
                            <th class="font-weight-bold ">#</th>
                            <th class="font-weight-bold ">Order ID</th>
                            <th class="font-weight-bold ">Status</th>
                            <th class="font-weight-bold ">Product</th>
                            <th class="font-weight-bold ">Price</th>
                            <th class="font-weight-bold ">Date</th>
                            <th class="font-weight-bold ">Update Order</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                      while($row_orders = mysqli_fetch_array($sql_orders))
                      {
                        if($row_orders['status'] == 'Completed')
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
                            <td onclick="ShowOrderDetails('<?php echo $row_orders['id'];?>');"
                                class="text-info cursor-pointer"><?php echo $row_orders['id'];?></td>
                            <td class="<?php echo $badge_color;?>"><?php echo $row_orders['status'];?></td>
                            <td><?php echo $product['product_name'];?></td>
                            <td><?php echo $row_orders['quantity'];?> x (KES
                                <?php echo number_format($product['price']);?>)</td>
                            <td>
                                <?php 
                          $date=date_create($row_orders['time_recorded']);
                          echo date_format($date,"d M Y");
                        
                      ?>
                            </td>
                            <td>
                                <div class="select-outline">

                                    <select id="order-status-<?php echo $row_orders['id'];?>"
                                        name="order-status-<?php echo $row_orders['id'];?>"
                                        class="form-control order-status-<?php echo $row_orders['id'];?>"
                                        onchange="UpdateOrderStatus('<?php echo $row_orders['id'];?>',this)">
                                        <option disabled selected>Update Order</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Processing">Processing</option>
                                        <option value="Completed">Completed</option>
                                        <option value="On Delivery">On Delivery</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>

                                </div>


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




<script>
$('.admin-manage-orders-table').DataTable({
    stateSave: true,
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

$('.mdb-select').materialSelect();
$('.select-wrapper.md-form.md-outline input.select-dropdown').bind('focus blur', function() {
    $(this).closest('.select-outline').find('label').toggleClass('active');
    $(this).closest('.select-outline').find('.caret').toggleClass('active');
});
</script>