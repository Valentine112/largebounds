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
    
    <main class="deposit">
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
                <div class="referred referred-section mb-3">
                    <header class="text-center">
                        <h5>Select a payment method</h5>
                    </header>

                    <div class="row justify-content-around align-items-center">
                        <div class="boxes col-11 col-md-5 col-lg-5 mt-2 mb-4 mx-auto text-center">
                            <a href="pay?method=bitcoin">
                                <p>Bitcoin</p>

                                <img src="../src/assets/coin/btc.svg" alt="">
                            </a>
                        </div>

                        <div class="boxes col-11 col-md-5 col-lg-5 mt-4 mb-4 mx-auto text-center">
                            <a href="pay?method=ethereum">
                                <p>Ethereum</p>

                                <img src="../src/assets/coin/eth.svg" alt="">
                            </a>
                        </div>

                        <div class="boxes col-11 col-md-5 col-lg-5 mt-4 mb-4 mx-auto text-center">
                            <a href="pay?method=bnb">
                                <p>BNB</p>

                                <img src="../src/assets/coin/bnb.svg" alt="">
                            </a>
                        </div>

                        <div class="boxes col-11 col-md-5 col-lg-5 mt-4 mb-4 mx-auto text-center">
                            <a href="pay?method=usdt">
                                <p>USDT</p>

                                <img src="../src/assets/coin/usdt.svg" alt="">
                            </a>
                        </div>

                    </div>

                    <!-- TradingView Widget BEGIN -->
                    <div class="tradingview-widget-container text-center">
                        <div id="tradingview_ebb94"></div>
                        <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/NASDAQ-TSLA/" rel="noopener" target="_blank"><span class="blue-text">TSLA stock chart</span></a> by TradingView
                        </div>
                    </div>
                    <!-- TradingView Widget END -->

                </div>
            </div>
        </section>
    </main>
</body>
<script src="../src/assets/js/chart.js"></script>
</html>