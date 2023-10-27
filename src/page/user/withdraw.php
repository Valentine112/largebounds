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
    <title>Photofolio</title>
</head>
<body>
    <?php include "src/template/sb/index.html"; ?>

    <div id="content" class="home deposit">
        
        <?php include "src/template/head.php"; ?>

        <h5 class="mt-3">Withdraw</h5>
        <div class="main">
            <div class="row col-12 col-lg-7">
                <div id="message-box" class="col-12"></div>

                <div class="col-12">
                    <label for="address">Wallet Address</label>
                    <input type="text" placeholder="Your ETH address" class="form-control form" value="" id="address">
                </div>

                <div class="col-12 mt-3">
                    <label for="amount">Amount</label>
                    <input type="number" class="form-control form" id="amount" placeholder="amount in ETH">
                </div>

                <div class="col-12 mt-3">
                    <p class="text-info">Minimum withdrawal: 1.5 ETH</p>
                </div>

                <div class="col-12 mt-3">
                    <button class="btn btn-primary" onclick="withdraw(this)">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Include the notice box here -->
    <?php include "src/template/quick-notice.php"; ?>
</body>
<script src="../src/assets/js/general.js"></script>
</html>