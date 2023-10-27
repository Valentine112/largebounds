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
</head>
<body>
    <?php include "src/admin/template/sidebar/index.html"; ?>

    <main>
        <div class="container home">
            <div class="col-12 justify-content-left">
                <div class="col-10 mr-auto py-4 ml-4">
                    <h3 class="mt-4">Dashboard</h3>

                    <div class="row justify-content-around">
                        <div class="box col-11 col-md-5 py-4 mt-3">
                            <div>
                                <span>Total Users</span>
                            </div>
                            <div class="details col-12 text-center">
                                <h2 class="h1"><?= $users[1]; ?></h2>
                            </div>
                        </div>

                        <div class="box col-11 col-md-5 py-4 mt-3">
                            <div>
                                <span>Total Arts</span>
                            </div>
                            <div class="details col-12 text-center">
                                <h2 class="h1"><?= $arts; ?></h2>
                            </div>
                        </div>

                        <div class="box col-5 col-md-5 col-lg-8 py-4 mt-3">
                            <div>
                                <span>Amount Deposited</span>
                            </div>
                            <div class="details col-12 text-center">
                                <h2 class="h1">
                                    <?php
                                        $sum = array_sum(array_column($deposits[0], 'amount'));
                                        echo $sum == "" ? 0 : $sum;
                                    ?> ETH
                                </h2>
                            </div>
                        </div>

                        <div class="box col-5 col-md-5 col-lg-8 py-4 mt-3">
                            <div>
                                <span>Created Arts</span>
                            </div>
                            <div class="details col-12 text-center">
                                <h2 class="h1"><?= $created; ?></h2>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>