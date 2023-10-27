<?php include "src/admin/php/general.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        use Src\Config\Head; 
        Head::tags();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/admin/css/general.css">
    <title>Photofolio</title>
    <!-- jQuery 3 -->
    <script src="../src/assets/jquery/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    
</head>
<body>
    <?php include "src/admin/template/sidebar/index.html"; ?>

    <main>
        <div class="container home">
            <div class="col-12 justify-content-left">
                <div class="col-10 mr-auto py-4 ml-4">
                    <h3 class="mt-4">Manage Users</h3>

                    <div class="col-md-12 col-sm-12 col-sx-12 mt-5">
                        <div id="message">

                        </div>
                        <div class="table-responsive">
                            <table class="display" id="myTable">
                                <thead>
                                    <tr class="info">
                                        <th>Fullname</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Wallet</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach($users[0] as $user): ?>
                                    <tr class="primary">
                                        <td><?= $user['fullname']; ?></td>
                                        <td><?= $user['username']; ?></td>
                                        <td><?= $user['email']; ?></td>
                                        <td>
                                            <input style="color:#fff; background-color: #1b1b1b;" type="number" value="<?= $user['wallet']; ?>" id="wallet">
                                        </td>
                                        <td><?= $user['date']; ?></td>
                                        <td><button class="btn btn-primary" onclick="users(this, <?= $user['id']; ?>)">Update</button></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="../src/admin/js/general.js"></script>
<!--<script>
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
        });

        table.buttons().container().insertBefore('#example_filter');
        table.buttons().container().appendTo( '#example_wrapper .col-sm-12:eq(0)' );
        });
</script>-->

<script>
    $(document).ready(function() {
        let table = new DataTable('#myTable', {
            responsive: true,
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
        });
    });
</script>
</html>