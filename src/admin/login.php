<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        use Src\Config\Head; 
        Head::tags();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/admin/css/general.css">
    <link rel="stylesheet" href="src/assets/css/login.css">
    <title>Photofolio</title>
</head>
<body>
    <div class="container">
        <div class="main mx-auto col-11">
            <div class="main-header">
                <h1 class="site-name"><a href="home">PhotoFolio</a></h1>
            </div>

            <div class="content text-center mx-auto col-11 col-md-5 col-lg-3">
                <div class="mb-3">
                    <h2>ADMIN PANEL</h2>
                </div>
                <div id="message">
                    
                </div>
                <div>
                    <input type="email" class="form col-12 p-3" placeholder="Username" id="username">
                </div>
                <div class="mt-2">
                    <input type="password" class="form col-12 p-3" placeholder="password" id="password">
                </div>
                <div>
                    <button class="btn btn-primary col-12 p-2 mt-3" onclick="login(this)">LOGIN</button>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="src/admin/js/general.js"></script>
</html>