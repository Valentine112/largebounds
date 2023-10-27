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
                    <span class="username">Himself</span>
                </h1>
            </div>
        </div>

        <section class="mt-5">
            <h3>Update Wallet</h3>
            <div class="row justify-content-around align-items-center mt-3 profile-form">
                <div class="col-11 col-md-6">
                    <label for="btc">Bitcoin</label>
                    <input type="text" placeholder="Bitcoin" class="form" id="btc">
                </div>

                <div class="col-11 col-md-6">
                    <label for="eth">Ethereum</label>
                    <input type="text" placeholder="Eth" class="form" id="eth">
                </div>

                <div class="col-11 col-md-6">
                    <label for="usdt">USDT</label>
                    <br>
                    <input type="text" placeholder="USDT" class="form" id="usdt">
                </div>

                <div class="col-11 col-md-6">
                    <label for="shiba">Shiba</label>
                    <input type="text" placeholder="Shiba" class="form" id="shiba">
                </div>

                <div class="col-11 col-md-6">
                    <button class="btn btn-primary form-control">Submit</button>
                </div>
            </div>
        </section>

    </main>
</body>
</html>