<?php include "src/admin/php/general.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        use Config\Database;
        use Service\Func;
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
                    <h3 class="mt-4">Deposit</h3>

                    <div class="col-md-12 col-sm-12 col-sx-12 mt-5">
                        <div id="message">

                        </div>

                        <div class="table-responsive">
                            <table class="display" id="myTable">
                                <thead>
                                    <tr class="info">
                                        <th>User</th>
                                        <th>Amount</th>
                                        <th>Proof</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach($deposits[0] as $deposit): ?>
                                        <?php
                                            // Fetch user info
                                            $data = [
                                                'id' => $deposit['user'],
                                                '1' => "1",
                                                "needle" => "username",
                                                "table"=> "user"
                                            ];

                                            $username = Func::searchDb(new Database, $data, "AND");

                                            $status = $deposit['status'] == 0 ? "Pending" : "Accepted";
                                        ?>
                                        <tr class="primary">
                                            <td><?= $username; ?></td>
                                            <td><?= $deposit['amount']; ?></td>
                                            <td>
                                                <img src=" " data-src="<?= $deposit['proof']; ?>" class="lazy-load-image" alt="" height="50" width="50">
                                            </td>
                                            <td><?= $deposit['date']; ?></td>
                                            <td><?= $status; ?></td>

                                            <td><button class="btn btn-danger" onclick="action(this, 'dReject', <?= $deposit['id']; ?>)">Delete</button></td>
                                            
                                            <td><button class="btn btn-primary" onclick="action(this, 'dAccept', <?= $deposit['id']; ?>)">Accept</button></td>

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
<script>
    let table = new DataTable("#myTable")
</script>
</html>