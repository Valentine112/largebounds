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
    
    <main>
        <div class="row justify-content-between align-items-center">
            <div class="col-6">
                <h1>
                    <span>Home</span>
                </h1>
            </div>

            <div class="col-6 text-right">
                <h1>
                    <span class="username">Himself</span>
                </h1>
            </div>
        </div>

        <section>
            <div class="row justify-content-around align-items-center">
                <div class="col-11 col-md-5 box">
                    <div>
                        <small>Balance</small>
                    </div>
                    <div class="balance">
                        <sup>$</sup>&ensp;<span>0.00</span>
                    </div>
                    <div>
                        <small id="date"></small>
                    </div>
                    <div>
                        <div>
                            <i class="fa fa-money"></i>
                        </div>
                    </div>
                </div>

                <div class="col-11 col-md-5 box">
                    <div>
                        <small>Interest</small>
                    </div>
                    <div class="balance">
                        <sup>$</sup>&ensp;<span>0.00</span>
                    </div>
                    <div>
                        <small id="date"></small>
                    </div>
                    <div>
                        <div>
                            <i class="fa fa-money"></i>
                        </div>
                    </div>
                </div>

                <div class="col-11 col-md-5 box">
                    <div>
                        <small>Rate</small>
                    </div>
                    <div class="balance">
                    <span>0.00</span>&ensp;<sup>%</sup>
                    </div>
                    <div>
                        <small id="date"></small>
                    </div>
                    <div>
                        <div>
                            <i class="fa fa-percent"></i>
                        </div>
                    </div>
                </div>

                <div class="col-11 col-md-5 box">
                    <div>
                        <small>Withdrawn</small>
                    </div>
                    <div class="balance">
                        <sup>$</sup>&ensp;<span>0.00</span>
                    </div>
                    <div>
                        <small id="date"></small>
                    </div>
                    <div>
                        <div>
                            <i class="fa fa-money"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <!-- Stocks Chart -->
            <div class="row justify-content-center align-items-center">
                <div id="stockChart" class="col-11 col-md-10 col-lg-8"></div>
            </div>

            <!-- Table -->
            <div class="text-center">
                <h5>Recent activities</h5>

                <div class="row justify-content-center mt-3 col-12">
                    <div class="table-responsive col-12 col-md-8">
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
<script src="../src/assets/js/main.js"></script>
<script src="../src/assets/js/general.js"></script>
<script src="../src/assets/js/chart.js"></script>
<script>
    window.addEventListener("load", () => {
        var options = {weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'}
        
        document.querySelectorAll("#date").forEach(elem => {
            elem.innerText = new Date().toLocaleDateString('en-us', options)
        })
    })
</script>
</html>