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
    
    <main class="profile">
        <div class="row justify-content-between align-items-center">
            <div class="col-6">
                <h1>
                    <span>Account</span>
                </h1>
            </div>

            <div class="col-6 text-right">
                <h1>
                    <span class="username"><?= $user['username']; ?></span>
                </h1>
            </div>
        </div>

        <section class="mt-3">
            <div>
                <div class="referred referred-section mb-3">
                    <header>
                        <h5>Pay via <?= $crypto; ?></h5>
                    </header>
                    <?php
                    if($error_mssg === TRUE): ?>
                        <div class="alert alert-success text-center">
                            <strong>Successfully sent for revision</strong>
                        </div>
                    <?php elseif($error_mssg === FALSE): ?>
                        <div class="alert alert-danger text-center">
                            <strong>Failed! please try again later . . .</strong>
                        </div>
                    <?php elseif(is_string($error_mssg) && strlen(trim($error_mssg)) > 1): ?>
                        <div class="alert alert-warning text-center">
                            <strong><?= $error_mssg; ?></strong>
                        </div>
                    <?php endif; ?>

                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']).'?method='.strtolower($_SESSION['crypto_name']); ?>" method="post" enctype="multipart/form-data">

                        <div class="row justify-content-around align-items-center">

                            <div class="col-11 col-md-7 mt-2 mb-2">
                                <label for="btc">Wallet Address</label>
                                <input type="text" class="form-control wallet-address form" value="<?= $wallet_address; ?>" name="address" id="btc" readonly>

                                <button type="button" class="btn btn-danger mt-2" onclick="copy(this)">Copy</button>

                                <div id="copy" class="col-12 alert alert-info d-none">Copied</div>
                            </div>

                            <div class="col-11 col-md-7 mt-2 mb-2">
                                <label for="amount">Amount</label>
                                <input type="number" name="amount" class="form-control form" placeholder="Enter amount" aria-placeholder="Enter amount" id="amount">
                            </div>

                            <div class="col-11 col-md-7 mt-4 mb-2">
                                <label for="first">Screenshot of <?= $crypto; ?> transaction:</label>
                                <input type="file" name="tranx-proof" class="form-control form">
                            </div>
                            
                            <div class="col-11 col-md-7 mt-2 mb-2">
                                <button type="submit" name="submit" class="btn btn-fill btn-danger submit col-lg-3" onclick="submit(this, 'pay')">Submit</button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </section>

    </main>
</body>
<script src="../src/assets/js/main.js"></script>
<script src="../src/assets/js/general.js"></script>
</html>