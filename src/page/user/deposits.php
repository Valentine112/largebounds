<?php require "php/general.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        use Src\Config\Head; 
        Head::tags();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/assets/css/landing.css">
    <link rel="stylesheet" href="../src/assets/css/general.css">
    <title>Largebounds Corporation</title>
</head>
<body>
    <?php include "src/template/sb/index.html"; ?>
    
    <main class="profile investments">
        <div class="row justify-content-between align-items-center">
            <div class="col-6">
                <h1>
                    <span>Statements</span>
                </h1>
            </div>

            <div class="col-6 text-right">
                <h1>
                    <span class="username">Himself</span>
                </h1>
            </div>
        </div>

        <section class="mt-3">
            <header>
                <h5>Deposit History</h5>
            </header>
            <div class="row justify-content-left mt-3">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Amount</th>
                            <th scope="col">Plan</th>
                            <th scope="col">Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if($value[1] < 1): ?>
                                <tr>
                                    <td>None</td>
                                    <td>None</td>
                                    <td>None</td>
                                </tr>
                            <?php else: ?>
                            <?php foreach($data as $val): ?>
                                <tr>
                                    <td><?= $val['amount']; ?></td>
                                    <td><?= $val['package']; ?></td>
                                    <td><?= $val['date']; ?></td>
                                </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </main>
</body>
</html>