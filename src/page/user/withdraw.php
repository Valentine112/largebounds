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
    
    <main class="withdraw">
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

        <section class="mt-3">
            <div>
                <header>
                    <h5>Withdraw</h5>
                </header>
                <div class="row justify-content-around align-items-center forms">
                    <?php if(isset($msg) && $msg != "") echo "<div style='padding:10px;background-color:#dce8f7;color:black' class='mr-auto'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>

                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Amount you want to withdraw (in American Dollars)</label>
                                    <input required="" name="usd" type="number" class="form-control form" placeholder="Amount (Integers only)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Preferred withdrawal mode</label>
                                    <select name="mode" class="form-control form" id="plan" onchange="selectAddress(this)">
                                        <option value="">select an account type</option>

                                        <option value="BITCOIN" data-value="<?= $btc; ?>">Bitcoin</option>

                                        <option value="ETHEREUM" data-value="<?= $eth; ?>">Ethereum</option>

                                        <option value="SHIBA" data-value="<?= $shiba; ?>">BNB</option>

                                        <option value="Usdt" data-value="<?= $usdt; ?>">USDT</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row notice">
                            <ul>
                                <li>If you selected bitcoin as your withdrawal mode, enter your correct bitcoin wallet.</li>
                                <li>If you selected ethereum as your withdrawal mode, enter your correct ethereum wallet.</li>
                                <li>If you selected BNB as your withdrawal mode, enter your correct BNB wallet.</li>
                                <li>If you selected USDT as your withdrawal mode, enter your correct USDT wallet.</li>
                                <li>Your minimum withdrawal is $100.</li>
                                <li>If you entered wrong details and we send money to someone else's account, we won't be responsible for it.</li>
                                <li>If any issue is encountered while disbursing your money, an administrator will contact you via your email.</li>
                            </ul>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Account details</label>
                                    <textarea required="" name="wallet" class="form-control form"
                                    id="walletAddress" placeholder="Enter correct details"></textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Enter your password to confirm your withdrawal</label>
                                    <input name="password" type="password" class="form-control form" placeholder="Enter password">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" name="submit" class="btn btn-info btn-fill pull-right">Withdraw funds</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>
</html>