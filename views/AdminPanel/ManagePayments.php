<?php
require_once "../../controllers/middleware/MustPost.php";
require_once "../../controllers/setup/connect.php";
require_once "../../controllers/middleware/MustAuthenticate.php";
require_once "../../controllers/middleware/MustBeAdmin.php";

$sql = mysqli_query($dbc,"SELECT * FROM payments ORDER BY id DESC");
$no = 1;

?>


<!-- Grid column -->
<div class="col-md-12">


    <!-- Panel -->
    <div class="card mb-lg-0 mb-4">

        <div class="card-header white-text blue-gradient">
            <h5 class="font-weight-500 my-1">Manage Payments</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table admin-manage-payments-table">
                    <thead>
                        <tr>
                            <th class="font-weight-bold ">#</th>
                            <th class="font-weight-bold ">Payment Option</th>
                            <th class="font-weight-bold ">Phone</th>
                            <th class="font-weight-bold ">Email</th>
                            <th class="font-weight-bold ">Name</th>
                            <th class="font-weight-bold ">Amount</th>
                            <th class="font-weight-bold ">Payment Reference</th>
                            <th class="font-weight-bold ">Order IDs</th>
                            <th class="font-weight-bold ">Status</th>
                            <th class="font-weight-bold ">Time</th>
                            <th class="font-weight-bold ">Update Payments</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                      while($row = mysqli_fetch_array($sql))
                      {
                        if($row['pesapal_notification_type'] == 'COMPLETED')
                        {
                            $badge_color = 'bg-success';
                        }
                        else 
                        {
                            $badge_color = 'bg-warning';
                        }

                        $orders =mysqli_query($dbc,"SELECT * FROM orders WHERE payment_id='".$row['id']."' ");
                        ?>
                        <tr>
                            <td><?php echo $no++ ;?></td>
                            <td><?php echo $row['payment_option'];?></td>
                            <td><?php echo $row['phone_number'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['first_name'];?> <?php echo $row['last_name'];?></td>
                            <td><?php echo number_format($row['amount'],2);?></td>
                            <td><?php echo $row['reference'];?></td>
                            <td>
                                <?php
                                      while($row_orders = mysqli_fetch_array($orders))
                                      {
                                          ?>
                                            <a href="#" data-toggle="modal" data-target=".payment-orders-modal" onclick="ShowOrderDetails('<?php echo $row_orders['id'];?>');"
                                                class="text-info text-underline">
                                                <?php echo $row_orders['id'];?>
                                            </a><br/>
                                          <?php
                                      } 
                                      ?>
                        
                           </td>
                            <td class="<?php echo $badge_color;?>"><?php echo $row['pesapal_notification_type'];?></td>
                            
                            <td>
                                <?php 
                          $date=date_create($row['time_recorded']);
                          echo date_format($date,"d M Y H:i");
                        
                      ?>
                            </td>
                            <td>
                                <div class="select-outline">

                                    <select id="payment-status-<?php echo $row['id'];?>"
                                        name="payment-status-<?php echo $row['id'];?>"
                                        class="form-control payment-status-<?php echo $row['id'];?>"
                                        onchange="UpdatePaymentStatus('<?php echo $row['id'];?>',this)">
                                        <option disabled selected>Update Payment</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Processing">Processing</option>
                                        <option value="COMPLETED">COMPLETED</option>
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
$('.admin-manage-payments-table').DataTable({
    stateSave: true,
    dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'colvis',
                text: 'Filter',
            },
        ],


        colReorder: true,
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
$('.select-wrapper.md-form.md-outline input.select-dropdown').bind('focus blur', function () {
    $(this).closest('.select-outline').find('label').toggleClass('active');
    $(this).closest('.select-outline').find('.caret').toggleClass('active');
  });
</script>