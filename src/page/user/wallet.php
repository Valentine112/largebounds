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

        <section class="mt-5">
            <h3>Update Wallet</h3>
            <div class="row justify-content-around align-items-center mt-3 profile-form" data-parent="wallet">
                <div class="col-11 col-md-6">
                    <label for="btc">Bitcoin</label>
                    <br>
                    <input type="text" placeholder="Bitcoin" class="form" id="btc" <?= $user['btc']; ?>>
                </div>

                <div class="col-11 col-md-6">
                    <label for="eth">Ethereum</label>
                    <br>
                    <input type="text" placeholder="Eth" class="form" id="eth" <?= $user['eth']; ?>>
                </div>

                <div class="col-11 col-md-6">
                    <label for="usdt">USDT</label>
                    <br>
                    <input type="text" placeholder="USDT" class="form" id="usdt" <?= $user['usdt']; ?>>
                </div>

                <div class="col-11 col-md-6">
                    <label for="bnb">BNB</label>
                    <br>
                    <input type="text" placeholder="BNB" class="form" id="bnb" <?= $user['shiba']; ?>>
                </div>

                <div class="col-11 col-md-6">
                    <button class="btn btn-primary form-control" onclick="submit(this, 'wallet')">Submit</button>
                </div>
            </div>
        </section>

    </main>
</body>
<script src="../src/assets/js/main.js"></script>
<script src="../src/assets/js/general.js"></script>
</html>