<!doctype html>
<html lang="en">
  <head>
  <?php 
        use Src\Config\Head; 
        Head::tags();
    ?>
  	<title>Largebounds Corporation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/shorthandcss@1.1.1/dist/shorthand.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:200,300,400,500,600,700,800,900&display=swap" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
	
	<link rel="stylesheet" href="src/assets/css/style.css">

	</head>
	<body class="img js-fullheight bg-black">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Largebounds</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Do not have an account?</h3>
		      	<form action="#" class="signin-form" onclick="event.preventDefault(); event.stopImmediatePropagation();">
				  	<div id="message">
                    
					</div>
                    <div class="form-group">
		      			<input type="text" class="form-control" placeholder="Fullname" id="fullname">
		      		</div>
                      <div class="form-group">
		      			<input type="text" class="form-control" placeholder="Username" id="username">
		      		</div>
		      		<div class="form-group">
		      			<input type="email" class="form-control" placeholder="email address" id="email">
		      		</div>
                    <div class="form-group">
                    	<input type="password" class="form-control" placeholder="Password" id="password">
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="bg-orange form-control btn submit px-3" onclick="log(this, 'register')">Register</button>
                    </div>
                    <div class="form-group d-flex w-100pc justify-left">
                        <div class="w-50 text-md-right">
                            <a href="forgot" style="color: #fff">Forgot Password</a>
                        </div>
                    </div>
	          </form>
	          <p class="w-100 text-center">&mdash; Or Join Us &mdash;</p>
	          <div class="social d-flex text-center">
	          	<a href="login" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> Login</a>
	          </div>
		      </div>
				</div>
			</div>
		</div>
	</section>
		    <!-- Include the notice box here -->
			<?php include "src/template/quick-notice.php"; ?>

	<script src="src/assets/js/jquery.min.js"></script>
  <script src="src/assets/js/popper.js"></script>
  <script src="src/assets/js/bootstrap.min.js"></script>
  <script src="src/assets/js/main.js"></script>

	</body>
</html>

