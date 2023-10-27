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
    
    <main class="downlines">
        <div class="row justify-content-between align-items-center">
            <div class="col-6">
                <h1>
                    <span>Account</span>
                </h1>
            </div>

            <div class="col-6 text-right">
                <h1>
                    <span class="username">Himself</span>
                </h1>
            </div>
        </div>

        <section class="mt-5">
            <h3>Downlines</h3>
            <div class="referred-people">
                <ul>
                    <?php if($value1[1] < 1): ?>
                        <li>No referrals yet</li>
                    <?php else: 
                        foreach($value1[0] as $data): 
                    ?>
                        <li>You referred <?= $data['username']; ?></li>
                    <?php endforeach; endif; ?>
                </ul>
            </div>


            <div class="bonus referred-section mt-3">
                <header>
                    <h5>Referral Bonus</h5>
                </header>

                <div class="referred-people">
                    <ul>
                        <?php if($value[1] < 1): ?>
                            <li>You have no bonus from your downliners</li>
                        <?php 
                            else: 
                            foreach($value[0] as $data): 
                        ?>
                            <li>You received <?= "$".$data['amount']." from <span style='font-weight: 400'>".$data['username']."</span>"; ?></li>
                        <?php endforeach; endif; ?>
                    </ul>
                </div>
            </div>

            <!-- Table -->
            <div class="mt-5">
                <h5 class="text-center">Recent activities</h5>

                <div class="row justify-content-center mt-3 col-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Transaction</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($activities as $val): 

                                    // Getting status
                                    if($val['status'] == "pending"){
                                        $stats = "<span class='text-warning'>Pending</span>";
                                    }else{
                                        $stats = "<span class='text-success'>Approved</span>";
                                    }

                                    $type = "";
                                    
                                    //Getting type
                                    if($val['type'] === "withdraw" && $val['filled'] === "filled"){
                                        $type = "Withdrawal";
                                    }
                                    
                                    elseif($val['type'] === "topup" && $val['filled'] === "filled"){
                                        $type = "Deposit";
                                    }
                            ?>
                                <tr>
                                    <td><?= $type; ?></td>
                                    <td><?= $val['amount']; ?></td>
                                    <td><?= $stats; ?></td>
                                    <td><?= $val['date']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    </main>
</body>
</html>