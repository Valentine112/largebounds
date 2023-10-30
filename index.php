<?php
    require "config/config.php";

    use Router\Router;
    use Config\Database;

    // Calling it this way because it's the whole class being return, instead of having to store the whole class as a variable and using it to access the methods

    // Note in the get/post methods also, the main class is also being returned

    (new Router(new Database))

    // Pages accessible without session
    ->get('/', function() {
        require "src/page/landing.php";
    })

    ->get('/home', function() {
        require "src/page/landing.php";
    })
    
    ->get('/login', function() {
        require "src/page/login.php";
    })

    ->get('/register', function() {
        require "src/page/register.php";
    })

    ->get('/forgot', function() {
        require "src/page/forgot.php";
    })

    ->get('/password', function() {
        require "src/page/new-password.php";
    })

    // Pages accessible after the landing, this are the content pages

    ->get('/user/home', function() {
        require "src/page/user/home.php";
    })

    ->get('/user/profile', function() {
        require "src/page/user/profile.php";
    })

    ->get('/user/wallet', function() {
        require "src/page/user/wallet.php";
    })

    ->get('/user/downlines', function() {
        require "src/page/user/downlines.php";
    })

    ->get('/user/investment-statement', function() {
        require "src/page/user/investments.php";
    })

    ->get('/user/deposit-statement', function() {
        require "src/page/user/deposits.php";
    })

    ->get('/user/withdrawal-statement', function() {
        require "src/page/user/withdrawals.php";
    })

    ->get('/user/packages', function() {
        require "src/page/user/packages.php";
    })

    ->get('/user/deposit', function() {
        require "src/page/user/deposit.php";
    })

    ->get('/user/pay', function() {
        require "src/page/user/pay.php";
    })

    ->get('/user/activate', function() {
        require "src/page/user/activate.php";
    })

    ->get('/user/withdraw', function() {
        require "src/page/user/withdraw.php";
    })


    ->listen();

    // Routing ends


?>