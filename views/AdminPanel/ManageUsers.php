<?php
require_once "../../controllers/middleware/MustPost.php";
require_once "../../controllers/setup/connect.php";
require_once "../../controllers/middleware/MustAuthenticate.php";
require_once "../../controllers/middleware/MustBeAdmin.php";

$sql = mysqli_query($dbc,"SELECT * FROM users ORDER BY user_id DESC");
$no = 1;

?>


    <!-- Grid column -->
    <div class="col-md-12">


        <!-- Panel -->
        <div class="card mb-lg-0 mb-4">

            <div class="card-header blue-gradient">
            <h5 class="font-weight-500 my-1 text-white">Manage Users
                <span class="float-right">
                    <button class="btn btn-outline-light btn-sm btn-rounded" data-toggle="modal"
                        data-target=".add-user-modal">
                        <i class="fas fa-user-plus"></i>
                        Add User
                    </button>
                </span>
            </h5>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table admin-users-table">
                        <thead>
                            <tr>
                                <th class="font-weight-bold ">#</th>
                                <th class="font-weight-bold ">First Name</th>
                                <th class="font-weight-bold ">Last Name</th>
                                <th class="font-weight-bold ">email</th>
                                <th class="font-weight-bold ">Phone</th>
                                <th class="font-weight-bold ">Role</th>
                                <th class="font-weight-bold ">Date Registered</th>
                                <th class="font-weight-bold ">Verification</th>
                                <th class="font-weight-bold ">Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
              while($row = mysqli_fetch_array($sql))
              {
                if($row['is_verified'] == 1)
                {
                    $badge_color = 'bg-success';
                    $verification = 'Verified';
                }
                else 
                {
                    $badge_color = 'bg-danger';
                    $verification = 'Not Verified';
                }
                ?>
                            <tr>
                                <td><?php echo $no++ ;?></td>
                                <td><?php echo $row['first_name'];?></td>
                                <td><?php echo $row['last_name'];?></td>
                                <td><?php echo $row['email'];?></td>
                                <td><a href="tel:<?php echo $row['phone_number'];?>" class="text-info"><?php echo $row['phone_number'];?></a></td>
                                <td><?php echo $row['role'];?></td>
                                <td>
                                <?php 
                          $date=date_create($row['time_registered']);
                          echo date_format($date,"d M Y");
                        
                      ?>
                                </td>
                                <td class="<?php echo $badge_color;?> font-weight-bold">
                                        <?php echo $verification ;?>
                                </td>

                                <td>
                                      <span class="badge badge-pill badge-info cursor-pointer" onclick="OpenEditUserModal('<?php echo $row['user_id'];?>');" data-toggle="modal" data-target=".edit-user-modal">update</span>
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


<?php 

require_once('ModalAddUser.php');

?>

<script>
$('.admin-users-table').DataTable({
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